
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
            
            content.children('div').each(function () {
                let child = $(this);
                console.log(child.html());
                $('.slides').append(`
                <div>
                    <div>${child.html()}</div>
                    <a href="#" class="button next">Siguiente</a>
                </div>`);
               
            });
            
            content.remove();
            $('.slides').wrapAll("<form></form>");
            this.carousel = this.container.find('.slides');
            this.carousel.addClass('owl-carousel');
            this.carousel.owlCarousel({
                items:1,
                nav:false,
                dots:false
            });

            
        }

        
        
    }

    next(){
        owl.trigger('next.owl.carousel');
    }
}