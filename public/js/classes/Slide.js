
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
            self.next();
        });

        // WE FOCUS THE INPUT ON EVERY SLIDE
        self.carousel.on('translated.owl.carousel', function(event) {
            let current     = event.item.index + 1;
            let total       = event.relatedTarget.items().length 
            let input       = self.carousel.find(".owl-item.active").find('input');
            input.focus();

            // THIS IS THE LAST ITEM
            if(current == total){
                let fields = $('form').serialize();
                connection ('POST',fields,'/test-connection',false);
             }
            
        });

        

    }

    // Pupulate the slide with the form content
    populate(){
        const self = this;
        if(this.type == 'form'){
            
            // WE ADD THE TARGET OF THE SLIDES
            this.container.append('<div class="slides"></div>');
            
            let content = this.container.find('form');
            
            // WE CONVERT EVERY INPUT WRAPPED ON A DIV INTO A SLIDE
            content.children('div').each(function () {
                let child = $(this);

                $('.slides').append(`
                <div>
                    <div>${child.html()}</div>
                    <a href="#" class="button next">Siguiente</a>
                </div>`);
               
            });

            // WE ADDED A EMPTY SLIDE AT THE END
            $('.slides').append('<div></div>');

            // WE REMOVE THE ORIGINAL CONTENT
            content.remove();

            // WE WRAP THE SLIDES ON A FORM TAG
            $('.slides').wrapAll("<form></form>");


            // WE INITIATE OWL CAROUSEL
            this.carousel = this.container.find('.slides');
            this.carousel.addClass('owl-carousel');
            this.carousel.owlCarousel({
                items:1,
                nav:false,
                dots:false,
            });

            
        }

        
        
    }

    next(){
        this.carousel.trigger('next.owl.carousel');
    }
}