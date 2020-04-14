<script>
    $(function () {

        $("#menu").mmenu({
            // extensions: [ "shadow-panels", "fx-panels-slide-100", "border-none", "theme-black", "fullscreen" ],
            extensions: ["position-front", "position-right"],
            navbars: {
                content: ["prev", "title", "close"],
                height: 2
            },
            setSelected: true,
            searchfield: {
                resultsPanel: true
            }
        }, {});

        // $(".mh-head.mm-sticky").mhead({
        //         scroll: {
        //           hide: 200
        //        }
        //       });
        //       $(".mh-head:not(.mm-sticky)").mhead({
        //        scroll: false
        //      });


        $('body').on('click',
            'a[href^="#/"]',
            function () {

                return false;
            }
        );
    });
    
    var market_val1 = 1;
    var market_val2 = 360;
    var market_f_time = false;
    
    var byprice_val1 = 500;
    var byprice_val2 = 15000;
    var byprice_f_time = false;
    
    var bypricenew_val1 = 500;
    var bypricenew_val2 = 15000;
    var bypricenew_f_time = false;
    
    var marketmanual_val1 = 1;
    var marketmanual_val2 = 360;
    var marketmanual_f_time = false;
    
    var marketautomatic_val1 = 1;
    var marketautomatic_val2 = 360;
    var marketautomatic_f_time = false;
    
    var mileage2_val1 = 1;
    var mileage2_val2 = 1500;
    var mileage2_f_time = false;
    
    $(function () {
        var sliderTooltip3 = function (event, ui) {
            if (market_f_time) {
                market_val1 = ui.values[0];
                market_val2 = ui.values[1];
            }
            var tooltip = '<div class="tooltip-slider"><div class="tooltip-inner">' + market_val1 + ' days</div><div class="tooltip-arrow"></div></div>';
            var tooltip2 = '<div class="tooltip-slider"><div class="tooltip-inner">' + market_val2 + ' days</div><div class="tooltip-arrow"></div></div>';
            $('#market-slider .ui-slider-handle').eq(0).html(tooltip);
            $('#market-slider .ui-slider-handle').eq(1).html(tooltip2);
        }

        var sliderTooltip4 = function (event, ui) {
            if (byprice_f_time) {
                byprice_val1 = ui.values[0];
                byprice_val2 = ui.values[1];
            }
            var tooltip = '<div class="tooltip-slider"><div class="tooltip-inner">$ ' + price_val1 + '</div><div class="tooltip-arrow"></div></div>';
            var tooltip2 = '<div class="tooltip-slider"><div class="tooltip-inner">$ ' + price_val2 + '</div><div class="tooltip-arrow"></div></div>';
            $('#byprice-slider .ui-slider-handle').eq(0).html(tooltip);
            $('#byprice-slider .ui-slider-handle').eq(1).html(tooltip2);
        }

        var sliderTooltip5 = function (event, ui) {
            if (bypricenew_f_time) {
                bypricenew_val1 = ui.values[0];
                bypricenew_val2 = ui.values[1];
            }
            var tooltip = '<div class="tooltip-slider"><div class="tooltip-inner">$ ' + price_val1 + '</div><div class="tooltip-arrow"></div></div>';
            var tooltip2 = '<div class="tooltip-slider"><div class="tooltip-inner">$ ' + price_val2 + '</div><div class="tooltip-arrow"></div></div>';
            $('#bypricenew-slider .ui-slider-handle').eq(0).html(tooltip);
            $('#bypricenew-slider .ui-slider-handle').eq(1).html(tooltip2);
        }

        var sliderTooltip6 = function (event, ui) {
            if (marketmanual_f_time) {
                marketmanual_val1 = ui.values[0];
                marketmanual_val2 = ui.values[1];
            }
            var tooltip = '<div class="tooltip-slider"><div class="tooltip-inner">' + marketmanual_val1 + ' days</div><div class="tooltip-arrow"></div></div>';
            var tooltip2 = '<div class="tooltip-slider"><div class="tooltip-inner">' + marketmanual_val2 + ' days</div><div class="tooltip-arrow"></div></div>';
            $('#marketmanual-slider .ui-slider-handle').eq(0).html(tooltip);
            $('#marketmanual-slider .ui-slider-handle').eq(1).html(tooltip2);
        }

        var sliderTooltip7 = function (event, ui) {
            if (marketautomatic_f_time) {
                marketautomatic_val1 = ui.values[0];
                marketautomatic_val2 = ui.values[1];
            }
            var tooltip = '<div class="tooltip-slider"><div class="tooltip-inner">' + marketautomatic_val1 + ' days</div><div class="tooltip-arrow"></div></div>';
            var tooltip2 = '<div class="tooltip-slider"><div class="tooltip-inner">' + marketautomatic_val2 + ' days</div><div class="tooltip-arrow"></div></div>';
            $('#marketautomatic-slider .ui-slider-handle').eq(0).html(tooltip);
            $('#marketautomatic-slider .ui-slider-handle').eq(1).html(tooltip2);
        }

        $("#market-slider").slider({
            range: true,
            min: 0,
            max: 360,
            values: [0, 280],
            create: function (e, ui) {
                sliderTooltip3($(this), ui);
                market_f_time = true;
            },
            slide: function (e, ui) {
                sliderTooltip3($(this), ui);
            }
        });

        $("#byprice-slider").slider({
            range: true,
            min: 0,
            max: 2000,
            values: [0, 1000],
            create: function (e, ui) {
                sliderTooltip4($(this), ui);
                byprice_f_time = true;
            },
            slide: function (e, ui) {
                sliderTooltip4($(this), ui);
            }
        });

        $("#bypricenew-slider").slider({
            range: true,
            min: 0,
            max: 2000,
            values: [0, 1000],
            create: function (e, ui) {
                sliderTooltip5($(this), ui);
                byprice_f_time = true;
            },
            slide: function (e, ui) {
                sliderTooltip5($(this), ui);
            }
        });

        $("#marketmanual-slider").slider({
            range: true,
            min: 0,
            max: 360,
            values: [0, 280],
            create: function (e, ui) {
                sliderTooltip6($(this), ui);
                marketmanual_f_time = true;
            },
            slide: function (e, ui) {
                sliderTooltip6($(this), ui);
            }
        });

        $("#marketautomatic-slider").slider({
            range: true,
            min: 0,
            max: 360,
            values: [0, 280],
            create: function (e, ui) {
                sliderTooltip7($(this), ui);
                marketautomatic_f_time = true;
            },
            slide: function (e, ui) {
                sliderTooltip7($(this), ui);
            }
        });
    });
</script>

<script type = "text/javascript" >
    $(window).scroll(function () {
        var sticky = $('.header'),
            scroll = $(window).scrollTop();

        if (scroll >= 50) sticky.addClass('fixed-top');
        else sticky.removeClass('fixed-top');
    });
</script>

