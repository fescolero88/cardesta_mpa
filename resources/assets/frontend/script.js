/* <![CDATA[ */
// var wc_add_to_cart_params = {"ajax_url":"\/classified\/wp-admin\/admin-ajax.php","wc_ajax_url":"http:\/\/motors.stylemixthemes.com\/classified\/?wc-ajax=%%endpoint%%","i18n_view_cart":"View cart","cart_url":"http:\/\/motors.stylemixthemes.com\/classified\/checkout\/","is_cart":"","cart_redirect_after_add":"no"};
// /* ]]> */
//
// /* <![CDATA[ */
// var subscriptio_vars = {"confirm_pause":"Are you sure you want to pause this subscription?","confirm_resume":"Are you sure you want to resume this subscription?","confirm_cancel":"Are you sure you want to cancel this subscription?"};
// /* ]]> */
//
//
// var stm_lang_code = 'en';
// var ajaxurl = 'http://motors.stylemixthemes.com/classified/wp-admin/admin-ajax.php';
var stm_site_blog_id = "2";
var stm_added_to_compare_text = "Added to compare";
var stm_removed_from_compare_text = "was removed from compare";
var stm_already_added_to_compare_text = "You have already added 3 cars";

window.a2a_config=window.a2a_config||{};a2a_config.callbacks=[];a2a_config.overlays=[];a2a_config.templates={};

function setREVStartSize(e){
    try{ var i=jQuery(window).width(),t=9999,r=0,n=0,l=0,f=0,s=0,h=0;
        if(e.responsiveLevels&&(jQuery.each(e.responsiveLevels,function(e,f){f>i&&(t=r=f,l=e),i>f&&f>r&&(r=f,n=e)}),t>r&&(l=n)),f=e.gridheight[l]||e.gridheight[0]||e.gridheight,s=e.gridwidth[l]||e.gridwidth[0]||e.gridwidth,h=i/s,h=h>1?1:h,f=Math.round(h*f),"fullscreen"==e.sliderLayout){var u=(e.c.width(),jQuery(window).height());if(void 0!=e.fullScreenOffsetContainer){var c=e.fullScreenOffsetContainer.split(",");if (c) jQuery.each(c,function(e,i){u=jQuery(i).length>0?u-jQuery(i).outerHeight(!0):u}),e.fullScreenOffset.split("%").length>1&&void 0!=e.fullScreenOffset&&e.fullScreenOffset.length>0?u-=jQuery(window).height()*parseInt(e.fullScreenOffset,0)/100:void 0!=e.fullScreenOffset&&e.fullScreenOffset.length>0&&(u-=parseInt(e.fullScreenOffset,0))}f=u}else void 0!=e.minHeight&&f<e.minHeight&&(f=e.minHeight);e.c.closest(".rev_slider_wrapper").css({height:f})
    }catch(d){console.log("Failure at Presize of Slider:"+d)}
};

(function($){
    $(document).ready(function(){
        var preview = $('.pearl-envato-preview');
        if (preview.length) {
            if (window.top == window.self) {
                $('.pearl-envato-preview').slideDown();
                $('.pearl-envato-preview-holder').slideDown();
                $('body').addClass('envato-preview-visible');
            }
        }

        $('.preview__action--close').on('click', function () {
            $('.pearl-envato-preview').slideUp();
            $('.pearl-envato-preview-holder').slideUp();
            $('body').removeClass('envato-preview-visible');

            if($('.stm-banner-image-filter').length > 0) {
                setTimeout(function(){
                    $('.stm-banner-image-filter').css('top', $('.stm-banner-image-filter').closest('.wpb_wrapper').offset().top + 'px');
                }, 400);
            }
        });

    })
})(jQuery);

var stmOptions_search_radius;
(function ($) {
    $(document).ready(function () {
        var stmMaxRadiusValue = 100;
        stmOptions_search_radius = {
            step: 1,
            min: 1,
            max: 100,
            value: 100,
            slide: function (event, ui) {
                $("#stm_slide_filter_max_search_radius").val(ui.value);
                var stmText = ui.value;

                $('.filter-search_radius .stm-current-slider-labels').html(stmText);
            }
        };
        $(".stm-search_radius-range").slider(stmOptions_search_radius);


        $("#stm_slide_filter_max_search_radius").val($(".stm-search_radius-range").slider("values", 1));

        $("#stm_slide_filter_max_search_radius").keyup(function () {
            $(".stm-search_radius-range").slider("values", 1, $(this).val());
        });

        $("#stm_slide_filter_max_search_radius").focusout(function () {
            if ($(this).val() > stmMaxRadiusValue) {
                $(".stm-search_radius-range").slider("values", 1, stmMaxRadiusValue);
                $(this).val(stmMaxRadiusValue);
            }
        });
    })
})(jQuery);


// var stmBannerArrow = new Vivus('stm-vivus-arrow', {
//     duration: 300,
//     type: 'delayed',
//     delay: 100,
//     animTimingFunction: Vivus['EASE_OUT'],
//     start: 'manual',
//     onReady: function (svgInit) {
//         jQuery(window).load(function () {
//             stmBannerArrow.play();
//         })
//     }
// });

jQuery(document).ready(function(){
    var $ = jQuery;
    var inputAuthor = '<input type="hidden" value="6" name="stm_changed_recepient"/>';
    $('.stm_listing_car_form form').append(inputAuthor);
});

// jQuery(document).ready(function ($) {

