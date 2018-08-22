$('document').ready(function(){ 
	 $("#btn-login").click(function(){
		 $("#login-form").validate({
		     rules:
			 {
		    	 password: {
		    		 required: true,
		    	 },
		    	 user_email: {
		    		 required: true,
		    		 email: true
		    	 }
			  },
		      messages:
			  {
		    	  password:{
		    		  required: "Lütfen şifrenizi giriniz"
		          },
		          user_email: "Lütfen email adresinizi giriniz",
		      },
			  submitHandler: submitLoginForm	
		  });  
	 });
	   
	 function submitLoginForm()
	 {		
		var data = $("#login-form").serialize();
			
		$.ajax({
			type : 'POST',
			url  : 'process.php',
			data : data,
			beforeSend: function(){	
				$("#error").fadeOut();
				$("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; gönderiliyor ...');
			},
			success :  function(response){						
				if(response=="ok"){
					$("#btn-login").html('<img src="image/btn-ajax-loader.gif" /> &nbsp; Giriş Yapılıyor ...');
					setTimeout(' window.location.href = "home.php"; ',4000);
				}
				else{
					$("#error").fadeIn(1000, function(){						
							$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
							$("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Giriş Yap');
					});
				}
			}
		});
		return false;
	 }
	 
	 $("#btn-register").click(function(){
		 $("#register-form").validate({
		      rules:
			  {
		    	  	name:{
		    	  		required: true,
		    	  	},
		    	  	surname:{
		    	  		required: true,
		    	  	},
					password: {
						required: true,
					},
					user_email: {
			            required: true,
			            email: true
		            },
			   },
		       messages:
			   {
		    	   	name:{
		    	   		required: "Lütfen adınızı giriniz"
		    	   	},
		    	   	surname:{
		    	   		required: "Lütfen soyadınızı giriniz"
		    	   	},
		            password:{
		                required: "Lütfen şifrenizi giriniz"
		            },
		            user_email: "Lütfen email adresinizi giriniz",
		       },
			   submitHandler: submitRegisterForm	
		 });  
	 });
	 
	 function submitRegisterForm(){		
		var data = $("#register-form").serialize();
			
		$.ajax({
			type : 'POST',
			url  : 'process.php',
			data : data,
			beforeSend: function(){	
				$("#error").fadeOut();
				$("#btn-register").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; gönderiliyor ...');
			},
			success :  function(response){						
				if(response=="ok"){
					$("#btn-register").html('<img src="image/btn-ajax-loader.gif" /> &nbsp; Kayıt Yapılıyor ...');
					setTimeout(' window.location.href = "index.php?kayit=true"; ',4000);
				}
				else{
					$("#error").fadeIn(1000, function(){						
						$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
						$("#btn-register").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Kayıt Ol');
					});
				}
			}
		});
		return false;
	 }
	 
	 $("#table-ekle").click(function(){
		var data = $("#table-form").serialize();
			
		$.ajax({
			type : 'POST',
			url  : 'process.php',
			data : data +"&btn-table-ekle=",
			beforeSend: function(){	
				$("#error").fadeOut();
				$("#table-ekle").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; gönderiliyor ...');
			},
			success :  function(response){						
				if(response != "0"){
					$("#table-ekle").html('<img src="image/btn-ajax-loader.gif" /> &nbsp; Kayıt Yapılıyor ...');
					dynamic();
					$("#table-ekle").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Oluştur');
				}
				else{	
					$("#error").fadeIn(1000, function(){						
						$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
						$("#table-ekle").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Oluştur');
					});
				}
			}
		});
	 });
	 
	 $("#table-duzenle").click(function(){
		var data = $("#table-duzenle-form").serialize();
		var id = $("#tableDuzenle").data('id');
			
		$.ajax({
			type : 'POST',
			url  : 'process.php',
			data : data +"&id="+id+"&btn-table-duzenle=",
			beforeSend: function(){	
				$("#error").fadeOut();
				$("#table-duzenle").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; gönderiliyor ...');
			},
			success :  function(response){						
				if(response != "0"){
					$("#table-duzenle").html('<img src="image/btn-ajax-loader.gif" /> &nbsp; Kayıt Yapılıyor ...');
					dynamic();
					$("#table-duzenle").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Düzenle');
				}
				else{	
					$("#error").fadeIn(1000, function(){						
						$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
						$("#table-duzenle").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Düzenle');
					});
				}
			}
		});
	 });
	 
	 $("#img-ekle").click(function(){
		var data = $("#img-form").serialize();
			
		$.ajax({
			type : 'POST',
			url  : 'process.php',
			data : data +"&btn-img-ekle=",
			beforeSend: function(){	
				$("#error").fadeOut();
				$("#img-ekle").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; gönderiliyor ...');
			},
			success :  function(response){						
				if(response != "0"){
					$("#img-ekle").html('<img src="image/btn-ajax-loader.gif" /> &nbsp; Kayıt Yapılıyor ...');
					dynamic();
					$("#img-ekle").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Oluştur');
				}
				else{
					$("#error").fadeIn(1000, function(){						
						$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
						$("#img-ekle").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Oluştur');
					});
				}
			}
		});
	 });
	 
	 $("#img-duzenle").click(function(){
		var data = $("#img-duzenle-form").serialize();
		var id = $("#imgDuzenle").data('id');
			
		$.ajax({
			type : 'POST',
			url  : 'process.php',
			data : data +"&id="+id+"&btn-img-duzenle=",
			beforeSend: function(){	
				$("#error").fadeOut();
				$("#img-duzenle").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; gönderiliyor ...');
			},
			success :  function(response){						
				if(response != "0"){
					$("#img-duzenle").html('<img src="image/btn-ajax-loader.gif" /> &nbsp; Kayıt Yapılıyor ...');
					dynamic();
					$("#img-duzenle").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Düzenle');
				}
				else{	
					$("#error").fadeIn(1000, function(){						
						$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
						$("#img-duzenle").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Düzenle');
					});
				}
			}
		});
	 });
	 
	 $("#p-ekle").click(function(){
		var data = $("#p-form").serialize();
			
		$.ajax({
			type : 'POST',
			url  : 'process.php',
			data : data +"&btn-p-ekle=",
			beforeSend: function(){	
				$("#error").fadeOut();
				$("#p-ekle").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; gönderiliyor ...');
			},
			success :  function(response){						
				if(response != "0"){
					$("#p-ekle").html('<img src="image/btn-ajax-loader.gif" /> &nbsp; Kayıt Yapılıyor ...');
					dynamic();
					$("#p-ekle").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Oluştur');
				}
				else{
					$("#error").fadeIn(1000, function(){						
						$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
						$("#p-ekle").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Oluştur');
					});
				}
			}
		});
	 });
	 
	 $("#p-duzenle").click(function(){
		var data = $("#p-duzenle-form").serialize();
		var id = $("#pDuzenle").data('id');
			
		$.ajax({
			type : 'POST',
			url  : 'process.php',
			data : data +"&id="+id+"&btn-p-duzenle=",
			beforeSend: function(){	
				$("#error").fadeOut();
				$("#p-duzenle").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; gönderiliyor ...');
			},
			success :  function(response){						
				if(response != "0"){
					$("#p-duzenle").html('<img src="image/btn-ajax-loader.gif" /> &nbsp; Kayıt Yapılıyor ...');
					dynamic();
					$("#p-duzenle").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Düzenle');
				}
				else{	
					$("#error").fadeIn(1000, function(){						
						$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
						$("#p-duzenle").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Düzenle');
					});
				}
			}
		});
	 });
	 
	 $("#a-ekle").click(function(){
		 var data = $("#a-form").serialize();
			
		$.ajax({
			type : 'POST',
			url  : 'process.php',
			data : data +"&btn-a-ekle=",
			beforeSend: function(){	
				$("#error").fadeOut();
				$("#a-ekle").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; gönderiliyor ...');
			},
			success :  function(response){						
				if(response != "0"){
					$("#a-ekle").html('<img src="image/btn-ajax-loader.gif" /> &nbsp; Kayıt Yapılıyor ...');
					dynamic();
					$("#a-ekle").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Oluştur');
				}
				else{
					$("#error").fadeIn(1000, function(){						
						$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
						$("#a-ekle").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Oluştur');
					});
				}
			}
		});
	 });
	 
	 $("#a-duzenle").click(function(){
		var data = $("#a-duzenle-form").serialize();
		var id = $("#aDuzenle").data('id');
			
		$.ajax({
			type : 'POST',
			url  : 'process.php',
			data : data +"&id="+id+"&btn-a-duzenle=",
			beforeSend: function(){	
				$("#error").fadeOut();
				$("#a-duzenle").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; gönderiliyor ...');
			},
			success :  function(response){						
				if(response != "0"){
					$("#a-duzenle").html('<img src="image/btn-ajax-loader.gif" /> &nbsp; Kayıt Yapılıyor ...');
					dynamic();
					$("#a-duzenle").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Düzenle');
				}
				else{	
					$("#error").fadeIn(1000, function(){						
						$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
						$("#a-duzenle").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Düzenle');
					});
				}
			}
		});
	 });
});

function dynamic(){
	 $.ajax({
		type : 'POST',
		url  : 'process.php',
		data : 'dynamic',
		success :  function(response){						
			if(response!="0"){
				$("#dynamic").html(response);
			}
		}
	});
}

function sil(id){
	 $.ajax({
		type : 'POST',
		url  : 'process.php',
		data : "id="+id+"&sil=",
		success :  function(response){						
			if(response!="0"){
				dynamic();
			}
		}
	});
}