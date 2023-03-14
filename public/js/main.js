let slides = new Slide('form');

// Form submission
$('form').on('submit',function(e){
	e.preventDefault();

})

// Pool de conexiones
function connection (method,fields,link,handle = false){

	return $.ajax({
		header:{
			'Content-Type':'application/x-www-form-urlencoded',
			'Accept':'application/json'
		},
		method:method,
	  	url: APP_URL+link,
	 	dataType:'json',
	  	data:fields,
	  	beforeSend: function( xhr ) {
    		$('.loader-wrapper').css('display','block');
  		}
	})
	.done(function(data) {
		// Si handle es true, solo regresamos la respuesta del ajax, si no manejamos el mensaje al usuario desde aquí
		$('.loader-wrapper').fadeOut();
		if(handle){
			return data;
		}else{
			if(data.success == true){
				show_message('success','¡Listo!',data.message);
			}else{
				show_message('error','¡Error!',data.message);
			}
		}	
	  
	}).fail(function(jqXHR, exception){
		$('.loader-wrapper').fadeOut();
		msg =  get_error(jqXHR.status);
		show_message('error','Error en el servidor!',msg);
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

// controlador de mensajes
function show_message(type,title,message,link,color = '#CF2832'){
	swal({ 
		title: title,
		text: message,
		type: type,
		confirmButtonText: 'OK',
		confirmButtonColor: color 
	},
	function(){
		if(link){
			window.location.replace(link);	
		}
	});
}