//     var jssor_1_SlideshowTransitions = [
//         {$Duration:1200,x:0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//         {$Duration:1200,x:-0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//         {$Duration:1200,x:-0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//         {$Duration:1200,x:0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//         {$Duration:1200,y:0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//         {$Duration:1200,y:-0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//         {$Duration:1200,y:-0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//         {$Duration:1200,y:0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//         {$Duration:1200,x:0.3,$Cols:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//         {$Duration:1200,x:0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//         {$Duration:1200,y:0.3,$Rows:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//         {$Duration:1200,y:0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//         {$Duration:1200,y:0.3,$Cols:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//         {$Duration:1200,y:-0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//         {$Duration:1200,x:0.3,$Rows:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//         {$Duration:1200,x:-0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//         {$Duration:1200,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//         {$Duration:1200,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//         {$Duration:1200,$Delay:20,$Clip:3,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//         {$Duration:1200,$Delay:20,$Clip:3,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//         {$Duration:1200,$Delay:20,$Clip:12,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
//         {$Duration:1200,$Delay:20,$Clip:12,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2}
//     ];

//     var jssor_1_options = {
//         $AutoPlay: 1,
//         $SlideshowOptions: {
//             $Class: $JssorSlideshowRunner$,
//             $Transitions: jssor_1_SlideshowTransitions,
//             $TransitionsOrder: 1
//         },
//         $ArrowNavigatorOptions: {
//             $Class: $JssorArrowNavigator$
//         },
//         $ThumbnailNavigatorOptions: {
//             $Class: $JssorThumbnailNavigator$,
//             $Cols: 10,
//             $SpacingX: 8,
//             $SpacingY: 8,
//             $Align: 360
//         }
//     };

//     var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

//     /*responsive code begin*/
//     /*remove responsive code if you don't want the slider scales while window resizing*/
//     function ScaleSlider() {
//         var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
//         if (refSize) {
//             refSize = Math.min(refSize, 800);
//             jssor_1_slider.$ScaleWidth(refSize);
//         }
//         else {
//             window.setTimeout(ScaleSlider, 30);
//         }
//     }
//     ScaleSlider();
//     $(window).bind("load", ScaleSlider);
//     $(window).bind("resize", ScaleSlider);
//     $(window).bind("orientationchange", ScaleSlider);
//     /*responsive code end*/
// });

jQuery(function ($) {
    var options = {"make":[],"serie":{"dependency":"make","allowAll":true,"options":[{"value":"3-serie-model","label":"3 Series","count":1,"deps":["bmw"]},{"value":"370z","label":"370Z","count":0,"deps":["nissan"]},{"value":"5-serie-model","label":"5 Series","count":1,"deps":["bmw"]},{"value":"7-series","label":"7 Series","count":0,"deps":["bmw"]},{"value":"accord","label":"Accord","count":1,"deps":["honda"]},{"value":"altima","label":"Altima","count":1,"deps":["nissan"]},{"value":"amg-gt","label":"AMG GT","count":0,"deps":["mercedes-benz"]},{"value":"avalon","label":"Avalon","count":1,"deps":["toyota"]},{"value":"brooklands","label":"Brooklands","count":0,"deps":["bentley"]},{"value":"c-class","label":"C-Class","count":1,"deps":["mercedes-benz"]},{"value":"camaro","label":"Camaro","count":0,"deps":["chevrolet"]},{"value":"camry","label":"Camry","count":1,"deps":["toyota"]},{"value":"civic","label":"Civic","count":1,"deps":["honda"]},{"value":"cla-class","label":"CLA-Class","count":0,"deps":["mercedes-benz"]},{"value":"cls-class","label":"CLS-Class","count":0,"deps":["mercedes-benz"]},{"value":"continental-gt","label":"Continental GT","count":0,"deps":["bentley"]},{"value":"corvette","label":"Corvette","count":0,"deps":["chevrolet"]},{"value":"cr-v","label":"CR-V","count":0,"deps":["honda"]},{"value":"cruze","label":"Cruze","count":2,"deps":["chevrolet"]},{"value":"cx-5","label":"CX-5","count":0,"deps":["mazda"]},{"value":"e-class","label":"E-Class","count":0,"deps":["mercedes-benz"]},{"value":"elantra","label":"Elantra","count":1,"deps":["hyundai"]},{"value":"es-300h","label":"ES 300h","count":0,"deps":["lexus"]},{"value":"explorer","label":"Explorer","count":0,"deps":["ford"]},{"value":"flying-spur","label":"Flying Spur","count":0,"deps":["bentley"]},{"value":"focus","label":"Focus","count":1,"deps":["ford"]},{"value":"g-class","label":"G-Class","count":0,"deps":["mercedes-benz"]},{"value":"genesis","label":"Genesis","count":0,"deps":["hyundai"]},{"value":"gs-350","label":"GS 350","count":0,"deps":["lexus"]},{"value":"gx-460","label":"GX 460","count":0,"deps":["lexus"]},{"value":"ilx","label":"ILX","count":0,"deps":["acura"]},{"value":"is-250-c","label":"IS 250 C","count":0,"deps":["lexus"]},{"value":"lc-hybrid","label":"LC HYBRID","count":0,"deps":["lexus"]},{"value":"malibu","label":"Malibu","count":1,"deps":["chevrolet"]},{"value":"model-x","label":"Model X","count":1,"deps":["tesla"]},{"value":"mulsanne","label":"Mulsanne","count":0,"deps":["bentley"]},{"value":"mustang","label":"Mustang","count":1,"deps":["ford"]},{"value":"optima","label":"Optima","count":0,"deps":["kia"]},{"value":"pilot","label":"Pilot","count":1,"deps":["honda"]},{"value":"rav4","label":"RAV4","count":0,"deps":["toyota"]},{"value":"rdx","label":"RDX","count":1,"deps":["acura"]},{"value":"rio","label":"Rio","count":1,"deps":["kia"]},{"value":"s-class","label":"S-Class","count":0,"deps":["mercedes-benz"]},{"value":"silverado","label":"Silverado","count":1,"deps":["chevrolet"]},{"value":"sorento","label":"Sorento","count":1,"deps":["kia"]},{"value":"soul","label":"Soul","count":1,"deps":["kia"]},{"value":"spark","label":"Spark","count":0,"deps":["chevrolet"]},{"value":"tacoma","label":"Tacoma","count":0,"deps":["toyota"]},{"value":"tahoe","label":"Tahoe","count":0,"deps":["chevrolet"]},{"value":"tlx","label":"TLX","count":0,"deps":["acura"]},{"value":"tuscon","label":"Tucson","count":0,"deps":["hyundai"]},{"value":"veloster","label":"Veloster","count":1,"deps":["hyundai"]},{"value":"versa","label":"Versa","count":0,"deps":["nissan"]}]}}, show_amount = true;

    if (show_amount) {
        $.each(options, function (tax, data) {
            $.each(data.options, function (val, option) {
                option.label += ' (' + option.count + ')';
            });
        });
    }

    // $('.stm-filter-tab-selects.filter').each(function () {
    //     new STMCascadingSelect(this, options);
    // });

    // $("select[data-class='stm_select_overflowed']").on("change", function () {
    //     var sel = $(this);
    //     var selValue = sel.val();
    //     var selType = sel.attr("data-sel-type");
    //     var min = 'min_' + selType;
    //     var max = 'max_' + selType;
    //     if (selValue.includes(">")) {
    //         var str = selValue.replace(">", "").trim();
    //         $("input[name='" + min + "']").val(str);
    //         $("input[name='" + max + "']").val("");
    //     } else if (selValue.includes("-")) {
    //         var strSplit = selValue.split("-");
    //         $("input[name='" + min + "']").val(strSplit[0]);
    //         $("input[name='" + max + "']").val(strSplit[1]);
    //     } else {
    //         var str = selValue.replace(">", "").trim();
    //         $("input[name='" + min + "']").val("");
    //         $("input[name='" + max + "']").val(str);
    //     }
    // });
});

