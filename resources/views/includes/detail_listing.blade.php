<script type="text/javascript">

	jQuery(document).ready(function($){
        

        $("#customerrequest").submit(function(e) {
            e.preventDefault();
            var formdata =$("#customerrequest").serialize();            // process the form
            $.ajax({
                type        : 'POST',
                url         : '{{route('customerrequest')}}',
                data        : formdata,
                dataType    : 'json',
                encode          : true,
                processData: false,
                success: function() {
                    $("#customerrequest")[0].reset();
                    swal("Your request has been sent.");
                },
                error: function(err) {
                    $.each(err.responseJSON.errors, function(key,value) {
                        if(value=="The fname field is required."){
                            $('.err-fname').html("The First Name field is required.");
                        }
                        
                        if(value=="The offer price field is required."){
                            $('.err-offer_price').html(value);
                        }
                        
                        if(value=="The email field is required."){
                            $('.err-email').html(value);
                        }
                        
                        if(value=="The tel field is required."){
                            $('.err-phone').html("The phone field is required.");
                        }
                        
                        if(value=="The email must be a valid email address."){
                            $('.err-email').html(value);
                        }
                        
                        if(value=="The tel must be a number."){
                            $('.err-phone').html("The phone must be a number.");
                        }
                        
                        if(value=="The offer price must be a number."){
                            $('.err-offer_price').html("The offer price must be a number.");
                        }
                        
                        
//                      $('#error_email').append('<div class="alert alert-danger">'+value+'</div');
                    });
                    //swal("Oops! One or more fields are required. Or something went wrong.");
                }
            });
        });

        $("#call-number").click(function(e){
          let phone = $(this).data('phone');
           $.post('{{ route("phone-enquiry") }}',{
               product_id : {{ $product->id }},
               _token : '{{ csrf_token() }}'
           },function(data){
               console.log(data);
           });
            
        });

	})

    jQuery(document).ready(function($){

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                infoWindow.setPosition(pos);
                infoWindow.setContent('Location found.');
                infoWindow.open(map);
                map.setCenter(pos);
            }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.');
            infoWindow.open(map);
        }

        $("#check-aviliblity").click(function(){
            $('html,body').animate({scrollTop: $("#i-am-interested-div").offset().top - 90}, 800);
        });
    });
</script>

