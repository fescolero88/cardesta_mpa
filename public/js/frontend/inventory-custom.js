$(document).ready(function () {

    //Set Product Id in modal
    $('#valueyourtradeModalLong').on('show.bs.modal', function (event) {
        var product_id = $(event.relatedTarget).data('product-id');

        /* Reset Modal form */
        $('form#valueYourTradeForm textarea').each(function (key, field) {
            $(field).val('');
        });
        $('form#valueYourTradeForm input').each(function (key, field) {
            if ($(field).attr('name') != '_token') {
                $(field).val('');
            }
        });
        $('form#valueYourTradeForm div.err').each(function (key, tag) {
            $(tag).text('');
        });

        if (typeof product_id != 'undefined') {
            $('#valueYourTradeForm input[name="product_id"]').val(product_id);
        }
        
        /* Set product values  */
        var year = $(event.relatedTarget).data('year');
        var make = $(event.relatedTarget).data('make');
        var model = $(event.relatedTarget).data('model');
        var trim = $(event.relatedTarget).data('trim');
        var citympg = $(event.relatedTarget).data('mileage');
        var vin = $(event.relatedTarget).data('vin');
        
        $('form#valueYourTradeForm input[name="year"]').val(year);
        $('form#valueYourTradeForm input[name="make"]').val(make);
        $('form#valueYourTradeForm input[name="model"]').val(model);
        $('form#valueYourTradeForm input[name="trim"]').val(trim);
        $('form#valueYourTradeForm input[name="mileage"]').val(citympg);
        $('form#valueYourTradeForm input[name="vin"]').val(vin);

    });
    //Set Product Id in modal
    $('#availabilityModal').on('show.bs.modal', function (event) {
        var product_id = $(event.relatedTarget).data('product-id');

        /* Reset Modal form */
        $('form#checkAvailabilityForm textarea').each(function (key, field) {
            $(field).val('');
        });
        $('form#checkAvailabilityForm input').each(function (key, field) {

            if ($(field).attr('name') != '_token') {
                $(field).val('');
            }

        });
        $('form#checkAvailabilityForm div.err').each(function (key, tag) {
            $(tag).text('');
        });

        if (typeof product_id != 'undefined') {
            $('#checkAvailabilityForm input[name="product_id"]').val(product_id);
        }

    });

    //Set Product Id in modal
    $('#lowestpriceModal').on('show.bs.modal', function (event) {
        var product_id = $(event.relatedTarget).data('product-id');

        /* Reset Modal form */
        $('form#lowestPriceForm input').each(function (key, field) {
            if ($(field).attr('name') != '_token') {
                $(field).val('');
            }
        });

        /* Remove errors */
        $('form#lowestPriceForm div.err').each(function (key, tag) {
            $(tag).text('');
        });
        if (typeof product_id != 'undefined') {
            $('#lowestPriceForm input[name="product_id"]').val(product_id);
        }

        //Set car details
        var name = $(event.relatedTarget).data('name');
        var detail_page = $(event.relatedTarget).data('url');
        var image = $(event.relatedTarget).data('image');
        var body = $(event.relatedTarget).data('body-type');
        var model = $(event.relatedTarget).data('model');
        var drive_train = $(event.relatedTarget).data('drive-train');
        var ext_color = $(event.relatedTarget).data('ext-color');
        var engine_displacement = $(event.relatedTarget).data('engine-displacement');
        var transmission = $(event.relatedTarget).data('transmission');
        var citympg = $(event.relatedTarget).data('citympg');
        var stock = $(event.relatedTarget).data('stock');
        var vin = $(event.relatedTarget).data('vin');
        
        var vehicleDescList = $('div.vehicle-info div.cardetail div.info-content ul.w-100');
        
        //Empty List
        $(vehicleDescList).html('');
        
        //Set new details
        $(vehicleDescList).append('<li><span><strong class="mr-2">Body Style:</strong>'+body+'</span></li>');
        $(vehicleDescList).append('<li><span><strong class="mr-2">Model Code:</strong>'+model+'</span></li>');
        $(vehicleDescList).append('<li><span><strong class="mr-2">Drive Type:</strong>'+drive_train+'</span></li>');
        $(vehicleDescList).append('<li><span><strong class="mr-2">Ext. Color:</strong>'+ext_color+'</span></li>');
        $(vehicleDescList).append('<li><span><strong class="mr-2">Engine:</strong>'+engine_displacement+'</span></li>');
        $(vehicleDescList).append('<li><span><strong class="mr-2">Transmission:</strong>'+transmission+'</span></li>');
        $(vehicleDescList).append('<li><span><strong class="mr-2">Mileage:</strong>'+citympg+'</span></li>');
        $(vehicleDescList).append('<li><span><strong class="mr-2">Stock #:</strong>'+stock+'</span></li>');
        $(vehicleDescList).append('<li><span><strong class="mr-2">VIN:</strong>'+vin+'</span></li>');
        
        //Set Image
        $('div.vehicle-info div.lowestprice-image img').attr('src', image);
        
        //Set Name
        $('div.vehicle-info div.title span.car-name a').attr('href', detail_page);
        $('div.vehicle-info div.title span.car-name a').text(name);
    });

    /**
     * Submit trade in value form. 
     */
    $("#valueYourTradeForm").submit(function (e) {
        e.preventDefault();
        var formdata = $("#valueYourTradeForm").serialize();
        var url = $("#valueYourTradeForm").attr('action');
        $.ajax({
            type: 'POST',
            url: url,
            data: formdata,
            dataType: 'json',
            encode: true,
            processData: false,
            success: function (response) {
                $('#valueyourtradeModalLong').modal('hide');
                swal("Your request has been sent.");
            },
            error: function (err) {

                $.each(err.responseJSON.errors, function (key, value) {
                    if (key == "first_name") {
                        $('#valueYourTradeForm .err-first_name').html(value[0]);
                    }
                    if (key == "last_name") {
                        $('#valueYourTradeForm .err-last_name').html(value[0]);
                    }
                    if (key == "phone") {
                        $('#valueYourTradeForm .err-phone').html(value[0]);
                    }
                    if (key == "email") {
                        $('#valueYourTradeForm .err-email').html(value[0]);
                    }
                    if (key == "comment") {
                        $('#valueYourTradeForm .err-comment').html(value[0]);
                    }


                });
            }
        });
    });

    /**
     * Submit check availability form. 
     */
    $("#checkAvailabilityForm").submit(function (e) {
        e.preventDefault();
        var formdata = $("#checkAvailabilityForm").serialize();
        var url = $("#checkAvailabilityForm").attr('action');
        $.ajax({
            type: 'POST',
            url: url,
            data: formdata,
            dataType: 'json',
            encode: true,
            processData: false,
            success: function (response) {
                $('#availabilityModal').modal('hide');
                swal("Your request has been sent.");
            },
            error: function (err) {
                console.log(err.responseJSON.errors);
                $.each(err.responseJSON.errors, function (key, value) {
                    if (key == "first_name") {
                        $('#checkAvailabilityForm .err-first_name').html(value[0]);
                    }
                    if (key == "last_name") {
                        $('#checkAvailabilityForm .err-last_name').html(value[0]);
                    }
                    if (key == "phone") {
                        $('#checkAvailabilityForm .err-phone').html(value[0]);
                    }
                    if (key == "email") {
                        $('#checkAvailabilityForm .err-email').html(value[0]);
                    }
                    if (key == "comment") {
                        $('#checkAvailabilityForm .err-comment').html(value[0]);
                    }

                });
            }
        });
    });

    /**
     * Request today's best price. 
     */
    $("#lowestPriceForm").submit(function (e) {
        e.preventDefault();
        var formdata = $("#lowestPriceForm").serialize();
        var url = $("#lowestPriceForm").attr('action');
        $.ajax({
            type: 'POST',
            url: url,
            data: formdata,
            dataType: 'json',
            encode: true,
            processData: false,
            success: function (response) {
                $('#lowestpriceModal').modal('hide');

                if( typeof response.message != 'undefined'){
                    swal(response.message);
                }
            },
            error: function (err) {

                $.each(err.responseJSON.errors, function (key, value) {
                    if (key == "first_name") {
                        $('#lowestPriceForm .err-first_name').html(value[0]);
                    }
                    if (key == "last_name") {
                        $('#lowestPriceForm .err-last_name').html(value[0]);
                    }
                    if (key == "phone") {
                        $('#lowestPriceForm .err-phone').html(value[0]);
                    }
                    if (key == "email") {
                        $('#lowestPriceForm .err-email').html(value[0]);
                    }

                });
            }
        });
    });


});