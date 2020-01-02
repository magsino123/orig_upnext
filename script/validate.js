$('#check').click(function(event){
			event.preventDefault();
			var id = 'id';
			var form = $('#getquote').serialize();
			var btn = $("#validate").attr('disabled', true);
			console.log( $('#getquote').serialize() );
			$.ajax({				
			type : 'POST',
			url  : '../quote_form/php_function/if_platenumber_existed.php',
			data : form,
			dataType: "json",
			success : function(data){
			if (data.auth == "exist") {
				//alert("Already Qouted by:"+"\t"+data.name+" "+ "with the Premium of"+" "+data.Premium);
				swal("Already Qouted by:"+"\t"+data.name+" "+data.lastname+" "+ "with the Premium of"+" "+"₱"+" "+data.PREM,"", "warning");
			}else{
				//$("#getquote").submit(data.make);
				swal("Already Qouted by:"+"\t"+data.name+" "+data.lastname+" "+ "with the Premium of"+" "+"₱"+" "+data.PREM,"", "warning");
			}					
															
			}
			});
		});