// jQuery(document).ready(function(){
//
//     jQuery(".stm-car-photos-494").click(function() {
//         jQuery.fancybox.open([
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/10/motor-1.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/10/3_.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/10/4.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/10/5.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/10/6.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/10/7.jpg"
//             },
//         ], {
//             padding: 0
//         }); //open
//     });
// });

jQuery(document).ready(function(){

    jQuery(".stm-car-videos-494").click(function() {
        jQuery.fancybox.open([
            {
                href  : "https://www.youtube.com/embed/WoOF0gkUEP0"
            },
        ], {
            type: 'iframe',
            padding: 0
        }); //open
    }); //click
}); //ready

jQuery(document).ready(function(){
    jQuery(".stm-car-videos-494").click(function() {
        jQuery.fancybox.open([
            {
                href  : "https://www.youtube.com/embed/WoOF0gkUEP0"
            },
        ], {
            type: 'iframe',
            padding: 0
        }); //open
    }); //click
}); //ready

// jQuery(document).ready(function(){
//
//     jQuery(".stm-car-photos-1264").click(function() {
//         jQuery.fancybox.open([
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/1_3.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/220.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/6_.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/520.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/419.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/319.jpg"
//             },
//         ], {
//             padding: 0
//         }); //open
//     });
// });

jQuery(document).ready(function(){
    jQuery(".stm-car-videos-1264").click(function() {
        jQuery.fancybox.open([
            {
                href  : "https://www.youtube.com/embed/UT_qpv1Ezm4"
            },
        ], {
            type: 'iframe',
            padding: 0
        }); //open
    }); //click
}); //ready


// jQuery(document).ready(function(){
//
//     jQuery(".stm-car-photos-1265").click(function(e) {
//         e.preventDefault();
//         jQuery.fancybox.open([
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/221.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/122.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/420.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/320.jpg"
//             },
//         ], {
//             padding: 0
//         }); //open
//     });
// });

jQuery(document).ready(function(){

    jQuery(".stm-car-videos-1265").click(function(e) {
        e.preventDefault();
        jQuery.fancybox.open([
            {
                href  : "https://www.youtube.com/embed/twPP3krog98"
            },
            {
                href  : "https://www.youtube.com/embed/6Viyt2aIOG8"
            },
            {
                href  : "https://www.youtube.com/embed/Y58gaCcIFs8"
            },
            {
                href  : "https://www.youtube.com/embed/rkrEurIJi6E"
            },
        ], {
            type: 'iframe',
            padding: 0
        }); //open
    }); //click
}); //ready

// jQuery(document).ready(function(){
//
//     jQuery(".stm-car-photos-1264").click(function(e) {
//         e.preventDefault();
//         jQuery.fancybox.open([
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/1_3.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/220.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/6_.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/520.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/419.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/319.jpg"
//             },
//         ], {
//             padding: 0
//         }); //open
//     });
// });

jQuery(document).ready(function(){

    jQuery(".stm-car-videos-1264").click(function(e) {
        e.preventDefault();
        jQuery.fancybox.open([
            {
                href  : "https://www.youtube.com/embed/UT_qpv1Ezm4"
            },
        ], {
            type: 'iframe',
            padding: 0
        }); //open
    }); //click
}); //ready

// jQuery(document).ready(function(){
//
//     jQuery(".stm-car-photos-1235").click(function(e) {
//         e.preventDefault();
//         jQuery.fancybox.open([
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/tesla2.jpg"
//             },
//         ], {
//             padding: 0
//         }); //open
//     });
// });


// jQuery(document).ready(function(){
//
//     jQuery(".stm-car-photos-1195").click(function(e) {
//         e.preventDefault();
//         jQuery.fancybox.open([
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/71.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/64.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/513.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/412.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/312.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/212.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/2_1.jpg"
//             },
//         ], {
//             padding: 0
//         }); //open
//     });
// });

