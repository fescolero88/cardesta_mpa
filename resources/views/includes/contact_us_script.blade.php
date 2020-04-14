<script>
    //contact info
    jQuery(document).ready(function($){
        $("#contact_info").submit(function(e) {
            e.preventDefault();
            var formdata =$("#contact_info").serialize();            // process the form
            $.ajax({
                type        : 'POST',
                url         : '{{route('savecontactus')}}',
                data        : formdata,
                dataType    : 'json',
                encode          : true,
                processData: false,
                success: function() {
                    $("#contact_info")[0].reset();
                    swal("Hey! We noted your request. We will get back sooner.");
                },
                error: function(err) {
                    $.each(err.responseJSON.errors, function(key,value) {
                        if(value=="The first name field is required."){
                            $('.err-firstname').html(value);
                        }
                        if(value=="The last name field is required."){
                            $('.err-lastname').html(value);
                        }
                        
                        if(value=="The dealership name field is required."){
                            $('.err-dealership_name').html(value);
                        }
                        
                        if(value=="The dealership street address field is required."){
                            $('.err-dealership_street_address').html(value);
                        }
                        
                        if(value=="The shipping country field is required."){
                            $('.err-shipping_country').html(value);
                        }
                        
                        if(value=="The email field is required."){
                            $('.err-email').html(value);
                        }
                        
                        if(value=="The phone field is required."){
                            $('.err-phone').html(value);
                        }
                        
                        if(value=="The email must be a valid email address."){
                            $('.err-email').html(value);
                        }
                        
                        if(value=="The phone must be a number."){
                            $('.err-phone').html(value);
                        }
                        
//                      $('#error_email').append('<div class="alert alert-danger">'+value+'</div');
                    }); 
                    //swal("Oops! One or more fields are required. Or something went wrong.");
                }
                
            });
        });
    });
</script>

<script>
    //contact support
    jQuery(document).ready(function($){
        $("#contact_support").submit(function(e) {
            e.preventDefault();
            var formdata =$("#contact_support").serialize();            // process the form
            $.ajax({
                type        : 'POST',
                url         : '{{route('savecontactus')}}',
                data        : formdata,
                dataType    : 'json',
                encode          : true,
                processData: false,
                success: function() {
                    $("#contact_support")[0].reset();
                    swal("Hey! We noted your request. We will get back sooner.");
                },
                error: function(err) {
                    //console.log(err);
                    $.each(err.responseJSON.errors, function(key,value) {
                        if(value=="The zipcode field is required."){
                            $('.err-zip').html(value);
                        }
                        if(value=="The city field is required."){
                            $('.err-city').html(value);
                        }
                        
                        if(value=="The contact person field is required."){
                            $('.err-contact_person').html(value);
                        }
                        
                        if(value=="The dealership name field is required."){
                            $('.err-dealership_name').html(value);
                        }
                        
                        if(value=="The issuedetails field is required."){
                            $('.err-issuedetails').html(value);
                        }
                        
                        if(value=="The email field is required."){
                            $('.err-email').html(value);
                        }
                        
                        if(value=="The phone field is required."){
                            $('.err-phone').html(value);
                        }
                        
                        if(value=="The email must be a valid email address."){
                            $('.err-email').html(value);
                        }
                        
                        if(value=="The phone must be a number."){
                            $('.err-phone').html(value);
                        }
                        
//                      $('#error_email').append('<div class="alert alert-danger">'+value+'</div');
                    }); 
                    //swal("Oops! One or more fields are required. Or something went wrong.");
                }
                
            });
        });
    });
</script>
