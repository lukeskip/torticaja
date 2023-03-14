class Message{
    constructor(type,message,autoclose = false){
        this.type       = type;
        this.message    = message;
        this.autoclose  = autoclose;

        console.log(this.autoclose);
        this.build();

        $('body').on('click', '.close',function(e){
            e.preventDefault();
            console.log('close');
            $('.message-wrap').remove();
        })

    }

    build(){
        let animation = '';
        switch (this.type) {
            case 'success':
                animation = APP_URL+'/animations/success.json'
                break;
            case 'error':
                animation = APP_URL+'/animations/error.json'
                break;
            case 'warning':
                animation = APP_URL+'/animations/warning.json'
                break;
        
            default:
                break;
        }

        $('body').prepend(`
            <div class="message-wrap">
                <div class="message">
                    <div class="animation-wrap">
                        <lottie-player src="${animation}"  background="transparent"  speed="1"   autoplay></lottie-player>
                    </div>
                    <div class="text">
                        ${this.message}
                    </div>
                </div>
            </div>
        `);

        console.log(this.autoclose);

        if(!this.autoclose){
            $('.message').append(`
                <a href="#" class="button close">Aceptar</a>
            `)
        }

        $('.message-wrap').css('display','flex');
    }
}