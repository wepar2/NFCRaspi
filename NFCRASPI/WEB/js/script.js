$(document).ready(function(){

	$("main").css("min-height",$(window).height());
	
	$(window).resize(function(){
		$("main").css("min-height",$(window).height());
	});

	//Nombre
	$("#nombreInput").attr('maxlength','30');
	$("#nombreInput").attr('required');
	
	$('#nombreInput').on('input', function() {
		var input=$(this);
		var is_name=input.val();


		if(is_name){
			input.removeClass("invalid").addClass("valid");
		}
		else{
			input.removeClass("valid").addClass("invalid");
		}
	});

	//Apellido
	$("#apellidoInput").attr('maxlength','30');
	$("#apellidoInput").attr('required');
	
	$('#apellidoInput').on('input', function() {
		var input=$(this);
		var is_name=input.val();


		if(is_name){
			input.removeClass("invalid").addClass("valid");
		}
		else{
			input.removeClass("valid").addClass("invalid");
		}
	});

	//Correo
	
	$('#emailInput').on('input', function() {
		var input=$(this);
		var is_name=input.val();


		if(is_name){
			input.removeClass("invalid").addClass("valid");
		}
		else{
			input.removeClass("valid").addClass("invalid");
		}
	});

	//usuario
	
	$('#usuarioInput').on('input', function() {
		var input=$(this);
		var is_name=input.val();


		if(is_name){
			input.removeClass("invalid").addClass("valid");
		}
		else{
			input.removeClass("valid").addClass("invalid");
		}
	});


	//Correo
	
	$('#emailInput').on('input', function() {
		var input=$(this);
		var is_name=input.val();


		if(is_name){
			input.removeClass("invalid").addClass("valid");
		}
		else{
			input.removeClass("valid").addClass("invalid");
		}
	});

	//contraseña
	
	$('#passInput').on('input', function() {
		var input=$(this);
		var is_name=input.val();


		if(is_name){
			input.removeClass("invalid").addClass("valid");
		}
		else{
			input.removeClass("valid").addClass("invalid");
		}
	});

	//Telefono

	$("#telefonoInput").attr('maxlength','9');
	$("#telefonoInput").attr('required');

	$('#telefonoInput').on('input', function() {
		this.value = this.value.replace(/[^0-9]/g,'');

		var input=$(this);
		var is_telefono=input.val();
		if($('#telefonoInput').val().length == 9 && !isNaN($('#telefonoInput').val())){
			input.removeClass("invalid").addClass("valid");
		}
		else{
			input.removeClass("valid").addClass("invalid");
		}
	});

	//Direccion
	
	$('#direccionInput').on('input', function() {
		var input=$(this);
		var is_name=input.val();


		if(is_name){
			input.removeClass("invalid").addClass("valid");
		}
		else{
			input.removeClass("valid").addClass("invalid");
		}
	});

	

	//Ventana Verificacion SMS
	$(".codeTEXT").attr('required');
	$(".codeTEXT").attr('maxlength','4');
	

	$('.codeTEXT').on('input', function() {
		this.value = this.value.replace(/[^0-9]/g,'');

		var input=$(this);
		var is_code = input.val();

		if($('.codeTEXT').val().length == 4){
			input.removeClass("invalid").addClass("valid");
		}
		else{
			input.removeClass("valid").addClass("invalid");
		}

	});
        
       $("#newpass").modal("show");
       $("#edit").modal("show"); 
       
      $('#file_1').on('change',function(){
        $('#inputval').text( $(this).val());
      });
      
});