jQuery(document).ready(function(){

    jQuery(".stm-car-videos-1195").click(function(e) {
        e.preventDefault();
        jQuery.fancybox.open([
            {
                href  : "https://www.youtube.com/embed/2ZHEU32govA"
            },
        ], {
            type: 'iframe',
            padding: 0
        }); //open
    }); //click
}); //ready

// jQuery(document).ready(function(){
//
//     jQuery(".stm-car-photos-1123").click(function(e) {
//         e.preventDefault();
//         jQuery.fancybox.open([
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/13.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/7.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/61.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/53.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/4_.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/33.jpg"
//             },
//         ], {
//             padding: 0
//         }); //open
//     });
// });

jQuery(document).ready(function(){

    jQuery(".stm-car-videos-1123").click(function(e) {
        e.preventDefault();
        jQuery.fancybox.open([
            {
                href  : "https://www.youtube.com/embed/KuF4wPaSqcI"
            },
        ], {
            type: 'iframe',
            padding: 0
        }); //open
    }); //click
}); //ready

// jQuery(document).ready(function(){
//
//     jQuery(".stm-car-photos-1237").click(function(e) {
//         e.preventDefault();
//         jQuery.fancybox.open([
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/517.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/119.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/Toyota-Camry.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/Toyota-Camry_2015_.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/417.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/317.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/217.jpg"
//             },
//         ], {
//             padding: 0
//         }); //open
//     });
// });

// jQuery(document).ready(function(){
//
//     jQuery(".stm-car-photos-1236").click(function(e) {
//         e.preventDefault();
//         jQuery.fancybox.open([
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/516.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/316.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/67.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/516.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/416.jpg"
//             },
//         ], {
//             padding: 0
//         }); //open
//     });
// });


jQuery(document).ready(function(){

    jQuery(".stm-car-videos-1236").click(function(e) {
        e.preventDefault();
        jQuery.fancybox.open([
            {
                href  : "https://www.youtube.com/embed/bSrsirfMkYQ"
            },
        ], {
            type: 'iframe',
            padding: 0
        }); //open
    }); //click
}); //ready

// jQuery(document).ready(function(){
//
//     jQuery(".stm-car-photos-1117").click(function(e) {
//         e.preventDefault();
//         jQuery.fancybox.open([
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/12.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/52.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/42.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/22.jpg"
//             },
//         ], {
//             padding: 0
//         }); //open
//     });
// });

jQuery(document).ready(function(){

    jQuery(".stm-car-videos-1117").click(function(e) {
        e.preventDefault();
        jQuery.fancybox.open([
            {
                href  : "https://www.youtube.com/embed/eCCROU2NXWI"
            },
        ], {
            type: 'iframe',
            padding: 0
        }); //open
    }); //click
}); //ready

// jQuery(document).ready(function(){
//
//     jQuery(".stm-car-photos-1265").click(function(e) {
//         e.preventDefault();
//         jQuery.fancybox.open([
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/221.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/122.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/420.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/320.jpg"
//             },
//         ], {
//             padding: 0
//         }); //open
//     });
// });

jQuery(document).ready(function(){

    jQuery(".stm-car-videos-1265").click(function(e) {
        e.preventDefault();
        jQuery.fancybox.open([
            {
                href  : "https://www.youtube.com/embed/twPP3krog98"
            },
            {
                href  : "https://www.youtube.com/embed/6Viyt2aIOG8"
            },
            {
                href  : "https://www.youtube.com/embed/Y58gaCcIFs8"
            },
            {
                href  : "https://www.youtube.com/embed/rkrEurIJi6E"
            },
        ], {
            type: 'iframe',
            padding: 0
        }); //open
    }); //click
}); //ready

// jQuery(document).ready(function(){
//
//     jQuery(".stm-car-photos-1264").click(function(e) {
//         e.preventDefault();
//         jQuery.fancybox.open([
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/1_3.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/220.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/6_.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/520.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/419.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/319.jpg"
//             },
//         ], {
//             padding: 0
//         }); //open
//     });
// });

jQuery(document).ready(function(){

    jQuery(".stm-car-videos-1264").click(function(e) {
        e.preventDefault();
        jQuery.fancybox.open([
            {
                href  : "https://www.youtube.com/embed/UT_qpv1Ezm4"
            },
        ], {
            type: 'iframe',
            padding: 0
        }); //open
    }); //click
}); //ready

// jQuery(document).ready(function(){
//
//     jQuery(".stm-car-photos-1237").click(function(e) {
//         e.preventDefault();
//         jQuery.fancybox.open([
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/517.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/119.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/Toyota-Camry.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/Toyota-Camry_2015_.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/417.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/317.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/217.jpg"
//             },
//         ], {
//             padding: 0
//         }); //open
//     });
// });

// jQuery(document).ready(function(){
//
//     jQuery(".stm-car-photos-1236").click(function(e) {
//         e.preventDefault();
//         jQuery.fancybox.open([
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/516.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/316.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/67.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/516.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/416.jpg"
//             },
//         ], {
//             padding: 0
//         }); //open
//     });
// });

jQuery(document).ready(function(){

    jQuery(".stm-car-videos-1236").click(function(e) {
        e.preventDefault();
        jQuery.fancybox.open([
            {
                href  : "https://www.youtube.com/embed/bSrsirfMkYQ"
            },
        ], {
            type: 'iframe',
            padding: 0
        }); //open
    }); //click
}); //ready

