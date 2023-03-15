class BooleanButton{
    constructor(target){
        this.target = target;
        let self = this;
      
        // WE REPLACE THE ORIGINAL MARKUP WITH THE NICE BOOLEAN
        $(target).each(function(){
            $(this).replaceWith(`
                <div class="boolean-button">
                    <div class="label">${$(this).data('label')}</div>
                    <div class="slide-button">
                        <input name="${$(this).data('id')}" type="hidden" value="${$(this).data('init')}">
                    </div>
                </div>
            `);
        });

        // ON CLICK WE ADD THE CLASS ACTIVE AND TOGGLE THE VALUE
        $('body').on('click','.slide-button',function(e){
            e.preventDefault();
            let input = $(this).find('input');
            $(this).toggleClass('active');
            input.val(self.toggleValue(input.val()));
        });
    }

    toggleValue(value){
        if (value == 1) {
           value = 0;
        }else{
            value = 1;
        }
        return value
    }
}