
class Slide{
    constructor(type){
        this.type = type;
        this.container = $('.slides-wrapper'); 
        this.carousel  = $();

        const self = this;
        
        this.populate();

        // Next button
        $("body").on( "click", ".next", function(e) {
            e.preventDefault();
            self.carousel.trigger('next.owl.carousel');
        });

        // We focus the input
        self.carousel.on('translated.owl.carousel', function(event) {
            let current = event.item.index;
            let input = self.carousel.find(".owl-item.active").find('input');
            input.focus();
            
        })
        

    }

    // Pupulate the slide with the form content
    populate(){
        const self = this;
        if(this.type == 'form'){
            
            
            this.container.append('<div class="slides"></div>');
            
            let content = this.container.find('form');
            
            content.children('div').each(function () {
                let child = $(this);

                $('.slides').append(`
                <div>
                    <div>${child.html()}</div>
                    <a href="#" class="button next">Siguiente</a>
                </div>`);
               
            });

            $('.slides').append(`
                <lottie-player src="https://assets7.lottiefiles.com/packages/lf20_lk80fpsm.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player>
            `);
            
            content.remove();
            $('.slides').wrapAll("<form></form>");
            this.carousel = this.container.find('.slides');
            this.carousel.addClass('owl-carousel');
            this.carousel.owlCarousel({
                items:1,
                nav:false,
                dots:false,
                loop:true
            });

            
        }

        
        
    }

    next(){
        owl.trigger('next.owl.carousel');
    }
}