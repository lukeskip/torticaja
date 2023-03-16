class Order {
    constructor (products,update){


        this.address = '';
        this.date    = '';
        this.init = false;
        this.products = [];
        this.counter = 0;
        this.container 
        this.update = update;
        

        this.fields = [
            {
                field:'input',
                type:'number',
                label:'Monto',
                slug:'amount',
                placeholder:''
            },
        ];
        this.total = 0;
        let self = this;
        let date = '';
        let clientsO = '';

        if(typeof clients!== 'undefined'){
            clientsO = '<option value="">Relacionar a un cliente...</option>'
            clients.map(function (client){
                clientsO+=`
                    <option value="${client.id}">${client.label}</option>
                `
            });
        }
        

        if(admin){
            date = `<div class="date">
                        <input class='form-control date-input' type='date' placeholder='date' name='date'>
                    </div>`
        }
        let controls = `
            <div class=' controls'>
                <div class='resume'>
                    <div class='address'>
                        <div class="input-group">
                            <div class="autocompleted-data"></div>
                            <input class='form-control address-input' type='text' placeholder='Escribe la dirección'>
                        </div>
                        ${date}
                    </div>

                    <div class='date'>
                        <div class="input-group">
                            <select name="client" class="form-control client-input">
                                ${clientsO}
                            </select>
                        </div>
                        
                    </div>
                </div>
                <div class="swtch-container"></div>
                <div class='buttons'>
                    <button class='btn btn-danger btn-block cancel'>Cancelar</button>
                    <button class='btn btn-success btn-block create-income'>Pagar <span class='total'>0</span> </button>
                </div>
            </div>
        `
        if(!update){
            $('body').append(
            `<div class='order-checkout modal-style'>
                <h1 class="text-center">Comanda</h1>
                ${!update ? controls: ''}
                <ul class='product-list'></ul>
                
            </div>`);
        }else{
            this.container = $('.order-checkout');
            this.products  = products; 
            $('.order-checkout').append(`<ul class='product-list'></ul>`);
            this.populateList();
        }

        this.container = $('.order-checkout');

        if(!update){
            console.log(update);
            const swtchLabels = [
                {
                    title: 'efectivo',
                    color: '#46b716',
                    icon: '<i class="fa fa-money" aria-hidden="true"></i>'
                },
                {
                    title: 'tarjeta',
                    color: '#d84b2a',
                    icon: '<i class="fa fa-credit-card" aria-hidden="true"></i>'
                },
                {
                    title: 'mercado-pago',
                    color: '#0069d9',
                    icon: '<i class="fa fa-qrcode" aria-hidden="true"></i>'
                },
                {
                    title: 'entrega',
                    color: '#a05f2e',
                    icon: '<i class="fa fa-motorcycle" aria-hidden="true"></i>'
                },
            ]
            this.swtch = new Swtch ('.swtch-container',swtchLabels,'efectivo');
        }
        
        this.showCounter();

        this.container.find('.cancel').on('click',function(e){
            self.closeCart();
        });

        this.container.on('click','.cancel',function(e){
            const container = $(this).closest('.list-group-item');
            self.showEditControls(container);
        });
        

        this.container.on('click','.delete',function(e){
            const id = $(this).closest('.list-group-item').data('id')
            self.removeProduct(id);
        });

        this.container.on('click','.apply',function(e){
            self.populateList();
        });


        this.container.on('click','.adds',function(e){
            const container = $(this).closest('.list-group-item');
            const id        = container.data('id');
            
            container.find('.display-quantity').html(self.editQuantity(id,'add'));
        });

        this.container.on('click','.subs',function(e){
            const container = $(this).closest('.list-group-item');
            const id        = container.data('id');
            
            container.find('.display-quantity').html(self.editQuantity(id,'sub'));
        });

        this.container.on('click','.description',function(e){
            const container = $(this).closest('.list-group-item');
            self.showEditControls(container);
        });

        this.container.find('.address-input').autocomplete({
            source: function( request, response ) {
                connection ('post',{search: request.term },'/orders-addresses').then((data)=>{
                    response(data);
                    
                });
            },
            change: function (item) { 
                self.address = item.target.value;
            },
            position: {  collision: "flip"  },
            appendTo: '.autocompleted-data'
        });

        this.container.find('.create-income').on('click',function(e){
            self.saveOrder('delivered').then((data)=>{
                if(data.status){
                    self.emptyCart();
                    self.closeCart();
                }
            });
        });
        
    }
    
    filtering(){
        let term        = $('.search').val().toLowerCase(); // search term (regex pattern)
        let products    = [];
        
        $( ".list-group-item" ).each(function() {
            products          = [...products,{id:"product_"+$(this).data('id'),label:$(this).data('label')}];
            
        });

    
        let result = products.filter(item => item.label.toLowerCase().indexOf(term) > -1);
        $( ".list-group-item" ).hide();
        result.map(function (item){
            return $('.'+item.id).show();
        });
    }

    beforeAdding(item){
        
        let newItem = {};
       
        if(item.unit !== "piece"){
            
            let amount = 0;
            let  modal = new Modal('Elije el monto','amount-form',this.fields,"test","","");

            $('body').on('click','.amount-form .submit',(e)=>{
                e.preventDefault();
                amount = $('.amount-form .amount').val();
                newItem = {...item,amount:amount};
                this.addingProducts(newItem);
                modal.close();
                $('body').off('click','.amount-form .submit');
            });
        
        }else{
            newItem = {...item,amount:item.price}
            this.addingProducts(newItem);
        }
        
        
    }

    addingProducts(item){
        if(this.isOnCart(item.id)){
            let product = this.products.find(function(found){
                return found.id === item.id;
            });
            if(product.unit !== 'piece'){
                product.amount = parseFloat(item.amount) + parseFloat(product.amount);
            }
            product.quantity += 1;
        }else{
            this.products = [...this.products,{...item,quantity:1}];
        }

        
        this.showCounter();
        this.successFlick();

        if(this.update){
            this.populateList();
        }
    }

    isOnCart (id){ 
        let result = this.products.some((item)=> item.id === id);
        return result
    }

    openCart(){
        this.populateList();
        this.init = true;
    }

    successFlick(){
        
    }

    saveOrder(status){
        
        return new Promise ((resolve,reject)=>{
            connection ('post',{...this.buildObject(),status},'/orders')
            .then((data)=> resolve(data))
            .catch((error)=>reject(error));
        });
    }

    buildObject(){
        this.address = this.container.find('.address-input').val();
        this.date    = this.container.find('.date-input').val();
        this.client    = this.container.find('.client-input').val();
        const result = {products:this.products,total:this.total,address:this.address,date:this.date,method:this.swtch.value,client:this.client}
        return result;
    }

    showCounter(){
        this.counter = 0;
        this.products.map((item)=>{
            this.counter += item.quantity;
        });

        $('.counter').text(`(${this.counter})`);
    }

    removeProduct(id){
        this.products =  this.products.filter(function(item){ 
            return item.id !== id; 
        });
        this.populateList();
        this.showCounter();
    }

    closeCart (){
        this.container.toggleClass('active');
        $('body').css({overflow:'scroll'});
    }

    populateList(){
        console.log(this.products);
        let container = this.container.find('.product-list');
        container.empty();
        let description = '';

        if(this.products.length > 0){
            
            this.products.map(function(product){
                if(product.unit === 'piece'){
                    product['amount'] = Number(product.quantity) * Number(product.price);
                    description = `${product.label} (${product.quantity} x $${product.price}) = $${product.amount}`
                }else{
                    description = `${product.label} (${product.quantity}) = $${product.amount}`
                }
                
                const editControls = `
                <div class="edit-controls">
                    <div class="btn-group btn-group-sm " role="group" aria-label="Basic example">
                        <button type="button" ${product.unit !== 'piece' ? 'disabled' : null } class="btn  btn-sm btn-secondary subs">-</button>
                        <button type="button" disabled class="btn btn-sm btn-secondary display-quantity">${product.quantity}</button>
                        <button type="button" ${product.unit !== 'piece' ? 'disabled' : null } class="btn btn-sm btn-secondary adds">+</button>
                        <button class="btn btn-sm btn-success apply">
                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                        </button>
                        <button class="btn btn-sm btn-danger cancel">
                            <i class="fa fa-times-circle" aria-hidden="true"></i>
                        </button>
                        <button class="btn btn-sm btn-danger delete"><i class="fa fa-trash" aria-hidden="true"></i></button>
                </div>`;

                return container.append( `
                <li class='list-group-item product-${product.id}'  data-id='${product.id}' data-label='${product.label}'>
                    <div class="description">
                        ${description}
                    </div> 
                    
                    <div class="actions">
                        ${editControls}
                    </div>
                    
                </li>`)
                
            });
        }else{
            container.append( `<li class=' list-group-item'>No hay productos que mostrar</li>`)
        }

        this.total = this.products.reduce((acc, item) => ( acc += parseFloat(item.amount)), 0);
        this.container.find('.total').text(this.total);

        container.parent().addClass('active');
        
    }

    editQuantity(id,operation){

    
        const productId = this.products.findIndex(product => product.id === id);
        let quantity = this.products.find(product => product.id === id).quantity;
        if(operation === 'add'){
            quantity += 1;
        }else{
            if(quantity > 1){
                quantity -= 1;
            }
        }
        this.products[productId].quantity = quantity;
        return quantity;
    }

    emptyCart(){
        this.products   = [];
        this.total      = 0;
        this.address    = '';
        this.container.find('.address-input').val('');
        this.showCounter();
        this.container.find('.total').text(this.total);
    }

    showEditControls (container){
        this.container.find('.edit-controls').removeClass('active');
        container.find('.edit-controls').toggleClass('active');
    }
    
}