<script>
    var formatted_address;
    var placeSearch, autocomplete;
    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };

    function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */
            (document.getElementById('stm-car-location-stm_all_listing_tab')), {
                types: ['geocode']
            });

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);

        var latlng = {
            lat: parseFloat(window.localStorage.getItem('latitude')),
            lng: parseFloat(window.localStorage.getItem('longitude'))
        };
        var geocoder = new google.maps.Geocoder();

        geocoder.geocode({
            'latLng': latlng
        }, function (results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                console.log(results)
                if (results[0]) {
                    var address = results[0]['address_components'][3]['short_name'] + ', ' + results[0]['address_components'][4]['short_name'] + ', ' + results[0]['address_components'][8]['short_name'];
                    console.log(address);
                    window.localStorage.setItem('location', address);
                    document.getElementById('g-lat').innerHTML = window.localStorage.getItem('location');
                } else {
                    window.localStorage.setItem('location', "unknown location");
                    document.getElementById('g-lat').innerHTML = window.localStorage.getItem('location');
                }
            } else {
                window.localStorage.setItem('location', "unknown location");
                //document.getElementById('g-lat').innerHTML =window.localStorage.getItem('location');
            }
        });


    }

    function fillInAddress() {

        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();
        data.search.stm_lat = place.geometry.location.lat()
        data.search.stm_lng = place.geometry.location.lng()
        data.search.search_distance = 10
        data.selected_location = place.formatted_address;
        formatted_address = place.formatted_address;

    }
    var base_url = '{{ url()->to('/') }}';
    //var data = {!! json_encode($search_filterable) !!};
    var data = {
        "product": {
            data: []
        },
        "makes_model": [],
        "extcolor": [],
        "intcolor": [],
        "drivetrain": [],
        "body": [],
        "price": [],
        "mileage": [],
        "transmission": [],
        "transmission_speed": [],
        "make": [],
        "model": [],
        "engine": {
            cylinder: [],
            displacement: []
        },
        "passengercapacity": [],
        "dateinstock": [],
        "fueltype": [],
        "dealRating": [
            {text: 'Great Deal', value: 1},
            {text: 'Good Deal', value: 0}
        ],
        "type": [
            {text: 'Certified Pre-Owned', value: 'True'},
            {text: 'Used', value: 'False'}
        ],
        "search": {!! json_encode($search_filterable['search']) !!},
    };
    data.base_url = base_url;
    data.selected_make = '{{ $_GET['search_make']?? ' ' }}';
    data.selected_model = '{{ $_GET['search_model']?? ' ' }}';
    data.selected_location = '{{ $_GET['ca_location']?? ' ' }}';
    data.selected_body = '{{ $_GET['body']?? ' ' }}';
    var stmOptions_price;
    var stmOptions_mileage;
    var si;
    if (window.localStorage.getItem('latitude') && window.localStorage.getItem('longitude')) {
        var pos = {
            lat: window.localStorage.getItem('latitude'),
            lng: window.localStorage.getItem('longitude')
        }
        data.search.stm_lat = pos.lat;
        data.search.stm_lng = pos.lng;
        data.search.search_distance = 100;
    }

    var vm = new Vue({
        el: '#app',
        data: data,

        mounted() {
            this.initial_fetch();
        },
        computed: {
            searchMakeOptions() {
                let newMakes = this.make.slice();
                newMakes.unshift({ make: 'all'});
                newMakes.unshift({ make: ''});

                return newMakes;
            },

            filterMakeOptions() {
                return this.make;
            },

            filterEngineOptions() {
                let engineCylinders = this.engine.cylinder
                let engineDisplacements = this.engine.displacement

                let newOptions = []

                for (let i = 0; i < engineCylinders.length; i++)
                    for (let j = 0; j < engineDisplacements.length; j++)
                        newOptions.push({
                            value: `${engineCylinders[i].enginecylinders}-${engineDisplacements[j].enginedisplacement}`,
                            text: `${engineCylinders[i].enginecylinders} Cyl - ${engineDisplacements[j].enginedisplacement}`
                        })
                        
                return newOptions
            }
        },
        methods: {
            initial_fetch() {
                $('.stm-ajax-row').addClass('stm-loading');
                $('.classic-filter-row .filter-sidebar .select2-container--default .select2-selection--single .select2-selection__arrow b').addClass('stm-preloader');

                let that = this;
                let nocarfound = base_url + '/images/car_not_found.png';
                $(".nocarfound").attr('src', base_url + '/images/CARloader.gif');

                var url = '{{ url()->current() }}';

                @if(empty($_GET['search_from']))
                    data.search.sellingprice = ""
                    data.search.miles = ""
                @endif
                
                var url_s = base_url + '/inventory?' + this.serialize();
                @if(!empty($_GET['max_price']))
                    url_s += '&max_price=' + {{ $_GET['max_price'] }}
                @endif
                
                $.getJSON(url_s, function (response) {
                    $(".nocarfound").attr('src', nocarfound);
                    $('.stm-ajax-row').removeClass('stm-loading');
                    $('.classic-filter-row .filter-sidebar .select2-container--default .select2-selection--single .select2-selection__arrow b').removeClass('stm-preloader');
                    $('.classic-filter-row .filter-sidebar select').prop("disabled", false);
                    
                    response.model.unshift({
                        model: "all"
                    })
                    vm = Object.assign(vm, response);

                    data = response;
                    data.base_url = base_url;
                    data.selected_make = '{{ $_GET['search_make']?? ' ' }}';
                    data.selected_model = '{{ $_GET['search_model']?? ' ' }}';
                    data.selected_location = '{{ $_GET['ca_location']?? ' ' }}';
                    data.selected_body = '{{ $_GET['body']?? ' ' }}';
                    that.product.data = that.product.data.filter(function (row) {
                        return !$.isEmptyObject(row.dealer);
                    });
                    that.product.data.map(function (o) {
                        o.images.map(function (i) {
                            i.image = i.image.replace(/^http:/i, "https:");
                            //i.image = 'images/no-car.png';
                            return i;
                        });
                        return o;
                    });

                    /**/

                    $(".drivetrain").niceScroll({
                        cursorcolor: "#00F"
                    });


                    $(document).ready(function () {

                        if ($('select[name=searchbody]').data('select2')) {
                            $("select[name=searchbody]").select2('destroy').select2({
                                maximumSelectionSize: 1,
                                placeholder: data.selected_body !== ' ' ? data.selected_body : "choose a body"
                            });
                        }
                        if ($('select[name=searchmake]').data('select2')) {
                            $("select[name=searchmake]").select2('destroy').select2({
                                maximumSelectionSize: 1,
                                placeholder: data.selected_make !== ' ' ? data.selected_make : "choose a make"
                            });
                        }

                        if ($('select[name=searchmodel]').data('select2')) {
                            $("select[name=searchmodel]").select2('destroy').select2({
                                maximumSelectionSize: 1,
                                placeholder: data.selected_model !== ' ' ? data.selected_model : "choose a model"
                            });
                        }

                        /**/
                        // fiter left bar js
                        (function ($) {

                            "use strict";

                            function SearchBox(form) {
                                this.form = form;
                                this.listing = $('body').hasClass('stm-template-listing');
                                this.init();
                            }
                            SearchBox.prototype.init = function () {
                                var timer, self = this;
                                $('select:not(.hide)', this.form).select2().on('change', function () {
                                    if (timer) {
                                        clearTimeout(timer);
                                    }
                                    timer = setTimeout($.proxy(self.performAjax, self), 300);
                                });
                            };
                            SearchBox.prototype.fragments = function () {
                                return 'total' + (!this.listing ? ',options' : '');
                            };
                            SearchBox.prototype.performAjax = function () {
                                var $_form = $(this.form);
                                $.ajax({
                                    url: $_form.attr('action'),
                                    dataType: 'json',
                                    context: this,
                                    data: $_form.serialize() + '&ajax_action=listings-binding&fragments=' + this.fragments(),
                                    beforeSend: $.proxy(this.beforeAjax, this),
                                    success: $.proxy(this.success, this),
                                    complete: $.proxy(this.complete, this)
                                });
                            };
                            SearchBox.prototype.beforeAjax = function () {
                                if (!this.listing) {
                                    $('select, button[type="submit"]', this.form).prop("disabled", true);
                                    $('.select2-container--default .select2-selection--single .select2-selection__arrow b', this.form).addClass('stm-preloader');
                                }
                            };
                            SearchBox.prototype.success = function (data) {
                                if (!this.listing) {
                                    if (typeof data.options != 'undefined') {
                                        $.each(data.options, function (key, options) {
                                            $('select[name=' + key + '] > option', this.form).each(function () {
                                                var slug = $(this).val();
                                                if (options.hasOwnProperty(slug)) {
                                                    $(this).prop('disabled', options[slug].disabled);
                                                }
                                            });
                                        });
                                    }
                                    $('select:not(.hide)', this.form).select2("destroy").select2();
                                    if ($('body').hasClass('stm-template-motorcycle')) {
                                        $('.stm_mc-found .number-found', this.form).text(data.total);
                                    }
                                } else {
                                    $('button[type="submit"] span', this.form).text(data.total);
                                }
                            };
                            SearchBox.prototype.complete = function () {
                                if (!this.listing) {
                                    $('.select2-container--default .select2-selection--single .select2-selection__arrow b', this.form).removeClass('stm-preloader');
                                    $('select, button[type="submit"]', this.form).prop("disabled", false);
                                }
                            };
                            var STMListings = new Object();
                            STMListings.SearchBox = SearchBox;
                            var stm_single_filter_link = false;
                            var stmIsotope;
                            var $container = $('.stm-isotope-sorting');
                            var stm_timeout_rental;
                            $(document).ready(function () {
                                $(document).on("click", '.stm-template-car_rental .form-row.terms a', function (event) {
                                    event.preventDefault();
                                });
                                if ($('body').hasClass('stm-template-rental-daypicker-page')) {
                                    $('select[name="pickup_location"]').on('change', function () {
                                        var locationId = $(this).select2("val");
                                        $.ajax({
                                            url: ajaxurl,
                                            type: "GET",
                                            dataType: 'json',
                                            context: this,
                                            data: 'rental_office_id=' + locationId + '&action=stm_ajax_rental_check_car_in_current_office',
                                            success: function (data) {
                                                $("#select-vehicle-popup").attr("href", $("#select-vehicle-popup").attr('href').split("?")[0] + "?pickup_location=" + locationId);
                                                if (data == 'EMPTY') {
                                                    clearTimeout(stm_timeout_rental);
                                                    $('.choose-another-class').addClass('single-add-to-compare-visible');
                                                    stm_timeout_rental = setTimeout(function () {
                                                        $('.choose-another-class').removeClass('single-add-to-compare-visible');
                                                    }, 5000);
                                                }
                                            }
                                        });
                                    });
                                }
                                stm_ajax_add_to_compare();
                                stm_ajax_remove_from_compare();
                                stm_ajax_filter_remove_hidden();
                                stm_ajax_add_test_drive();
                                stm_ajax_get_car_price();
                                stm_ajax_add_trade_offer();
                                clearFilter();
                                stm_filter_links();
                                stm_favourites();
                                loadMoreDealerCars();
                                loadMoreDealerReviews();
                                stm_sort_listing_cars();
                                stm_modern_filter_isotope();
                                $('body').on('click', '#modern-filter-listing .stm-clear-listing-one-unit', function (e) {
                                    var selectToClear = $(this).data('select');
                                    if (typeof selectToClear != 'undefined') {
                                        if (selectToClear != 'price' && $('select[name=' + selectToClear + ']').length > 0) {
                                            $('select[name=' + selectToClear + ']').val('').change();
                                        } else {
                                            var $priceRange = $('#stm-' + selectToClear + '-range');
                                            if ($priceRange.length > 0) {
                                                $priceRange.slider('values', [stmOptions_price.min, stmOptions_price.max]);
                                                $("#stm_filter_min_" + selectToClear).val(stmOptions_price.min);
                                                $("#stm_filter_max_" + selectToClear).val(stmOptions_price.max);
                                            }
                                        }
                                    }
                                });
                                $('body').on('click', '.stm-clear-listing-one-unit-classic', function () {
                                    var selectToClear = $(this).data('select');
                                    var clearLinkArg = $(this).data('url');
                                    if (typeof selectToClear != 'undefined') {
                                        if (selectToClear.indexOf('[')) {
                                            window.location = clearLinkArg;
                                            return false;
                                        }
                                        if (selectToClear != 'price' && $('select[name=' + selectToClear + ']').length > 0) {
                                            window.location = clearLinkArg;
                                        } else {


                                        }
                                    }
                                });
                            });

                            function stm_ajax_filter_remove_hidden() {
                                if ($('body').hasClass('stm-template-listing')) {
                                    $('.filter-listing.stm-vc-ajax-filter form').each(function () {
                                        new SearchBox(this);
                                    });
                                } else {
                                    $('.filter.stm-vc-ajax-filter select:not(.hide)').select2().on('change', function () {
                                        var $_form = $(this).closest('form');
                                        var stmUrl = $_form.attr('action');
                                        $.ajax({
                                            url: stmUrl,
                                            dataType: 'json',
                                            context: this,
                                            data: $_form.serialize() + '&ajax_action=listings-binding',
                                            beforeSend: function () {
                                                if (!$('body').hasClass('stm-template-listing')) {
                                                    $('.filter.stm-vc-ajax-filter select, .filter.stm-vc-ajax-filter button[type="submit"]').prop("disabled", true);
                                                    $('.select2-container--default .select2-selection--single .select2-selection__arrow b').addClass('stm-preloader');
                                                }
                                            },
                                            success: function (data) {
                                                if (!$('body').hasClass('stm-template-listing')) {
                                                    $('.select2-container--default .select2-selection--single .select2-selection__arrow b').removeClass('stm-preloader');
                                                    $('.filter.stm-vc-ajax-filter select, .filter.stm-vc-ajax-filter button[type="submit"]').prop("disabled", false);
                                                    if (typeof data.options != 'undefined') {
                                                        $.each(data.options, function (key, options) {
                                                            $('select[name=' + key + '] > option', $_form).each(function () {
                                                                var slug = $(this).val();
                                                                if (options.hasOwnProperty(slug)) {
                                                                    $(this).prop('disabled', options[slug].disabled);
                                                                }
                                                            });
                                                        });
                                                    }
                                                    $('.filter.stm-vc-ajax-filter select:not(.hide)').select2("destroy");
                                                    $('.filter.stm-vc-ajax-filter select:not(.hide)').select2();

                                                    if ($('body').hasClass('stm-template-motorcycle')) {
                                                        $('.stm_mc-found .number-found').text(data.total);
                                                    }
                                                } else {
                                                    $_form.find('button[type="submit"] span').text(data.total);
                                                }
                                            }
                                        });
                                        return false;
                                    });
                                }
                            }

                            function stm_ajax_add_to_compare() {
                                $(document).on('click', '.add-to-compare', function (e) {
                                    e.preventDefault();
                                    var dataId = $(this).attr('data-id');
                                    var dataAction = $(this).attr('data-action');
                                    if (typeof dataAction == 'undefined') {
                                        dataAction = 'add';
                                    }
                                    var stm_timeout;
                                    if (typeof dataId != 'undefined') {
                                        $.ajax({
                                            url: ajaxurl,
                                            type: "POST",
                                            dataType: 'json',
                                            data: '&post_id=' + dataId + '&post_action=' + dataAction + '&action=stm_ajax_add_to_compare',
                                            context: this,
                                            beforeSend: function (data) {
                                                $(this).addClass('disabled');
                                                clearTimeout(stm_timeout);
                                            },
                                            success: function (data) {
                                                $(this).removeClass('disabled');
                                                clearTimeout(stm_timeout);
                                                $('.single-add-to-compare').addClass('single-add-to-compare-visible');
                                                if (typeof data.response != 'undefined') {
                                                    $('.single-add-to-compare .stm-title').text(data.response);
                                                }
                                                if (typeof data.length != 'undefined') {
                                                    $('.stm-current-cars-in-compare').text(data.length);
                                                }
                                                stm_timeout = setTimeout(function () {
                                                    $('.single-add-to-compare').removeClass('single-add-to-compare-visible');
                                                }, 5000);
                                                if (data.status != 'danger') {
                                                    if (dataAction == 'remove') {
                                                        $(this).removeClass('stm-added');
                                                        $(this).html('<i class="stm-icon-add"></i>' + data.add_to_text);
                                                        $(this).removeClass('hovered');
                                                        $(this).attr('data-action', 'add');
                                                    } else {
                                                        $(this).addClass('stm-added');
                                                        $(this).html('<i class="stm-icon-added stm-unhover"></i><span class="stm-unhover">' + data.in_com_text + '</span><div class="stm-show-on-hover"><i class="stm-icon-remove"></i>' + data.remove_text + '</div>');
                                                        $(this).removeClass('hovered');
                                                        $(this).attr('data-action', 'remove');
                                                    }
                                                }
                                            }
                                        });
                                    }
                                });
                                var stm_timeout;
                                $(document).on('click', '.stm-user-public-listing .stm-listing-compare,.listing-list-loop.stm-listing-directory-list-loop .stm-listing-compare, .stm-gallery-action-unit.compare, .stm-compare-directory-new', function (e) {
                                    e.preventDefault();
                                    var stm_cookies = $.cookie();
                                    var stm_car_compare = [];
                                    var stm_car_add_to = $(this).data('id');
                                    var stm_car_title = $(this).data('title');
                                    for (var key in stm_cookies) {
                                        if (stm_cookies.hasOwnProperty(key)) {
                                            if (key.indexOf('compare_ids') > -1) {
                                                stm_car_compare.push(stm_cookies[key]);
                                            }
                                        }
                                    }
                                    var stm_compare_cars_counter = stm_car_compare.length;
                                    $.cookie.raw = true;
                                    if ($.inArray(stm_car_add_to.toString(), stm_car_compare) === -1) {
                                        if (stm_car_compare.length < 3) {
                                            $.cookie('compare_ids[' + stm_car_add_to + ']', stm_car_add_to, {
                                                expires: 7,
                                                path: '/'
                                            });
                                            $(this).addClass('active');
                                            stm_compare_cars_counter++;
                                            clearTimeout(stm_timeout);
                                            $('.single-add-to-compare .stm-title').text(stm_car_title + ' - ' + stm_added_to_compare_text);
                                            $('.single-add-to-compare').addClass('single-add-to-compare-visible');
                                            stm_timeout = setTimeout(function () {
                                                $('.single-add-to-compare').removeClass('single-add-to-compare-visible');
                                            }, 5000);
                                        } else {
                                            clearTimeout(stm_timeout);
                                            $('.single-add-to-compare .stm-title').text(stm_already_added_to_compare_text);
                                            $('.single-add-to-compare').addClass('single-add-to-compare-visible');
                                            stm_timeout = setTimeout(function () {
                                                $('.single-add-to-compare').removeClass('single-add-to-compare-visible');
                                                $('.single-add-to-compare').removeClass('overadded');
                                                $('.compare-remove-all').remove();
                                            }, 5000);
                                            $('.single-add-to-compare').addClass('overadded');
                                            $('.compare-remove-all').remove();
                                            $('.single-add-to-compare .compare-fixed-link').before('<a href="#" class="compare-fixed-link compare-remove-all pull-right heading-font">' + resetAllTxt + '</a>');
                                        }
                                    } else {
                                        $.removeCookie('compare_ids[' + stm_car_add_to + ']', {
                                            path: '/'
                                        });
                                        $(this).removeClass('active');
                                        stm_compare_cars_counter--;
                                        clearTimeout(stm_timeout);
                                        $('.single-add-to-compare .stm-title').text(stm_car_title + ' ' + stm_removed_from_compare_text);
                                        $('.single-add-to-compare').addClass('single-add-to-compare-visible');
                                        stm_timeout = setTimeout(function () {
                                            $('.single-add-to-compare').removeClass('single-add-to-compare-visible');
                                        }, 5000);
                                        $('.single-add-to-compare').removeClass('overadded');
                                        $('.compare-remove-all').remove();
                                    }
                                    $('.stm-current-cars-in-compare').text(stm_compare_cars_counter);
                                });
                                $(document).on('click', '.compare-remove-all', function () {
                                    var stm_cookies = $.cookie();
                                    for (var key in stm_cookies) {
                                        if (stm_cookies.hasOwnProperty(key)) {
                                            if (key.indexOf('compare_ids') > -1) {
                                                $.removeCookie(key, {
                                                    path: '/'
                                                });
                                            }
                                        }
                                    }
                                    location.reload();
                                });
                            }

                            function stm_favourites() {
                                $('body.logged-in').on('click', '.stm-listing-favorite, .stm-listing-favorite-action', function (e) {
                                    e.preventDefault();
                                    if ($(this).hasClass('disabled')) {
                                        return false;
                                    }
                                    $(this).toggleClass('active');
                                    var stm_car_add_to = $(this).data('id');
                                    $.ajax({
                                        url: ajaxurl,
                                        type: "POST",
                                        dataType: 'json',
                                        data: '&car_id=' + stm_car_add_to + '&action=stm_ajax_add_to_favourites',
                                        context: this,
                                        beforeSend: function (data) {
                                            $(this).addClass('disabled');
                                        },
                                        success: function (data) {
                                            if (data.count) {
                                                $('.stm-my-favourites span').text(data.count);
                                            }
                                            $(this).removeClass('disabled');
                                        }
                                    });
                                });
                                $('body.stm-user-not-logged-in').on('click', '.stm-listing-favorite, .stm-listing-favorite-action', function (e) {
                                    e.preventDefault();
                                    $(this).toggleClass('active');
                                    var stm_cookies = $.cookie();
                                    var stm_car_add_to = $(this).data('id');
                                    var stm_car_favourites = [];
                                    if (typeof (stm_cookies['stm_car_favourites']) != 'undefined') {
                                        stm_car_favourites = stm_cookies['stm_car_favourites'].split(',');
                                        var index = stm_car_favourites.indexOf(stm_car_add_to.toString());
                                        if (index !== -1) {
                                            stm_car_favourites.splice(index, 1);
                                        } else {
                                            stm_car_favourites.push(stm_car_add_to.toString());
                                        }
                                        stm_car_favourites = stm_car_favourites.join(',');
                                        $.cookie('stm_car_favourites', stm_car_favourites, {
                                            expires: 7,
                                            path: '/'
                                        });
                                    } else {
                                        $.cookie('stm_car_favourites', stm_car_add_to.toString(), {
                                            expires: 7,
                                            path: '/'
                                        });
                                    }
                                });
                            }

                            function stm_ajax_remove_from_compare() {
                                $(document).on('click', '.remove-from-compare', function (e) {
                                    e.preventDefault();
                                    var dataId = $(this).attr('data-id');
                                    var dataAction = $(this).attr('data-action');
                                    if (typeof dataId != 'undefined') {
                                        $.ajax({
                                            url: ajaxurl,
                                            type: "POST",
                                            dataType: 'json',
                                            data: '&post_id=' + dataId + '&post_action=' + dataAction + '&action=stm_ajax_add_to_compare',
                                            context: this,
                                            beforeSend: function (data) {
                                                $(this).addClass('loading');
                                                if (parseFloat($('.stm-current-cars-in-compare').text()) > 0) {
                                                    $('.stm-current-cars-in-compare').text(parseFloat($('.stm-current-cars-in-compare').text()) - 1);
                                                }
                                                $('.car-listing-row .compare-col-stm-' + dataId).hide('slide', {
                                                    direction: 'left'
                                                }, function () {
                                                    $('.car-listing-row .compare-col-stm-' + dataId).remove();
                                                    $('.car-listing-row').append($('.compare-empty-car-top').html());
                                                });
                                                $('.stm-compare-row .compare-col-stm-' + dataId).hide('slide', {
                                                    direction: 'left'
                                                }, function () {
                                                    $('.stm-compare-row .compare-col-stm-' + dataId).remove();
                                                    $('.stm-compare-row').append($('.compare-empty-car-bottom').html());
                                                });
                                                $('.row-compare-features .compare-col-stm-' + dataId).hide('slide', {
                                                    direction: 'left'
                                                }, function () {
                                                    $('.row-compare-features .compare-col-stm-' + dataId).remove();
                                                    if ($('.row-compare-features .col-md-3').length < 2) {
                                                        $('.row-compare-features').slideUp();
                                                    }
                                                });
                                            },
                                        });
                                    }
                                });
                            }

                            function stm_ajax_add_test_drive() {
                                $('#test-drive form').on("submit", function (event) {
                                    event.preventDefault();
                                    $.ajax({
                                        url: ajaxurl,
                                        type: "POST",
                                        dataType: 'json',
                                        context: this,
                                        data: $(this).serialize() + '&action=stm_ajax_add_test_drive',
                                        beforeSend: function () {
                                            $('.alert-modal').remove();
                                            $(this).closest('form').find('input').removeClass('form-error');
                                            $(this).closest('form').find('.stm-ajax-loader').addClass('loading');
                                        },
                                        success: function (data) {
                                            $(this).closest('form').find('.stm-ajax-loader').removeClass('loading');
                                            $(this).closest('form').find('.modal-body').append('<div class="alert-modal alert alert-' + data.status + ' text-left">' + data.response + '</div>')
                                            for (var key in data.errors) {
                                                $('#request-test-drive-form input[name="' + key + '"]').addClass('form-error');
                                            }
                                        }
                                    });
                                    $(this).closest('form').find('.form-error').live('hover', function () {
                                        $(this).removeClass('form-error');
                                    });
                                });
                            }

                            function stm_ajax_add_trade_offer() {
                                $('#trade-offer form').on("submit", function (event) {
                                    event.preventDefault();
                                    $.ajax({
                                        url: ajaxurl,
                                        type: "POST",
                                        dataType: 'json',
                                        context: this,
                                        data: $(this).serialize() + '&action=stm_ajax_add_trade_offer',
                                        beforeSend: function () {
                                            $('.alert-modal').remove();
                                            $(this).closest('form').find('input').removeClass('form-error');
                                            $(this).closest('form').find('.stm-ajax-loader').addClass('loading');
                                        },
                                        success: function (data) {
                                            $(this).closest('form').find('.stm-ajax-loader').removeClass('loading');
                                            $(this).closest('form').find('.modal-body').append('<div class="alert-modal alert alert-' + data.status + ' text-left">' + data.response + '</div>')
                                            for (var key in data.errors) {
                                                $('#request-trade-offer-form input[name="' + key + '"]').addClass('form-error');
                                            }
                                        }
                                    });
                                    $(this).closest('form').find('.form-error').live('hover', function () {
                                        $(this).removeClass('form-error');
                                    });
                                });
                            }

                            function stm_ajax_get_car_price() {
                                $('#get-car-price form').on("submit", function (event) {
                                    event.preventDefault();
                                    $.ajax({
                                        url: ajaxurl,
                                        type: "POST",
                                        dataType: 'json',
                                        context: this,
                                        data: $(this).serialize() + '&action=stm_ajax_get_car_price',
                                        beforeSend: function () {
                                            $('.alert-modal').remove();
                                            $(this).closest('form').find('input').removeClass('form-error');
                                            $(this).closest('form').find('.stm-ajax-loader').addClass('loading');
                                        },
                                        success: function (data) {
                                            $(this).closest('form').find('.stm-ajax-loader').removeClass('loading');
                                            $(this).closest('form').find('.modal-body').append('<div class="alert-modal alert alert-' + data.status + ' text-left">' + data.response + '</div>')
                                            for (var key in data.errors) {
                                                $('#get-car-price input[name="' + key + '"]').addClass('form-error');
                                            }
                                        }
                                    });
                                    $(this).closest('form').find('.form-error').live('hover', function () {
                                        $(this).removeClass('form-error');
                                    });
                                });
                            }

                            function clearFilter() {
                                $('.reset-all').click(function (e) {

                                        e.preventDefault();
                                        $(this).closest('.filter').find('select').trigger('reset');
                                    }

                                );
                            }

                            function stm_sort_listing_cars() {
                                if ($('#modern-filter-listing .stm-isotope-sorting').length) {
                                    if (typeof imagesLoaded == 'function') {
                                        $('.stm-isotope-sorting').imagesLoaded(function () {
                                            stmIsotope = $container.isotope({
                                                itemSelector: '.stm-isotope-listing-item',
                                                layoutMode: 'fitRows',
                                                hiddenStyle: {
                                                    opacity: 0
                                                },
                                                visibleStyle: {
                                                    opacity: 1
                                                },
                                                transitionDuration: '0.5s',
                                                getSortData: {
                                                    price: function (itemElem) {
                                                        var price = $(itemElem).data('price');
                                                        return parseFloat(price);
                                                    },
                                                    date: function (itemElem) {
                                                        var date = $(itemElem).data('date');
                                                        return parseFloat(date);
                                                    },
                                                    mileage: function (itemElem) {
                                                        var mileage = $(itemElem).data('mileage');
                                                        return parseFloat(mileage);
                                                    }
                                                }
                                            });
                                        });
                                    }

                                    $('#modern-filter-listing .stm-select-sorting select').select2().on('change', function () {
                                        stm_isotope_sort_function($(this).select2('val'));
                                    })
                                }
                            }

                            function stm_modern_filter_isotope() {
                                if ($('#modern-filter-listing').length > 0) {

                                    $('body').on('click', '.modern-filter-badges ul li i', function () {
                                        var tab_reset = $(this).data('select');
                                        if (tab_reset == 'price') {


                                            stmIso.isotope({
                                                filter: function () {
                                                    var itemPrice = $(this).data('price');

                                                    return parseInt(itemPrice, 10) >= stmOptions_price.min && parseInt(itemPrice, 10) <= stmOptions_price.max;
                                                }
                                            });

                                            price_string = '';

                                            $(this).closest('li').remove();
                                            var badges_length = $(".stm-filter-chosen-units-list li").length;
                                            if (badges_length < 1) $('.stm-filter-chosen-units-list').css({
                                                height: 0
                                            });

                                        } else if (typeof stmOptionsObj[tab_reset] !== 'undefined') {


                                            stmIso.isotope({
                                                filter: function () {
                                                    var itemPrice = $(this).data(tab_reset);
                                                    return parseInt(itemPrice, 10) >= stmOptionsObj[tab_reset].min && parseInt(itemPrice, 10) <= stmOptionsObj[tab_reset].max;
                                                }
                                            });
                                            dynamic_string[tab_reset] = '';
                                            $(this).closest('li').remove();
                                            var badges_length = $(".stm-filter-chosen-units-list li").length;
                                            if (badges_length < 1) $('.stm-filter-chosen-units-list').css({
                                                height: 0
                                            });
                                        } else {
                                            $('#' + tab_reset + ' input[type=checkbox]').each(function () {
                                                if ($(this).prop('checked')) {
                                                    $(this).trigger('click');
                                                }
                                            })
                                        }
                                        if (typeof stmIsotope != 'undefined') {
                                            var stmIsoData = stmIsotope.data('isotope');
                                            if (typeof stmIsoData != 'undefined') {
                                                if (typeof stmIsoData.filteredItems != 'undefined') {
                                                    $('.stm-modern-filter-found-cars span').text(stmIsoData.filteredItems.length);
                                                }
                                            }
                                        }
                                    });
                                    var stmSortClasses = '';
                                    var main_string = '';
                                    var price_string = '';
                                    var dynamic_string = new Object();
                                    var dynamic_string_html = '';
                                    var string = '';
                                    var stmIso = $('.stm-isotope-sorting');
                                    var stmFilterGroups = {};
                                    $('#modern-filter-listing input[type=checkbox]').click(function () {
                                        var badges = {};
                                        var badges_reset = {};
                                        stmFilterGroups = {};
                                        $(window).scroll();
                                        var stmFirst = 0;
                                        stmSortClasses = '';
                                        var numberOfCats = 0;
                                        $('#modern-filter-listing input[type=checkbox]').each(function () {
                                            var stmChecked = $(this).prop('checked');
                                            var stmCurrentClass = $(this).attr('name');
                                            var stmBadgeValue = $(this).data('name');
                                            var stmBadgeId = $(this).closest('.content').attr('id');
                                            var stmFilterCurrentGroup = $(this).closest('.collapse').attr('id');
                                            if (stmChecked) {
                                                var tab = $(this).closest('.stm-accordion-single-unit').find('.title h5').text();
                                                if (typeof badges[tab] == 'undefined') {
                                                    badges[tab] = [];
                                                }
                                                if (typeof badges_reset[tab] == 'undefined') {
                                                    badges_reset[tab] = '';
                                                }
                                                badges[tab].push(stmBadgeValue);
                                                badges_reset[tab] = stmBadgeId;
                                                if (stmFirst == 0) {
                                                    stmSortClasses += '.' + stmCurrentClass;
                                                } else {
                                                    stmSortClasses += '.' + stmCurrentClass;
                                                }
                                                stmFirst++;
                                                if (typeof (stmFilterGroups[stmFilterCurrentGroup]) == 'undefined') {
                                                    stmFilterGroups[stmFilterCurrentGroup] = [];
                                                }
                                                stmFilterGroups[stmFilterCurrentGroup].push(stmCurrentClass);
                                            }
                                            if (stmSortClasses == '') {
                                                stmSortClasses = '.all';
                                            }
                                        });
                                        if ($('.stm-isotope-sorting').length > 0 && stmSortClasses != '') {
                                            var matches = [];
                                            stmIso.isotope({
                                                filter: function () {
                                                    matches = [];
                                                    var itemPrice = $(this).data('price');
                                                    var minPrice = $('#stm_filter_min_price').val();
                                                    var maxPrice = $('#stm_filter_max_price').val();
                                                    if (Object.keys(stmFilterGroups).length > 0) {
                                                        for (var key in stmFilterGroups) {
                                                            if (stmFilterGroups.hasOwnProperty(key)) {
                                                                for (var k = 0; k < stmFilterGroups[key].length; k++) {
                                                                    var match = false;
                                                                    if ($(this).hasClass(stmFilterGroups[key][k])) {
                                                                        matches[key] = true;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        var final_match = false;
                                                        if (Object.keys(matches).length == Object.keys(stmFilterGroups).length) {
                                                            if (Object.keys(matches).length > 0) {
                                                                for (var m_key in matches) {
                                                                    if (matches.hasOwnProperty(m_key)) {
                                                                        if (matches[m_key]) {
                                                                            final_match = true;
                                                                        } else {
                                                                            final_match = false;
                                                                        }
                                                                    }
                                                                }
                                                            } else {
                                                                final_match = false;
                                                            }
                                                        }
                                                        if (final_match) {
                                                            if (typeof minPrice != 'undefined' && typeof maxPrice != 'undefined' && typeof itemPrice != 'undefined') {
                                                                return parseInt(itemPrice, 10) >= minPrice && parseInt(itemPrice, 10) <= maxPrice;
                                                            } else {
                                                                return ($(this));
                                                            }
                                                        }
                                                    } else {
                                                        return ($(this));
                                                    }
                                                }
                                            })
                                        }
                                        string = '';
                                        for (var key in badges) {
                                            if (badges.hasOwnProperty(key)) {
                                                if (badges.hasOwnProperty(key)) {
                                                    string += '<li><span>' + key + ':</span> ' + badges[key].join(', ');
                                                    if (badges_reset.hasOwnProperty(key)) {
                                                        string += '<i class="fa fa-close stm-clear-listing-one-unit" data-select="' + badges_reset[key] + '"></i>';
                                                    }
                                                    string += '</li>';
                                                    main_string = get_dynamic_badge_html(dynamic_string) + price_string + string;
                                                    $('.modern-filter-badges ul.stm-filter-chosen-units-list').html(main_string);
                                                }
                                            }
                                        }
                                        if ($.isEmptyObject(badges)) {
                                            main_string = get_dynamic_badge_html(dynamic_string) + price_string + string;
                                            $('.modern-filter-badges ul.stm-filter-chosen-units-list').html(main_string);
                                        };
                                        var badges_length = $(".stm-filter-chosen-units-list li").length;
                                        if (badges_length > 0) {
                                            var badgesWidth = 0;
                                            var badgesMargin = 15;
                                            var badgesRowWidth = $('.stm-filter-chosen-units-list').outerWidth();
                                            $('.stm-filter-chosen-units-list li').each(function () {
                                                badgesWidth += $(this).outerWidth();
                                            });
                                            badgesWidth += badgesMargin * (badges_length - 1);
                                            var row_number = (badgesWidth / badgesRowWidth) + 1;
                                            $('.stm-filter-chosen-units-list').css({
                                                height: (parseInt(row_number) * 47) + 'px'
                                            });
                                        } else {
                                            $('.stm-filter-chosen-units-list').css({
                                                height: 0
                                            });
                                        }
                                        if (typeof stmIsotope != 'undefined') {
                                            var stmIsoData = stmIsotope.data('isotope');
                                            if (typeof stmIsoData != 'undefined') {
                                                if (typeof stmIsoData.filteredItems != 'undefined') {
                                                    $('.stm-modern-filter-found-cars span').text(stmIsoData.filteredItems.length);
                                                }
                                            }
                                        }
                                    });


                                    $(".stm-modern-dynamic-slider").each(function () {
                                        var sliderIdent = $(this).data("slider-name");
                                        $(".stm-" + sliderIdent + "-range").on('slide', function (event, ui) {
                                            var minMileage = ui.values[0];
                                            var maxMileage = ui.values[1];
                                            stmIso.isotope({
                                                filter: function () {
                                                    var matches = [];
                                                    var itemMileage = $(this).data(sliderIdent);
                                                    if (Object.keys(stmFilterGroups).length > 0) {
                                                        for (var key in stmFilterGroups) {
                                                            if (stmFilterGroups.hasOwnProperty(key)) {
                                                                for (var k = 0; k < stmFilterGroups[key].length; k++) {
                                                                    var match = false;
                                                                    if ($(this).hasClass(stmFilterGroups[key][k])) {
                                                                        matches[key] = true;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        var final_match = false;
                                                        if (Object.keys(matches).length == Object.keys(stmFilterGroups).length) {
                                                            if (Object.keys(matches).length > 0) {
                                                                for (var m_key in matches) {
                                                                    if (matches.hasOwnProperty(m_key)) {
                                                                        if (matches[m_key]) {
                                                                            final_match = true;
                                                                        } else {
                                                                            final_match = false;
                                                                        }
                                                                    }
                                                                }
                                                            } else {
                                                                final_match = false;
                                                            }
                                                        }
                                                        if (final_match) {
                                                            if (typeof minMileage != 'undefined' && typeof maxMileage != 'undefined' && typeof itemMileage != 'undefined') {
                                                                return parseInt(itemMileage, 10) >= minMileage && parseInt(itemMileage, 10) <= maxMileage;
                                                            } else {
                                                                return parseInt(itemMileage, 10) >= minMileage && parseInt(itemMileage, 10) <= maxMileage;
                                                            }
                                                        }
                                                    } else {
                                                        return parseInt(itemMileage, 10) >= minMileage && parseInt(itemMileage, 10) <= maxMileage;
                                                    }
                                                }
                                            });
                                            if (typeof stmIsotope != 'undefined') {
                                                var stmIsoData = stmIsotope.data('isotope');
                                                if (typeof stmIsoData != 'undefined') {
                                                    if (typeof stmIsoData.filteredItems != 'undefined') {
                                                        $('.stm-modern-filter-found-cars span').text(stmIsoData.filteredItems.length);
                                                    }
                                                }
                                            }
                                            dynamic_string_html = '<li><span>' + sliderIdent + ':</span> ' + minMileage + ' - ' + maxMileage;
                                            dynamic_string_html += '<i class="fa fa-close stm-clear-listing-one-unit" data-select="' + sliderIdent + '"></i></li>';
                                            dynamic_string[sliderIdent] = dynamic_string_html;
                                            main_string = get_dynamic_badge_html(dynamic_string) + price_string + string;
                                            $('.modern-filter-badges ul.stm-filter-chosen-units-list').html(main_string);
                                            $('.stm-filter-chosen-units-list').height('47');
                                        });
                                    });
                                }
                            }

                            function get_dynamic_badge_html(dynamic_string) {
                                var dynamic_string_html = '';
                                $.each(dynamic_string, function (key, event) {
                                    dynamic_string_html += event;
                                });
                                return dynamic_string_html;
                            }

                            function stm_filter_links() {
                                $('body').on('click', '.stm-single-filter-link', function () {
                                    stm_single_filter_link = true;
                                    var stm_name = $(this).data('slug');
                                    var stm_value = $(this).data('value');
                                    if (typeof stm_name !== 'undefined' && typeof stm_value !== 'undefined') {
                                        $('.reset-all').trigger('click');
                                        $('#stm-filter-links-input').attr('name', stm_name);
                                        $('#stm-filter-links-input').val(stm_value);
                                    }
                                })
                            }
                            STMListings.save_user_settings = function () {
                                $('#stm_user_settings_edit.stm_save_user_settings_ajax').submit(function (e) {
                                    var formData = new FormData();
                                    formData.append('stm-avatar', $('input[name="stm-avatar"]')[0].files[0]);
                                    var formInputs = $(this).serializeArray();
                                    for (var key in formInputs) {
                                        if (formInputs.hasOwnProperty(key)) {
                                            formData.append(formInputs[key]['name'], formInputs[key]['value']);
                                        }
                                    }
                                    formData.append('action', 'stm_listings_ajax_save_user_data');
                                    e.preventDefault();
                                    $.ajax({
                                        type: "POST",
                                        url: ajaxurl,
                                        dataType: 'json',
                                        context: this,
                                        data: formData,
                                        contentType: false,
                                        processData: false,
                                        beforeSend: function () {
                                            $('.stm-user-message').empty();
                                            $(this).find('.stm-listing-loader').addClass('visible');
                                        },
                                        success: STMListings.save_user_settings_success
                                    });
                                })
                            };
                            STMListings.save_user_settings_success = function (data) {
                                $(this).find('.stm-listing-loader').removeClass('visible');
                                $('.stm-user-message').text(data.error_msg);
                                $('.stm-image-avatar img, .stm-dropdown-user-small-avatar img').attr('src', data.new_avatar);
                                if (data.new_avatar === '') {
                                    $('.stm-image-avatar').removeClass('hide-empty').addClass('hide-photo');
                                } else {
                                    $('.stm-image-avatar').addClass('hide-empty').removeClass('hide-photo');
                                }
                            };
                            STMListings.stm_logout = function () {
                                $('body').on('click', '.stm_logout a', function (e) {
                                    e.preventDefault();
                                    $.ajax({
                                        url: ajaxurl,
                                        type: "POST",
                                        dataType: 'json',
                                        context: this,
                                        data: {
                                            'action': 'stm_logout_user'
                                        },
                                        beforeSend: function () {
                                            $('.stm_add_car_form .stm-form-checking-user .stm-form-inner').addClass('activated');
                                        },
                                        success: function (data) {
                                            if (data.exit) {
                                                $('#stm_user_info').slideUp('fast', function () {
                                                    $(this).empty();
                                                    $('.stm-not-enabled, .stm-not-disabled').slideDown('fast');
                                                    $("html, body").animate({
                                                        scrollTop: $('.stm-form-checking-user').offset().top
                                                    }, "slow");
                                                });
                                                $('.stm-form-checking-user button[type="submit"]').removeClass('enabled').addClass('disabled');
                                            }
                                            $('.stm_add_car_form .stm-form-checking-user .stm-form-inner').removeClass('activated');
                                        }
                                    });
                                })
                            };
                            STMListings.stm_ajax_login = function () {
                                $('.lOffer-account-unit').mouseout(function () {
                                    $('.stm-login-form-unregistered').removeClass('working');
                                });
                                $('.stm-forgot-password a').click(function (e) {
                                    e.preventDefault();
                                    $('.stm_forgot_password_send').slideToggle();
                                    $('.stm_forgot_password_send input[type=text]').focus();
                                    $(this).toggleClass('active');
                                })
                                $(".stm-login-form-mobile-unregistered form,.stm-login-form form:not(.stm_password_recovery), .stm-login-form-unregistered form").submit(function (e) {
                                    e.preventDefault();
                                    if (!$(this).hasClass('stm_forgot_password_send')) {
                                        $.ajax({
                                            type: "POST",
                                            url: ajaxurl,
                                            dataType: 'json',
                                            context: this,
                                            data: $(this).serialize() + '&action=stm_custom_login',
                                            beforeSend: function () {
                                                $(this).find('input').removeClass('form-error');
                                                $(this).find('.stm-listing-loader').addClass('visible');
                                                $('.stm-validation-message').empty();
                                                if ($(this).parent('.lOffer-account-unit').length > 0) {
                                                    $('.stm-login-form-unregistered').addClass('working');
                                                }
                                            },
                                            success: function (data) {
                                                if ($(this).parent('.lOffer-account-unit').length > 0) {
                                                    $('.stm-login-form-unregistered').addClass('working');
                                                }
                                                if (data.user_html) {
                                                    var $user_html = $(data.user_html).appendTo('#stm_user_info');
                                                    $('.stm-not-disabled, .stm-not-enabled').slideUp('fast', function () {
                                                        $('#stm_user_info').slideDown('fast');
                                                    });
                                                    $("html, body").animate({
                                                        scrollTop: $('.stm-form-checking-user').offset().top
                                                    }, "slow");
                                                    $('.stm-add-a-car-login-overlay,.stm-add-a-car-login').toggleClass('visiblity');
                                                    $('.stm-form-checking-user button[type="submit"]').removeClass('disabled').addClass('enabled');
                                                }
                                                $(this).find('.stm-listing-loader').removeClass('visible');
                                                for (var err in data.errors) {
                                                    $(this).find('input[name=' + err + ']').addClass('form-error');
                                                }
                                                if (data.message) {
                                                    var message = $('<div class="stm-message-ajax-validation heading-font">' + data.message + '</div>').hide();
                                                    $(this).find('.stm-validation-message').append(message);
                                                    message.slideDown('fast');
                                                }
                                                if (typeof (data.redirect_url) !== 'undefined') {
                                                    window.location = data.redirect_url;
                                                }
                                            }
                                        });
                                    } else {
                                        $.ajax({
                                            type: "POST",
                                            url: ajaxurl,
                                            dataType: 'json',
                                            context: this,
                                            data: $(this).serialize() + '&action=stm_restore_password',
                                            beforeSend: function () {
                                                $(this).find('input').removeClass('form-error');
                                                $(this).find('.stm-listing-loader').addClass('visible');
                                                $('.stm-validation-message').empty();
                                            },
                                            success: function (data) {
                                                $(this).find('.stm-listing-loader').removeClass('visible');
                                                if (data.message) {
                                                    var message = $('<div class="stm-message-ajax-validation heading-font">' + data.message + '</div>').hide();
                                                    $(this).find('.stm-validation-message').append(message);
                                                    message.slideDown('fast');
                                                }
                                                for (var err in data.errors) {
                                                    $(this).find('input[name=' + err + ']').addClass('form-error');
                                                }
                                            }
                                        });
                                    }
                                });
                                $('.user_validated_field').hover(function () {
                                    $(this).removeClass('form-error');
                                });
                                $('input[name="stm_accept_terms"]').on('click', function () {
                                    if ($(this).is(':checked')) {
                                        $('.stm-login-register-form .stm-register-form form input[type="submit"]').removeAttr('disabled');
                                    } else {
                                        $('.stm-login-register-form .stm-register-form form input[type="submit"]').attr('disabled', '1');
                                    }
                                });
                            };

                            function loadMoreDealerCars() {
                                $('body').on('click', '.stm-load-more-dealer-cars a', function (e) {
                                    e.preventDefault();
                                    if ($(this).closest('.stm-load-more-dealer-cars').hasClass('not-clickable')) {
                                        return false;
                                    }
                                    var offset = $(this).attr('data-offset');
                                    var user_id = $(this).data('user');
                                    var popular = $(this).data('popular');
                                    var view_type = $('#stm_dealer_view_type').val();
                                    $.ajax({
                                        url: ajaxurl,
                                        data: {
                                            action: 'stm_ajax_dealer_load_cars',
                                            offset: offset,
                                            user_id: user_id,
                                            popular: popular,
                                            view_type: view_type
                                        },
                                        method: 'POST',
                                        dataType: 'json',
                                        context: this,
                                        beforeSend: function () {
                                            $(this).closest('.stm-load-more-dealer-cars').addClass('not-clickable');
                                        },
                                        success: function (data) {
                                            $(this).closest('.stm-load-more-dealer-cars').removeClass('not-clickable');
                                            if (data.html) {
                                                $(this).closest('.tab-pane').find('.car-listing-row').append(data.html);
                                            }
                                            if (data.new_offset) {
                                                $(this).attr('data-offset', data.new_offset);
                                            }
                                            if (data.button == 'hide') {
                                                $(this).closest('.stm-load-more-dealer-cars').slideUp();
                                                $(this).closest('.tab-pane').find('.row-no-border-last').removeClass('row-no-border-last');
                                            }
                                            $('img.lazy').lazyload({
                                                effect: "fadeIn",
                                                failure_limit: Math.max('img'.length - 1, 0)
                                            });
                                        }
                                    });
                                })
                            }

                            function loadMoreDealerReviews() {
                                $('body').on('click', '.stm-load-more-dealer-reviews a', function (e) {
                                    e.preventDefault();
                                    if ($(this).closest('.stm-load-more-dealer-reviews').hasClass('not-clickable')) {
                                        return false;
                                    }
                                    var offset = $(this).attr('data-offset');
                                    var user_id = $(this).data('user');
                                    $.ajax({
                                        url: ajaxurl,
                                        data: {
                                            action: 'stm_ajax_dealer_load_reviews',
                                            offset: offset,
                                            user_id: user_id,
                                        },
                                        method: 'POST',
                                        dataType: 'json',
                                        context: this,
                                        beforeSend: function () {
                                            $(this).closest('.stm-load-more-dealer-reviews').addClass('not-clickable');
                                        },
                                        success: function (data) {
                                            $(this).closest('.stm-load-more-dealer-reviews').removeClass('not-clickable');
                                            if (data.html) {
                                                $(this).closest('.tab-pane').find('#stm-dealer-reviews-units').append(data.html);
                                            }
                                            if (data.new_offset) {
                                                $(this).attr('data-offset', data.new_offset);
                                            }
                                            if (data.button == 'hide') {
                                                $(this).closest('.stm-load-more-dealer-reviews').slideUp();
                                            }
                                        }
                                    });
                                })
                            }
                            $('#stm_submit_review .button').on('click', function (e) {
                                e.preventDefault();
                                if (!$(this).hasClass('disabled')) {
                                    $.ajax({
                                        url: ajaxurl,
                                        dataType: 'json',
                                        context: this,
                                        data: $(this).closest('form').serialize() + '&action=stm_submit_review',
                                        beforeSend: function () {
                                            $(this).closest('form').find('.stm-icon-load1').addClass('activated');
                                            $('#write-review-message ').slideUp();
                                        },
                                        success: function (data) {
                                            $(this).closest('form').find('.stm-icon-load1').removeClass('activated');
                                            if (data.message) {
                                                $('#write-review-message ').text(data.message).slideDown();
                                            }
                                            if (data.updated) {
                                                window.location.href = data.updated;
                                                location.reload();
                                            }
                                        }
                                    });
                                }
                            })
                            $('.stm-comment-dealer-wrapper .stm-bottom .stm-report-review a').click(function (e) {
                                e.preventDefault();
                                if (!$(this).hasClass('reported')) {
                                    var stmID = $(this).data('id');
                                    $.ajax({
                                        type: "POST",
                                        url: ajaxurl,
                                        dataType: 'json',
                                        context: this,
                                        data: {
                                            'id': stmID,
                                            'action': 'stm_report_review'
                                        },
                                        beforeSend: function () {
                                            $(this).addClass('reported');
                                        },
                                        success: function (data) {
                                            if (data.message) {
                                                $(this).text(data.message);
                                            }
                                        }
                                    });
                                }
                            });
                            $('.dealer-search-title select').on('change', function () {
                                $('input[name="stm_sort_by"]').val($(this).val());
                                $("#stm_all_listing_tab").find("form").submit();
                            });
                            $('.stm-load-more-dealers').click(function (e) {
                                e.preventDefault();
                                if ($(this).hasClass('not-clickable')) {
                                    return false;
                                }
                                var offset = $(this).attr('data-offset');
                                $.ajax({
                                    url: currentAjaxUrl,
                                    dataType: 'json',
                                    context: this,
                                    data: $('.stm_dynamic_listing_dealer_filter form').serialize() + '&offset=' + offset + '&ajax_action=stm_load_dealers_list',
                                    beforeSend: function () {
                                        $(this).addClass('not-clickable');
                                    },
                                    success: function (data) {
                                        $(this).removeClass('not-clickable');
                                        if (data.user_html) {
                                            $('.dealer-search-results table tbody').append(data.user_html);
                                        }
                                        if (data.new_offset) {
                                            $('.stm-load-more-dealers').attr('data-offset', data.new_offset);
                                        }
                                        if (data.remove && data.remove === 'hide') {
                                            $(this).remove();
                                        }
                                    }
                                });
                            });
                            $('.stm-show-number').on("click", function () {
                                var parent = $(this).parent();
                                var phone_owner_id = $(this).attr("data-id");
                                $.ajax({
                                    url: ajaxurl,
                                    type: "GET",
                                    dataType: 'json',
                                    context: this,
                                    data: 'phone_owner_id=' + phone_owner_id + '&action=stm_ajax_get_seller_phone',
                                    success: function (data) {
                                        parent.find(".stm-show-number").hide();
                                        parent.find(".phone").html('<a href="tel:' + data + '">' + data + '</a>');
                                    }
                                });
                            });
                        })(jQuery)

                    })

                    $(document).ready(function () {
                        buildPriceFilter(
                            {{ $search_filterable['price']['min'] }},
                            {{ $search_filterable['price']['max'] }}
                        );

                        buildMileageFilter(
                            {{ $search_filterable['mileage']['min'] }},
                            {{ $search_filterable['mileage']['max'] }}
                        );

                        buildMarketDaysFilter(
                            {{ $search_filterable['market_days']['min'] }},
                            {{ $search_filterable['market_days']['max'] }}
                        );

                        $(document).on('change', 'input[name="make[]"]', function () {
                            let selected = [];
                            $('input[name="make[]"]:checked').each(function () {
                                selected.push($(this).val())
                            });
                            data.search.make = selected.join(',');
                            
                            vm.fetchProduct();
                        })

                        $(document).on('change', 'input[name="engine[]"]', function () {
                            let selected = [];
                            $('input[name="engine[]"]:checked').each(function () {
                                selected.push($(this).val())
                            });
                            data.search.engine = selected.join(',');
                            
                            vm.fetchProduct();
                        })

                        $(document).on('change', 'input[name="body[]"]', function () {
                            let selected = [];
                            $('input[name="body[]"]:checked').each(function () {
                                selected.push($(this).val())
                            });
                            data.search.body = selected.join(',');
                            
                            vm.fetchProduct();
                        })

                        $(document).on('click', '.transmission-options button', function() {
                            $('.transmission-options button').removeClass('active');
                            $(this).addClass('active');

                            let option = $(this).data('option');

                            data.search.transmission = option;
                            vm.fetchProduct();
                        })

                        $(document).on('change', 'input[name="transmission_speed[]"]', function () {
                            let selected = [];
                            $('input[name="transmission_speed[]"]:checked').each(function () {
                                selected.push($(this).val())
                            });
                            data.search.transmission_speed = selected.join(',');
                            vm.fetchProduct();
                        })

                        $(document).on('change', 'input[name="fule[]"]', function () {
                            let selected = [];
                            $('input[name="fule[]"]:checked').each(function () {
                                selected.push($(this).val())
                            });
                            data.search.fuel_type = selected.join(',');
                            vm.fetchProduct();
                        })

                        $(document).on('change', 'input[name="certified[]"]', function () {
                            let selected = [];
                            $('input[name="certified[]"]:checked').each(function () {
                                selected.push($(this).val())
                            });
                            data.search.certified = selected.join(',');
                            vm.fetchProduct();
                        })

                        $(document).on('change', 'input[name="passengercapacity[]"]', function () {
                            let selected = [];
                            $('input[name="passengercapacity[]"]:checked').each(function () {
                                selected.push($(this).val())
                            });
                            data.search.passengercapacity = selected.join(',');
                            vm.fetchProduct();
                        })

                        $(document).on('change', 'input[name="drivetrain[]"]', function () {
                            let selected = [];
                            $('input[name="drivetrain[]"]:checked').each(function () {
                                selected.push($(this).val())
                            });
                            data.search.drivetrain = selected.join(',');
                            vm.fetchProduct();
                        })

                        $(document).on('change', 'input[name="extcolor[]"]', function () {
                            let selected = [];
                            $('input[name="extcolor[]"]:checked').each(function () {
                                selected.push($(this).val())
                            });
                            data.search.extcolorhexcode = selected.join(',');
                            vm.fetchProduct();
                        })

                        $(document).on('change', 'input[name="intcolor[]"]', function () {
                            let selected = [];
                            $('input[name="intcolor[]"]:checked').each(function () {
                                selected.push($(this).val())
                            });
                            data.search.interiorcolor = selected.join(',');
                            vm.fetchProduct();
                        })

                        $(document).on('change', 'select[name="sortBy"]', function () {
                            data.search.sortBy = $(this).val();
                            vm.fetchProduct();
                        })

                        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

                            let field = $(this).data('type');
                            let value = $(this).data('value');

                            switch (field) {
                                case 'type':
                                    data.search.search_type = value
                                    break;

                            }

                        })



                        $("select").change(function (e) {
                            switch ($(this).data('change')) {
                                case 'searchmodel':
                                    searchmodel(this);
                                    break;
                                case 'searchmake':
                                    searchmake(this);
                                    break;
                                case 'searchbody':
                                    searchbody(this);
                                    break;
                                case 'searchdistance':
                                    searchdistance(this);
                                    break;
                            }
                        })

                        $('input[name="searchzip"]').blur(function () {
                            searchzip(this);
                        });

                        // $(".listing-list-loop a").click(function(e){
                        //     e.preventDefault();
                        //     let id = $(this).data('id')
                        //   if(id)
                        //     window.location.href = '{{ url("/") }}'+'/'+id+'/details';

                        // })

                    });





                    /*jQuery(document).ready(function($){
                        var data=[];
                        data={!! json_encode($search_filterable['makes_model']) !!};

                        console.log(data);

                        $("select[id$='make']").change(function(e){

                            var prefix = (this.id ==='usedmake')?'used':'new';

                            var make = this.value;

                            model=models(data,make);
                            if(make =='0' || make == '')
                            {
                                select=$('#'+prefix+'model');

                                for (var k=0;k<vm.model.length;k++) {
                                    select.append('<option value="' + vm.model[k].model + '">' + vm.model[k].model || "All Models"  + '</option>')
                                }
                            } else {
                                select=$('#'+prefix+'model');

                                select.html('<option value="">All Models</option>');
                                for (k in model) {
                                    select.append('<option value="' + model[k] + '">' + model[k] + '</option>')
                                }
                            }
                        });

                        $("select[id$='model']").change(function(e){
                            var prefix = (this.id==='usedmodel')?'used':'new';
                            var model = this.value;
                            if(model!=='0'){
                                make =data[model];

                                console.log(make)
                                select=$('#'+prefix+'make')
//                                .html('<option value="'+make+'">'+make+'</option>')
                                select.find('option:selected').removeAttr("selected");
                                $('#'+prefix+'make'+' option[value="'+make+'"]').attr('selected', 'selected');
                            }


                        });

                        function models(arr,make){
                            arr2 =[];
                            for(key in arr){
                                if(arr[key]===make){
                                    arr2.push(key);
                                }

                            }
                            return arr2;
                        }

                    }) ;*/
                })
            },

            app_base_url(row) {
                if ($.isEmptyObject(row.dealer))
                    return this.base_url;
                dealername = row.dealer['dealer_slug'].value === null ? 'car-dealer-solution' : row.dealer['dealer_slug'];

                return this.base_url + '/car/' + this.convertToSlug(row['make'], "make") + '/' + this.convertToSlug(row['model'], "model") + '/' + this.convertToSlug(row.dealer['city'], "city") + '/' + (dealername) + '/' + row.vin;

            },
            noimage() {
                return data.base_url + "/" + 'images/no-car.png';
            },
            convertToSlug(value, type) {
                if (!value || (value === undefined) || (value === "") || (value.length === 0)) {
                    return 'car-dealer-' + type;
                }

                return value
                    .toLowerCase()
                    .replace(/[^\w ]+/g, '')
                    .replace(/ +/g, '-');
            },
            loadmoreproducts(e) {
                //console.log(this.product.next_page_url)
                let that = this;
                let oldtext = $(e.target).text();
                $(e.target).text("Loading...")
                console.log(this.product.next_page_url + "&" + this.serialize())
                $.getJSON(this.product.next_page_url + "&" + this.serialize(), function (response) {

                    for (var field in response.product) {
                        if (field == 'data') {
                            if (that.product['data'].length) {
                                response.product.data = response.product.data.filter(function (row) {
                                    return !$.isEmptyObject(row.dealer);
                                });
                                response.product.data.map(function (o) {
                                    o.images.map(function (i) {
                                        i.image = i.image.replace(/^http:/i, "https:");
                                        //i.image = 'images/no-car.png';
                                        return i;
                                    });
                                    return o;
                                });

                                that.product['data'] = that.product['data'].concat(response.product.data);

                            }
                        } else {
                            if (field !== 'total')
                                that.product[field] = response.product[field];
                        }
                    }
                    if (that.product['data'].length == 0) {
                        $(e.target).text("No More Results");
                        return;
                    }
                    $(e.target).text(oldtext);
                })
            }

            ,
            searchmodel(ele) {
                console.log(ele)
            },

            searchmake() {
                console.log("ok")
            },
            searchbody(ele) {
                console.log(ele)
            },

            searchdistance(ele) {
                console.log(ele)
            },

            searchzip(ele) {
                console.log(ele)
            },

            price_change(price_min, price_max) {
                // console.log(price_min,price_max);
                // this.search.price_min = price_min;
                // this.search.price_max = price_max;
            },

            serialize() {
                var str = [];
                var obj = Object.assign({}, this.search);
                for (var p in obj)

                    if (obj.hasOwnProperty(p)) {
                        str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                    }
                return str.join("&");
            },

            fetchProduct() {
                let that = this;
                let nocarfound = base_url + '/images/car_not_found.png';
                $(".nocarfound").attr('src', base_url + '/images/CARloader.gif');

                $('.stm-ajax-row').addClass('stm-loading');
                $('.classic-filter-row .filter-sidebar .select2-container--default .select2-selection--single .select2-selection__arrow b').addClass('stm-preloader');

                $.getJSON('{{  url()->current() }}' + "?" + this.serialize(), function (response) {
                    $(".nocarfound").attr('src', nocarfound);
                    that.product = response.product;
                    $('.stm-ajax-row').removeClass('stm-loading');
                    $('.classic-filter-row .filter-sidebar .select2-container--default .select2-selection--single .select2-selection__arrow b').removeClass('stm-preloader');
                    $('.classic-filter-row .filter-sidebar select').prop("disabled", false);

                    that.selected_location = formatted_address;
                })


            }
        }
    })

    $(document).ready(function () {
        $(".cd-nav-trigger").click(function () {
            $('.sm-stm-ajax-row').toggle();
        });

        $(document).on('change', ".custom-checkbox", function () {
            $(this).parent().toggleClass('checked');
        });

    });

    $(document).ready(function () {

        $(".cd-nav-trigger").click(function () {
            $('#footer').toggle();
        });



        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            let search_type = $(e.target).data('type');
            let value = $(e.target).data('value');

            if (search_type)
                vm.search[search_type] = value;

        })



    });

    function searchmodel(ele) {
        data.search.search_model = $(ele).val();
        data.selected_model = $(ele).val();
        if (data.search.search_model === 'all') {
            data.search.search_model = '';
            data.selected_model = '';
        }

        data.search.search_body = '';
        data.search.body = '';
    }

    function searchmake(ele) {

        let l = $(ele).val();
        if (l == 'all') {
            l = '';
        }
        data.search.search_make = l;
        data.selected_make = l;
        data.search.search_model = '';
        data.selected_model = '';
        data.search.search_body = '';
        data.search.body = '';

        if ($('select[name=searchmodel]').data('select2')) {
            $("select[name=searchmodel]").select2('destroy').select2({
                maximumSelectionSize: 1,
                placeholder: "choose a model"
            });
        }



        $.ajax({
            type: 'POST',
            url: '{{route('getmodel')}}',
            data: {
                "_token": "{{ csrf_token() }}",
                "make": l,
            },
            beforeSend: function () {

                vm.model = [];
                vm.$forceUpdate();
            },
            success: function (mdl) {
                mdl.unshift({
                    model: 'all'
                });
                mdl.unshift({
                    model: ''
                });
                vm.model = mdl;
                vm.$forceUpdate();
                //                                data.search.search_model = data.model[0].model;
            },
            error: function () {
                data.search.search_model = '';
            }
        });


    }

    function searchbody(ele) {
        data.search.body = $(ele).val();
        vm.selected_body = data.search.body;
    }

    function searchdistance(ele) {
        data.search.search_distance = $(ele).val();
    }

    function searchzip(ele) {
        data.search.search_zip = $(ele).val();
    }

    function search() {
        let e = $("#exTab1 li.active").find('a[data-toggle="tab"]');
        let e2 = $("#exTab2 li.active").find('a[data-toggle="tab"]');

        if (e2.attr('id') == 'bycarused') {
            vm.search.body = '';
            vm.search.search_make = data.selected_make;
            vm.search.search_model = data.selected_model;
            //$("select[name=searchbody]").val('').trigger('change');
        } else if (e2.attr('id') == 'bybodyused') {
            vm.search.make = '';
            vm.search.model = '';
            vm.search.body = vm.selected_body;
            //                            vm.search.stm_lat = '';
            //                            vm.search.stm_lng = '';
            //vm.search.body = vm.selected_body;
            //stm_lat=43.9785759&stm_lng=-90.5040214
        }

        if (($("#stm-car-location-stm_all_listing_tab").val() == '') && (window.localStorage.getItem('latitude') === null) && (window.localStorage.getItem('longitude') === null)) {
            vm.search.stm_lat = '';
            vm.search.stm_lng = '';
            formatted_address = '';
        }

        let search_type = e.data('type');
        let value = e.data('value');

        if (search_type) {
            vm.search[search_type] = value;
            vm.search["search_type"] = value;
        }

        vm.fetchProduct();
    }    

    jQuery(document).ready(function ($) {
        $("#bycarused").click(function ($) {
            data.search.body = '';
        });

        $("#bybodyused").click(function ($) {
            data.search.search_make = '';
            data.search.search_model = '';
            data.search.body = vm.selected_body;
        });
        $("input[name='stm_lng']").val(pos ? pos.lng : '');
        $("input[name='stm_lat']").val(pos ? pos.lat : '');
    });

    function buildPriceFilter(min, max) {
        stmOptions_price = {
            range: true,
            min: min,
            max: max,
            values: [min, max],
            step: 1,
            slide: function (event, ui) {
                let newLabel = `$${formatNumber(ui.values[0])} - $${formatNumber(ui.values[1])}`;
                $('.price .slider-content .slider-label').html(newLabel);
            },
            stop: function (event, ui) {
                console.log(ui.values[0] + ',' + ui.values[1]);
                data.search.sellingprice = ui.values[0] + ',' + ui.values[1];
                vm.fetchProduct();
            }
        };

        $(".stm-price-range").slider(stmOptions_price);

        let initialLabel = `$${formatNumber(min)} - $${formatNumber(max)}`;
        $('.price .slider-content .slider-label').html(initialLabel);
    }

    function buildMarketDaysFilter(min, max) {
        stmOptions_MarketDays = {
            range: true,
            min: min,
            max: max,
            values: [min, max],
            step: 1,
            slide: function (event, ui) {
                let label = `${ui.values[0]} days - ${ui.values[1]} days`;
                $('.market-days .slider-content .slider-label').html(label);
            },
            stop: function (event, ui) {
                console.log(ui.values[0] + ',' + ui.values[1]);
                data.search.market_days = ui.values[0] + ',' + ui.values[1];                
                vm.fetchProduct();
            }
        };
        
        $(".market-days-slider").slider(stmOptions_MarketDays);

        let initialLabel = `${min} days - ${max} days`;
        $('.market-days .slider-content .slider-label').html(initialLabel);
    }

    function buildMileageFilter(min, max) {
        stmOptions_Mileage = {
            range: true,
            min: min,
            max: max,
            values: [min, max],
            step: 1,
            slide: function (event, ui) {
                let label = `${formatNumber(ui.values[0])} miles - ${formatNumber(ui.values[1])} miles`;
                $('.mileage .slider-content .slider-label').html(label);
            },
            stop: function (event, ui) {
                console.log(ui.values[0] + ',' + ui.values[1]);
                data.search.miles = ui.values[0] + ',' + ui.values[1];                
                vm.fetchProduct();
            }
        };
        
        $(".mileage-slider").slider(stmOptions_Mileage);

        let initialLabel = `${formatNumber(min)} miles - ${formatNumber(max)} miles`;
        $('.mileage .slider-content .slider-label').html(initialLabel);
    }

    function formatNumber(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }
</script>
