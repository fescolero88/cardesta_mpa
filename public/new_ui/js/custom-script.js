$(document).ready(function () {
	$(document).on("click", ".tabvalue", function(){
		console.log('hi');
		$(".makevalue").val('');
		var tab=$(this).attr('data-value'); 
		$.ajax({
			 type: 'GET',
            url: APP_URL+'/gettab',
			data:'tab='+tab,
			success: function (data) {
				console.log(data);
				$('.search_make').empty();
				$('.search_model').empty();
				$('.search_model').append('<option>Choose Model</option>');
				var box_html;
				box_html+='<option>Choose Make</option>';
				for (var i = 0; i < data.length; i++) {
					box_html+='<option value='+ data[i].make+'>'+data[i].make+'</option>';
				 }
				$('.search_make').append(box_html);
			}	
		});
		$(".makevalue").val(tab);
	});
	$(document).on("change", ".search_make", function(){
		var make =  $(this).val();
		var tab=$(".makevalue").val();
		 $.ajax({
			 type: 'GET',
            url: APP_URL+'/getmake',
			data:'make='+make+'&tab='+tab,
			success: function (data) {
				$('.search_model').empty();
				var box_html;
				box_html+='<option>Choose Model</option>';
				for (var i = 0; i < data.length; i++) {
					box_html+='<option value='+ data[i].model+'>'+data[i].model+'</option>';
				 }
				$('.search_model').append(box_html);
			}	
		});
		
    });
});	