// jQuery(document).ready(function(){
//
//     jQuery(".stm-car-photos-1235").click(function(e) {
//         e.preventDefault();
//         jQuery.fancybox.open([
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/tesla2.jpg"
//             },
//         ], {
//             padding: 0
//         }); //open
//     });
// });

// jQuery(document).ready(function(){
//
//     jQuery(".stm-car-photos-1221").click(function(e) {
//         e.preventDefault();
//         jQuery.fancybox.open([
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/314.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/Soul5.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/66.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/414.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/214.jpg"
//             },
//         ], {
//             padding: 0
//         }); //open
//     });
// });

jQuery(document).ready(function(){

    jQuery(".stm-car-videos-1221").click(function(e) {
        e.preventDefault();
        jQuery.fancybox.open([
            {
                href  : "https://www.youtube.com/embed/KiDguq1zXVo"
            },
        ], {
            type: 'iframe',
            padding: 0
        }); //open
    }); //click
}); //ready

// jQuery(document).ready(function(){
//
//     jQuery(".stm-car-photos-1213").click(function(e) {
//         e.preventDefault();
//         jQuery.fancybox.open([
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/115.jpg"
//             },
//         ], {
//             padding: 0
//         }); //open
//     });
// });


// jQuery(document).ready(function(){
//
//     jQuery(".stm-car-photos-1212").click(function(e) {
//         e.preventDefault();
//         jQuery.fancybox.open([
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/213.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/313.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/65.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/514.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/413.jpg"
//             },
//         ], {
//             padding: 0
//         }); //open
//     });
// });

jQuery(document).ready(function(){

    jQuery(".stm-car-videos-1212").click(function(e) {
        e.preventDefault();
        jQuery.fancybox.open([
            {
                href  : "https://www.youtube.com/embed/0OncLifkc8U"
            },
        ], {
            type: 'iframe',
            padding: 0
        }); //open
    }); //click
}); //ready

// jQuery(document).ready(function(){
//
//     jQuery(".stm-car-photos-1265").click(function(e) {
//         e.preventDefault();
//         jQuery.fancybox.open([
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/221.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/122.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/420.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/320.jpg"
//             },
//         ], {
//             padding: 0
//         }); //open
//     });
// });

jQuery(document).ready(function(){

    jQuery(".stm-car-videos-1265").click(function(e) {
        e.preventDefault();
        jQuery.fancybox.open([
            {
                href  : "https://www.youtube.com/embed/twPP3krog98"
            },
            {
                href  : "https://www.youtube.com/embed/6Viyt2aIOG8"
            },
            {
                href  : "https://www.youtube.com/embed/Y58gaCcIFs8"
            },
            {
                href  : "https://www.youtube.com/embed/rkrEurIJi6E"
            },
        ], {
            type: 'iframe',
            padding: 0
        }); //open
    }); //click
}); //ready

// jQuery(document).ready(function(){
//
//     jQuery(".stm-car-photos-1264").click(function(e) {
//         e.preventDefault();
//         jQuery.fancybox.open([
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/1_3.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/220.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/6_.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/520.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/419.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/319.jpg"
//             },
//         ], {
//             padding: 0
//         }); //open
//     });
// });

jQuery(document).ready(function(){

    jQuery(".stm-car-videos-1264").click(function(e) {
        e.preventDefault();
        jQuery.fancybox.open([
            {
                href  : "https://www.youtube.com/embed/UT_qpv1Ezm4"
            },
        ], {
            type: 'iframe',
            padding: 0
        }); //open
    }); //click
}); //ready

// jQuery(document).ready(function(){
//
//     jQuery(".stm-car-photos-1221").click(function(e) {
//         e.preventDefault();
//         jQuery.fancybox.open([
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/314.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/Soul5.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/66.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/414.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/214.jpg"
//             },
//         ], {
//             padding: 0
//         }); //open
//     });
// });

jQuery(document).ready(function(){

    jQuery(".stm-car-videos-1221").click(function(e) {
        e.preventDefault();
        jQuery.fancybox.open([
            {
                href  : "https://www.youtube.com/embed/KiDguq1zXVo"
            },
        ], {
            type: 'iframe',
            padding: 0
        }); //open
    }); //click
}); //ready

// jQuery(document).ready(function(){
//
//     jQuery(".stm-car-photos-1195").click(function(e) {
//         e.preventDefault();
//         jQuery.fancybox.open([
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/71.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/64.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/513.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/412.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/312.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/212.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/2_1.jpg"
//             },
//         ], {
//             padding: 0
//         }); //open
//     });
// });

jQuery(document).ready(function(){

    jQuery(".stm-car-videos-1195").click(function(e) {
        e.preventDefault();
        jQuery.fancybox.open([
            {
                href  : "https://www.youtube.com/embed/2ZHEU32govA"
            },
        ], {
            type: 'iframe',
            padding: 0
        }); //open
    }); //click
}); //ready

// jQuery(document).ready(function(){
//
//     jQuery(".stm-car-photos-1123").click(function(e) {
//         e.preventDefault();
//         jQuery.fancybox.open([
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/13.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/7.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/61.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/53.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/4_.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/33.jpg"
//             },
//         ], {
//             padding: 0
//         }); //open
//     });
// });

jQuery(document).ready(function(){

    jQuery(".stm-car-videos-1123").click(function(e) {
        e.preventDefault();
        jQuery.fancybox.open([
            {
                href  : "https://www.youtube.com/embed/KuF4wPaSqcI"
            },
        ], {
            type: 'iframe',
            padding: 0
        }); //open
    }); //click
}); //ready

// jQuery(document).ready(function(){
//
//     jQuery(".stm-car-photos-1117").click(function(e) {
//         e.preventDefault();
//         jQuery.fancybox.open([
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/12.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/52.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/42.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/12/22.jpg"
//             },
//         ], {
//             padding: 0
//         }); //open
//     });
// });

