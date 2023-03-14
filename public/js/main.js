let slides 	= new Slide('form');


// Pool de conexiones
function connection (method,fields,link,handle = false){

	return $.ajax({
		headers:{
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			'Content-Type':'application/x-www-form-urlencoded',
			'Accept':'application/json'
		},
		method:method,
	  	url: APP_URL+link,
	 	dataType:'json',
	  	data:fields,
	  	beforeSend: function( xhr ) {
    		show_loader()
  		}
	})
	.done(function(data) {
		// IF HANDLE IS TRUE WE RETURN THE AJAX DATA, IF IT'S FALSE WE SHOW THE MESSAGE FROM HERE
		hide_loader()
		if(handle){
			return data;
		}else{
			if(data.success == true){
				let message = new Message('success','hola como estas?',true);
			}else{
				let message = new Message('error','hola como estas?',false);
			}
		}	
	  
	}).fail(function(jqXHR, exception){
		hide_loader();
		msg =  get_error(jqXHR.status);
		let message = new Message('error',msg,false);
	});

}

function get_error(code){
	if (code === 0) {
		return 'Not connect.\n Verify Network.';
	} else if (code == 401) {
		window.location.replace('/login');
	} else if (code == 404) {
		return 'Requested page not found. [404]';
	} else if (code == 500) {
		return 'Internal Server Error [500].';
	} 
}

function show_loader(){
	$('.loader-wrapper').css('display','flex');
}

function hide_loader(){
	$('.loader-wrapper').css('display','none');
}
