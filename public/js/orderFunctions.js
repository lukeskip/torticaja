$(function() {
    
    let order           = new Order;
    const productsArray = [];

    $('.search-product').on('click',(event)=>{
        order.filtering($('.search').val());
    });
    
    $('.add-unit-product').on('click',(e)=>{
        let product = $(e.currentTarget).closest('.list-group-item');
        order.beforeAdding({id:product.data('id'),label:product.data('label'),unit:product.data('unit'),price:product.data('price')})
    });

    $('body').on('click', '.delete', function(e) {
        let product = $(e.currentTarget).parent();
        order.removeProduct(product.data('id'));
    });

    $('.check-out-button').on('click',(e)=>{
        order.openCart();
    });

    $(window).on( "scroll", (event)=>{
        if(window.scrollY >= 190){
            $('.search-box').addClass('fixed');
        }else{
            $('.search-box').removeClass('fixed');
        }
        
    });
    
    $( ".list-group-item" ).each(function() {
        productsArray.push($(this).data('label'));
    });

    $('.search').autocomplete({
        source: productsArray,
        position: {  collision: "flip"  },
        appendTo:'.autocomplete-wrapper',
        select: function(event, ui) { 
            order.filtering(ui.target); 
        },
        close: function(event, ui)  {
            $('input')[0].value = ""; // Clear the input field 
        },
    });
  });