jQuery(document).ready(function(){

    jQuery(".stm-car-videos-1117").click(function(e) {
        e.preventDefault();
        jQuery.fancybox.open([
            {
                href  : "https://www.youtube.com/embed/eCCROU2NXWI"
            },
        ], {
            type: 'iframe',
            padding: 0
        }); //open
    }); //click
}); //ready

// jQuery(document).ready(function(){
//
//     jQuery(".stm-car-photos-516").click(function(e) {
//         e.preventDefault();
//         jQuery.fancybox.open([
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/11/nissan_altima_1.jpeg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/11/1.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/11/Nissan-Altima_5.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/11/Nissan-Altima_4.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/11/Nissan-Altima_2.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/11/Nissan-Altima7.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/11/Nissan-Altima_6.jpg"
//             },
//         ], {
//             padding: 0
//         }); //open
//     });
// });

jQuery(document).ready(function(){

    jQuery(".stm-car-videos-516").click(function(e) {
        e.preventDefault();
        jQuery.fancybox.open([
            {
                href  : "https://www.youtube.com/embed/YemTBeIT7Nc"
            },
        ], {
            type: 'iframe',
            padding: 0
        }); //open
    }); //click
}); //ready

// jQuery(document).ready(function(){
//
//     jQuery(".stm-car-photos-494").click(function(e) {
//         e.preventDefault();
//         jQuery.fancybox.open([
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/10/motor-1.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/10/3_.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/10/4.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/10/5.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/10/6.jpg"
//             },
//             {
//                 href  : "http://motors.stylemixthemes.com/classified/wp-content/uploads/sites/2/2015/10/7.jpg"
//             },
//         ], {
//             padding: 0
//         }); //open
//     });
// });

jQuery(document).ready(function(){

    jQuery(".stm-car-videos-494").click(function(e) {
        e.preventDefault();
        jQuery.fancybox.open([
            {
                href  : "https://www.youtube.com/embed/WoOF0gkUEP0"
            },
        ], {
            type: 'iframe',
            padding: 0
        }); //open
    }); //click
}); //ready

// jQuery(document).ready(function($) {
//     var counter_8131 = new countUp("counter_8131", 0, 15500, 0, 3, {
//         useEasing : true,
//         useGrouping: true,
//         separator : ''
//     });

//     $(window).scroll(function(){
//         if( $("#counter_8131").is_on_screen() ){
//             counter_8131.start();
//         }
//     });
// });

// jQuery(document).ready(function($) {
//     var counter_4308 = new countUp("counter_4308", 0, 1750, 0, 2.5, {
//         useEasing : true,
//         useGrouping: true,
//         separator : ''
//     });

//     $(window).scroll(function(){
//         if( $("#counter_4308").is_on_screen() ){
//             counter_4308.start();
//         }
//     });
// });

// jQuery(document).ready(function($) {
//     var counter_7848 = new countUp("counter_7848", 0, 3500, 0, 2, {
//         useEasing : true,
//         useGrouping: true,
//         separator : ''
//     });

//     $(window).scroll(function(){
//         if( $("#counter_7848").is_on_screen() ){
//             counter_7848.start();
//         }
//     });
// });

// jQuery(document).ready(function($) {
//     var counter_5989 = new countUp("counter_5989", 0, 250, 0, 1.5, {
//         useEasing : true,
//         useGrouping: true,
//         separator : ''
//     });

//     $(window).scroll(function(){
//         if( $("#counter_5989").is_on_screen() ){
//             counter_5989.start();
//         }
//     });
// });

