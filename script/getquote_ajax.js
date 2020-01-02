$('#compute').click(function(event){
			event.preventDefault();
			var id = 'id';
			var form = $('#getquote').serialize();
			var city = $("#city").val();
			console.log( $('#getquote').serialize() );
			$.ajax({				
			type : 'POST',
			url  : 'php_function/computation.php',
			data : form,
			dataType: "json",
			success : function(data){						
				$("#gross").html(data.sagot);
				if(city == ""){
					alert('Please');
				}
			}
		});
});