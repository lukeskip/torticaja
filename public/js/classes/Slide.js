
class Slide{
    constructor(type){
        this.type = type;
        this.container = $('.slides-wrapper'); 
        this.carousel  = $();

        const self = this;
        
        this.populate();

        $("body").on( "click", ".next", function(e) {
            e.preventDefault();
            self.carousel.trigger('next.owl.carousel');
        });
        

    }

    populate(){
        const self = this;
        if(this.type == 'form'){
            
            
            this.container.append('<div class="slides"></div>');
            
            let content = this.container.find('form');
            
            content.children('input,select').each(function () {
                let child = $(this);
                
                if(child[0].nodeName == 'INPUT'){
                    
                    $('.slides').append(`
                        <div>
                            <input 
                                name="${child.attr('name')}" 
                                id="${child.attr('name')}"
                                class="${child.attr('name')}"
                            />
                            <a href="#" class="next button">
                                Siguiente
                            </a> 
                        </div>
                    `)
                }else if(child[0].tagName == 'SELECT'){
                    
                }
               
            });
            
            content.remove();
            $('.slides').wrapAll("<form></form>");
            this.carousel = this.container.find('.slides');
            this.carousel.addClass('owl-carousel');
            this.carousel.owlCarousel({
                items:1,
            });

            
        }

        
        
    }

    next(){
        owl.trigger('next.owl.carousel');
    }
}