// jQuery(document).ready(function ($) {
//     "use strict";
//
//     $(window).load(function () {
//         $("#frontend_customizer").animate({left: -233}, 300);
//     });
//
//     $('select[name="stm-select-layout"]').select2().on('change', function(){
//         $('html').addClass('stm-site-beforeloader');
//         window.location.href = $(this).val();
//     });
//
//     $("#frontend_customizer_button").on('click', function () {
//         if ($("#frontend_customizer").hasClass('open')) {
//             $("#frontend_customizer").animate({left: -233}, 300);
//             $("#frontend_customizer").removeClass('open');
//         } else {
//             $("#frontend_customizer").animate({left: 0}, 300);
//             $("#frontend_customizer").addClass('open');
//         }
//     });
//
//     $('body').on('click', function (kik) {
//         if (!$(kik.target).is('#frontend_customizer, #frontend_customizer *') && $('#frontend_customizer').is(':visible')) {
//             $("#frontend_customizer").animate({left: -233}, 300);
//             $("#frontend_customizer").removeClass('open');
//         }
//     });
//
//     var style_id = '';
//
//     $("#skin_color span").on('click', function () {
//         $('body').removeClass('stm_style_clr_' + style_id);
//         style_id = $(this).attr('id');
//         $('body').addClass('stm_style_clr_' + style_id);
//         var logo_num = $(this).data('logo');
//
//
//         var logo_url = 'http://motors.stylemixthemes.com/classified/wp-content/themes/motors/assets/images/tmp/logo' + logo_num + '.svg';
//         console.log(logo_url);
//
//         $("#skin_color .active").removeClass("active");
//
//         $(this).addClass("active");
//
//         $("#custom_style").remove();
//         $("#custom_style_listing").remove();
//
//         if( style_id != 'site_style_default' ){
//             $('#custom_style').remove();
//             $("head").append('<link rel="stylesheet" id="custom_style" href="http://motors.stylemixthemes.com/classified/wp-content/themes/motors/assets/css/'+style_id+'.css?v=4" type="text/css" media="all">');
//             $("head").append('<link rel="stylesheet" id="custom_style_listing" href="http://motors.stylemixthemes.com/classified/wp-content/themes/motors/assets/css/listing/'+style_id+'.css?v=4" type="text/css" media="all">');
//
//             $('#header .logo-main img').attr('src', logo_url);
//             $('#header .service-logo-main img').attr('src', logo_url);
//             $('#stm-boats-header .listing-logo-main img,.stm-boats-footer-logo').attr('src', logo_url);
//         } else {
//
//             $('#header .logo-main img').attr('src', logo_url);
//             $('#header .service-logo-main img').attr('src', logo_url);
//             $('#stm-boats-header .listing-logo-main img,.stm-boats-footer-logo').attr('src', logo_url);
//         }
//     });
//
//
//     $("#navigation_type").on("click", function () {
//         if ($(this).hasClass('active')) {
//             $(this).removeClass('active');
//
//             $('.header-nav').removeClass('header-nav-fixed');
//
//             $('.header-service').removeClass('header-service-sticky header-service-fixed');
//
//             $('.header-listing').removeClass('header-listing-fixed stm-fixed stm-fixed-invisible');
//         } else {
//             $(this).addClass('active');
//
//             $('.header-nav').addClass('header-nav-fixed');
//
//             $('.header-service').addClass('header-service-fixed');
//
//             $('.header-listing').addClass('header-listing-fixed');
//         }
//     });
//
//     $("#navigation_transparency").on("click", function () {
//         if ($(this).hasClass('active')) {
//             $(this).removeClass('active');
//
//             $('.header-nav').removeClass('header-nav-transparent');
//             $('.header-nav').addClass('header-nav-default');
//         } else {
//             $(this).addClass('active');
//
//             $('.header-nav').addClass('header-nav-transparent');
//             $('.header-nav').removeClass('header-nav-default');
//
//         }
//     });
//
//     $("#layout_mode").on("click", function () {
//         if ($(this).hasClass('active')) {
//             $(this).removeClass('active');
//
//             $('body').addClass('stm-boxed');
//             $('.customizer_boxed_background').slideDown();
//
//             $('body').addClass('stm-background-customizer-box_img_5');
//         } else {
//             $(this).addClass('active');
//
//             $('body').removeClass('stm-boxed');
//             $('.customizer_boxed_background').slideUp();
//
//             $('body').addClass('stm-background-customizer-box_img_5');
//         }
//     });
//
//     $('#background_image span').on('click', function(){
//         $('#background_image span').removeClass('active');
//         $(this).addClass('active');
//
//         var img_src = $(this).data('image');
//
//         $('body').removeClass('stm-background-customizer-box_img_1 stm-background-customizer-box_img_2 stm-background-customizer-box_img_3 stm-background-customizer-box_img_4 stm-background-customizer-box_img_5 stm-background-customizer-box_img_6');
//
//         $('body').addClass('stm-background-customizer-' + img_src);
//     });
//
// });

// var currentAjaxUrl = 'http://motors.stylemixthemes.com/classified/';
// var resetAllTxt = 'Reset All';
//
// /* <![CDATA[ */
// var wpcf7 = {"apiSettings":{"root":"http:\/\/motors.stylemixthemes.com\/classified\/wp-json\/contact-form-7\/v1","namespace":"contact-form-7\/v1"},"recaptcha":{"messages":{"empty":"Please verify that you are not a robot."}}};
// /* ]]> */
//
// /* <![CDATA[ */
// var sb_instagram_js_options = {"sb_instagram_at":""};
// /* ]]> */
//
// /* <![CDATA[ */
// var woocommerce_params = {"ajax_url":"\/classified\/wp-admin\/admin-ajax.php","wc_ajax_url":"http:\/\/motors.stylemixthemes.com\/classified\/?wc-ajax=%%endpoint%%"};
// /* ]]> */
//
// /* <![CDATA[ */
// var wc_cart_fragments_params = {"ajax_url":"\/classified\/wp-admin\/admin-ajax.php","wc_ajax_url":"http:\/\/motors.stylemixthemes.com\/classified\/?wc-ajax=%%endpoint%%","fragment_name":"wc_fragments_a178d32a282dbf47dc18976c122dcd4a"};
// /* ]]> */
//
// /* <![CDATA[ */
// var stm_i18n = {"remove_from_compare":"Remove from compare","remove_from_favorites":"Remove from favorites"};
// /* ]]> */

