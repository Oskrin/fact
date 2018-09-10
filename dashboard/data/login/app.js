$(function(){
	$("#loginForm").submit(function(e) {
		//prevent Default functionality
        e.preventDefault();

        //get the action-url of the form
        var actionurl = e.currentTarget.action;
        var fullname=$('#txt_username').val();
        $.ajax({
                url: 'app.php',
                type: 'post',
                dataType: 'json',
                data: {peticion_acceso:'',txt_1:$('#txt_username').val(),txt_2:$('#txt_password').val()},
                success: function(data) {
                    console.log(data);
                    if (data[0]==1) {
                        swal({
                            title: "Buen trabajo! estimado/a "+fullname,
                            text: "Su usuario y contraseña son correo, iniciar sesión!",
                            type: "success"
                        },function (){
                            window.location = "../inicio/"
                        });
                    	
                    }else{
                    	swal({
                            title: "Lo sentimos! estimado/a "+fullname,
                            text: "Usuario o contraseña incorrectos, verifíquelo e intente nuevamente.!",
                            type: "warning",
                        },function (){
                            $('#loginForm').each (function(){
                              this.reset();
                            });
                        });
                    }
                }
        });		
	});
})