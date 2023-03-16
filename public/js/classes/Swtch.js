class Swtch{
    constructor(container,labels,initial,update){
        this.container  = $(container);
        this.labels     = labels;
        this.slugs      = labels;
        this.initial    = initial;
        
        console.log(this.initial);

        let swtch = $(` 
            <div class="swtch">
                <div class="pointer ${labels[0].icon ? 'rounded' : null}"></div>
            </div>
        `);

        const labelsContainer = $('<div class="labels-container"></div>')
        this.labels.map((label,index)=>{
            let slug = label.title;
            let title = label.title.replaceAll('-', ' ');
            let labelContainer = `<div class="label label_${slug} ${index === 0 ? 'active':null}" data-slug="${slug}"><span data-color="${label.color}">${label.icon ? label.icon : title}</span></div>`
            labelsContainer.append(labelContainer);
           
        });


        this.container.on('click','.label >span',(e)=>{
            const label = $(e.currentTarget).closest('.label').data('slug');
            this.moveTo(label);
        });
        
        swtch.append(labelsContainer);
        this.container.append(swtch);
        
        this.moveTo(this.initial); 

    }


    moveTo(label){
        this.beforeMove();
        console.log(label);
        const object = $('.label_'+label).find('span');
        this.container.find('.label').removeClass('active');
        const newPosition = object.position().left+((object.parent().width()/2)-25);
        $('.pointer').css({'left':newPosition,'background-color':object.data('color')});
        this.value = object.closest('.label').data('slug');
        object.parent().addClass('active');
        this.value = label;
        this.afterMove();
    }

    afterMove(){}
    beforeMove(){}

    
}