(function ($) {
    "use strict";

    $(document).ready(function () {
        var vehicle_price;
        var interest_rate;
        var down_payment;
        var period_month;

        var stmCurrency = "$";
        var stmPriceDel = " ";
        var stmCurrencyPos = "left";

        $('.calculate_loan_payment').click(function (e) {
            e.preventDefault();

            //Useful vars
            var current_calculator = $(this).closest('.stm_auto_loan_calculator');

            var calculator_alert = current_calculator.find('.calculator-alert');
            //First of all hide alert
            calculator_alert.removeClass('visible-alert');

            //4 values for calculating
            vehicle_price = parseFloat(current_calculator.find('input.vehicle_price').val());

            interest_rate = parseFloat(current_calculator.find('input.interest_rate').val());
            interest_rate = interest_rate / 1200;

            down_payment = parseFloat(current_calculator.find('input.down_payment').val());

            period_month = parseFloat(current_calculator.find('input.period_month').val());

            //Help vars

            var validation_errors = true;

            var monthly_payment = 0;
            var total_interest_payment = 0;
            var total_amount_to_pay = 0;

            //Check if not nan
            if (isNaN(vehicle_price)) {
                calculator_alert.text("Please fill Vehicle Price field");
                calculator_alert.addClass('visible-alert');
                current_calculator.find('input.vehicle_price').closest('.form-group').addClass('has-error');
                validation_errors = true;
            } else if (isNaN(interest_rate)) {
                calculator_alert.text("Please fill Interest Rate field");
                calculator_alert.addClass('visible-alert');
                current_calculator.find('input.interest_rate').closest('.form-group').addClass('has-error');
                validation_errors = true;
            } else if (isNaN(period_month)) {
                calculator_alert.text("Please fill Period field");
                calculator_alert.addClass('visible-alert');
                current_calculator.find('input.period_month').closest('.form-group').addClass('has-error');
                validation_errors = true;
            } else if (isNaN(down_payment)) {
                calculator_alert.text("Please fill Down Payment field");
                calculator_alert.addClass('visible-alert');
                current_calculator.find('input.down_payment').closest('.form-group').addClass('has-error');
                validation_errors = true;
            } else if (down_payment > vehicle_price) {
                //Check if down payment is not bigger than vehicle price
                calculator_alert.text("Down payment can not be more than vehicle price");
                calculator_alert.addClass('visible-alert');
                current_calculator.find('input.down_payment').closest('.form-group').addClass('has-error');
                validation_errors = true;
            } else {
                validation_errors = false;
            }

            if (!validation_errors) {
                var interest_rate_unused = interest_rate;

                if(interest_rate == 0) {
                    interest_rate_unused = 1;
                }
                monthly_payment = (vehicle_price - down_payment) * interest_rate_unused * Math.pow(1 + interest_rate, period_month);
                var monthly_payment_div = ((Math.pow(1 + interest_rate, period_month)) - 1);
                if(monthly_payment_div == 0) {
                    monthly_payment_div = 1;
                }

                monthly_payment = monthly_payment/monthly_payment_div;
                monthly_payment = monthly_payment.toFixed(2);

                total_amount_to_pay = down_payment + (monthly_payment*period_month);
                total_amount_to_pay = total_amount_to_pay.toFixed(2);

                total_interest_payment = total_amount_to_pay - vehicle_price;
                total_interest_payment = total_interest_payment.toFixed(2);

                current_calculator.find('.stm_calculator_results').slideDown();
                current_calculator.find('.monthly_payment').text(stm_get_price_view(monthly_payment, stmCurrency, stmCurrencyPos, stmPriceDel ));
                current_calculator.find('.total_interest_payment').text(stm_get_price_view(total_interest_payment, stmCurrency, stmCurrencyPos, stmPriceDel ));
                current_calculator.find('.total_amount_to_pay').text(stm_get_price_view(total_amount_to_pay, stmCurrency, stmCurrencyPos, stmPriceDel ));
            } else {
                current_calculator.find('.stm_calculator_results').slideUp();
                current_calculator.find('.monthly_payment').text('');
                current_calculator.find('.total_interest_payment').text('');
                current_calculator.find('.total_amount_to_pay').text('');
            }
        })

        $(".numbersOnly").on("keypress keyup blur", function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }

            if ($(this).val() != '') {
                $(this).closest('.form-group').removeClass('has-error');
            }
        });
    });

})(jQuery);

var stm_footer_terms = ["Certified Used","New","Used","Acura","BMW","Chevrolet","Ford","Honda","Hyundai","Kia","Mercedes-Benz","Nissan","Tesla","Toyota","3 Series","5 Series","Accord","Altima","Avalon","C-Class","Camry","Civic","Cruze","Elantra","Focus","Malibu","Model X","Mustang","Pilot","RDX","Rio","Silverado","Sorento","Soul","Veloster","Diesel","Electric","Ethanol","Fuel","Gasoline","Hybrid","LPG Autogas","1990","2000","2005","2010","2015","4WD","AWD","FWD","RWD","Deep Blue Pearl","Midnight Silver Metallic","Obsidian Black Metallic","Pearl White","Red Multi-Coat","Silver Metallic","Solid Black","Solid White","Titanium Metallic","Beige","Brown","Grey","Jet Black","Jet Red","Multi-pattern"];
var stm_footer_terms_slugs = ["certified-used","new-cars","used-cars","acura","bmw","chevrolet","ford","honda","hyundai","kia","mercedes-benz","nissan","tesla","toyota","3-serie-model","5-serie-model","accord","altima","avalon","c-class","camry","civic","cruze","elantra","focus","malibu","model-x","mustang","pilot","rdx","rio","silverado","sorento","soul","veloster","diesel","electric","biofuels-biodiesel-and-bioethanol","fuel","petrol","premium-petrol","lpg-autogas","1990","2000","2005","2010","2015","4wd","awd","fwd","rwd","deep-blue-pearl","midnight-silver-metallic","obsidian-black-metallic","deep-red","rich-black","silver-metallic","solid-black","solid-white","titanium-metallic","beige","brown","grey","jet-black","jet-red","multi-pattern"];
var stm_footer_taxes = ["condition","condition","condition","make","make","make","make","make","make","make","make","make","make","make","serie","serie","serie","serie","serie","serie","serie","serie","serie","serie","serie","serie","serie","serie","serie","serie","serie","serie","serie","serie","serie","fuel","fuel","fuel","fuel","fuel","fuel","fuel","ca-year","ca-year","ca-year","ca-year","ca-year","drive","drive","drive","drive","exterior-color","exterior-color","exterior-color","exterior-color","exterior-color","exterior-color","exterior-color","exterior-color","exterior-color","interior-color","interior-color","interior-color","interior-color","interior-color","interior-color"];
var stm_default_search_value = "";
jQuery(document).ready(function(){
    var $ = jQuery;
    $('.stm-footer-search-name-input').focus(function(){
        $(this).closest('.stm-footer-search-inventory').addClass('active');
    });

    $('.stm-footer-search-name-input').blur(function(){
        $(this).closest('.stm-footer-search-inventory').removeClass('active');
    });
});