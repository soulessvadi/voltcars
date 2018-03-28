// OWL SLIDER
$(document).ready(function(){

    //$("html").niceScroll(); // NICESCROLL INIT
    // $('#img_wrap').niceScroll();

    

    //MAIN BANNER ON READY
    var owl = $(".owl-carousel"); // OWL INIT
    owl.owlCarousel({
        navigation : true, // Show next and prev buttons
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true
    });
    //SECONDARY BANNER ON READY
    $('.owl-carousel_1').owlCarousel({
        items: 3,
        navigation : true,
        loop: true,
        dotsEach: true
    });
    $('.owl-carousel_1 .owl-item:nth-child(5) .item').addClass('slide-act');
    $(".owl-carousel_1").on('changed.owl.carousel',function(property_t){
        $(property_t.target).find(".owl-item").find(".slide-act").removeClass('slide-act');
        $(property_t.target).find(".owl-item").eq(property_t.item.index + 1).find(".item").addClass('slide-act');  
    });
    $('.owl-carousel_1').fadeIn(300);

    // MAIN MOBILE BANNER ON READY

    var owl_m = $(".owl-carousel_m"); // OWL INIT
    owl_m.owlCarousel({
        navigation : true, // Show next and prev buttons
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true,
        loop:true
    });

    $('.owl-carousel_1 .owl-item:nth-child(5) .item').addClass('slide-act');
    $(".owl-carousel_1").on('changed.owl.carousel',function(property_t){
        $(property_t.target).find(".owl-item").find(".slide-act").removeClass('slide-act');
        $(property_t.target).find(".owl-item").eq(property_t.item.index + 1).find(".item").addClass('slide-act');  
    });

    $('.gallery button').first().addClass('active');





    owl.on('changed.owl.carousel',function(property){ // OWL ON CHANGE
        var cur_ban = $('.mb').parent('.active').find('.item');
        var cur_ban_id = $(cur_ban).data("id");
       
        console.log(cur_ban_id);
        var current = property.item.index;
        console.log(current);
        //console.log(current);
        $('#banner_secondary').html("<img src='img/ajax-loader.gif' alt='loader' class='ajax_loader' />");
        $.post(RS+'home/slideChange/', {value: current}, function(data, status) {
            if(status == "success"){
                $('#banner_secondary').html(data.html);
                $(".owl-carousel_"+current).owlCarousel({
                    items: 3,
                    navigation : true,
                    loop: true,
                    dotsEach: true
                });
                $('.owl-carousel_'+current+' .owl-item:nth-child(5) .item').addClass('slide-act');

                $(".owl-carousel_"+current).on('changed.owl.carousel',function(property_s){
                    $(property_s.target).find(".owl-item").find(".slide-act").removeClass('slide-act');
                    $(property_s.target).find(".owl-item").eq(property_s.item.index + 1).find(".item").addClass('slide-act');  
                });
            }else{
                console.log("Ajax Error")
            }  
        },"json");
    });

    // GALLERY
    $('body').flipLightBox();


    $('.hover.video p span').html("Смотреть больше");
    
});
  $(document).ready(function() { 
    $("a.fancyimage").fancybox(); 
  }); 

// PUSH AND POOL BLOCKS
$(function(){
    window_w = window.outerWidth;
    var top = "";
    var bot = "";
    top = $('.top_cont').html();
    bot = $('.bot_cont').html();
    window.onresize = function(){
        window_w = window.outerWidth;
        if (window_w <992) {
            $('.top_cont').html(bot);
            $('.bot_cont').html(top);
            $("#menu_btn").show(300);
        }else{
            $('.top_cont').html(top);
            $('.bot_cont').html(bot);
            $("#wrapper").removeClass("toggled");
            $("#menu_btn").hide(300);
        }
    }
    if (window_w <992) {
        $('.top_cont').html(bot);
        $('.bot_cont').html(top);
        $("#menu_btn").show(300);
    }else{
        $('.top_cont').html(top);
        $('.bot_cont').html(bot);
        $("#wrapper").removeClass("toggled");
        $("#menu_btn").hide(300);

        window.onscroll = function(){
            var v_distance = $(window).scrollTop();
            if (v_distance > 0) {
                $('.header').css({
                    borderBottom: "2px solid #ccc"
                });
            }else{
                $('.header').css({
                    border: 0
                });
            }
        }
    }
});


$("#menu_btn").click(function(e) {
    e.preventDefault();
    $("#wrapper").addClass("toggled");
    $('.mob_menu_header').css({left: 0});
    $("#menu_btn").hide(300);
    $('#sidebar-wrapper').scrollTop(0);
});


$(".dark-bg").click(function(e) {
    e.preventDefault();
    $("#wrapper").removeClass("toggled");
    $("#menu_btn").show(300);
});
$(".corner").click(function(e) {
    e.preventDefault();
    $("#wrapper").removeClass("toggled");
    $("#menu_btn").show(300);
});

var ajax = {
    contact_form: function(){
        $.post(RS+'contacts/contactForm/', $('#contact_form').serialize(), function(data, status){
            if (status=='success') {
                if (data.reason == 'name') {
                    $('#contact_form input[name="name"]').focus();
                    $('#contact_form .response').html(data.message);
                    $('#contact_form input[name="name"]').bind('input', function(){
                        $('#contact_form .response').html("");
                    });
                }
                if (data.reason == 'email') {
                    $('#contact_form input[name="email"]').focus();
                    $('#contact_form .response').html(data.message);
                    $('#contact_form input[name="email"]').bind('input', function(){
                        $('#contact_form .response').html("");
                    });
                }
                if (data.reason == 'message') {
                    $('#contact_form input[name="message"]').focus();
                    $('#contact_form .response').html(data.message);
                    $('#contact_form input[name="message"]').bind('input', function(){
                        $('#contact_form .response').html("");
                    });
                }

                if (data.status == 'success') {
                    $('#contact_form')[0].reset();
                    $('#contact_form .response').html(data.message);
                    setTimeout(function(){
                        $('#contact_form .response').html("");
                    }, 3000);
                }
            }
        }, 'json');
    },
    submit_td: function(){
        $.post(RS+'home/testDriveRequestForm/', $('#td_query_form').serialize(), function(data, status){
            if (status == 'success') {
                if (data.reason == 'name') {
                    //$('#td_query_form input[name="name"]').focus();
                    $('#td_query_form .response').html(data.message);
                    $('#td_query_form input[name="name"]').bind('input', function(){
                        $('#td_query_form .response').html("Мы подберем оптимальное для Вас время!");
                    });
                }
                if (data.reason == 'phone') {
                    //$('#td_query_form input[name="phone"]').focus();
                    $('#td_query_form .response').html(data.message);
                    $('#td_query_form input[name="phone"]').bind('input', function(){
                        $('#td_query_form .response').html("Мы подберем оптимальное для Вас время!");
                    });
                }
                if (data.status == 'success') {
                    $('#td_query_form')[0].reset();
                    $('#td_query_form .response').html(data.message);
                    setTimeout(function(){
                        $('#td_query_form .response').html("Мы подберем оптимальное для Вас время!");
                        $('.modal').modal('hide');
                    }, 3000);
                }
            }
        }, 'json');
    },
    submit_td2: function(){
        $.post(RS+'home/testDriveRequestForm/', $('#td_query_form_2').serialize(), function(data, status){
            if (status == 'success') {
                if (data.reason == 'name') {
                    //$('#td_query_form input[name="name"]').focus();
                    $('.td_response').html(data.message);
                    $('#td_query_form_2 input[name="name"]').bind('input', function(){
                        $('.td_response').html("");
                    });
                }
                if (data.reason == 'phone') {
                    //$('#td_query_form input[name="phone"]').focus();
                    $('.td_response').html(data.message);
                    $('#td_query_form_2 input[name="phone"]').bind('input', function(){
                        $('#.td_response').html("");
                    });
                }
                if (data.status == 'success') {
                    $('#td_query_form_2')[0].reset();
                    $('.td_response').html(data.message);
                    setTimeout(function(){
                        $('.td_response').html("");
                        $('.modal').modal('hide');
                    }, 3000);
                }
            }
        }, 'json');
    },
    submit_td3: function(){
        $.post(RS+'home/testDriveRequestForm/', $('#td_query_form_3').serialize(), function(data, status){
            if (status == 'success') {
                if (data.reason == 'name') {
                    //$('#td_query_form input[name="name"]').focus();
                    $('#td_query_form_3 .response').html(data.message);
                    $('#td_query_form_3 input[name="name"]').bind('input', function(){
                        $('#td_query_form_3 .response').html("Мы подберем оптимальное для Вас время!");
                    });
                }
                if (data.reason == 'phone') {
                    //$('#td_query_form input[name="phone"]').focus();
                    $('#td_query_form_3 .response').html(data.message);
                    $('#td_query_form_3 input[name="phone"]').bind('input', function(){
                        $('#td_query_form_3 .response').html("Мы подберем оптимальное для Вас время!");
                    });
                }
                if (data.status == 'success') {
                    $('#td_query_form_3')[0].reset();
                    $('#td_query_form_3 .response').html(data.message);
                    setTimeout(function(){
                        $('#td_query_form_3 .response').html("Мы подберем оптимальное для Вас время!");
                        $('.modal').modal('hide');
                    }, 3000);
                }
            }
        }, 'json');
    },
    load_gallery: function(button, gal){
        $('.gallery ul li button').removeClass('active');
        $(button).addClass('active');
        $('#img_wrap').html("<img src='"+RS+"img/ajax-loader.gif' alt='loader' class='ajax_loader' />");
        $.post(RS+'home/getGallery/', {value: gal}, function(data, status){
            if (status == 'success') {
                if (data.status == 'success') {
                    $('#img_wrap').html(data.html);
                    $('.gal_det_cap h4').html(data.caption);
                    $('.gal_det_cap span.det_target').html(data.det);
                    $('#img_wrap').niceScroll();
                }else{
                    console.log(data.message);
                }
            }
        }, 'json');
    },
    load_category: function(button, category){
        $('.catalog ul li button').removeClass('active');
        $(button).addClass('active');
        $('#catalog_scope').html("<img src='"+RS+"img/ajax-loader.gif' alt='loader' class='ajax_loader' />");

         $.post(RS+'Catalog/getCategoryProd/', {value: category}, function(data, status){
            if (status == 'success') {
                if (data.status == 'success') {
                    $('#catalog_scope').html(data.html);
                }else{
                    $('#catalog_scope').html(data.message);
                }
            }else{
                console.log("Ajax error");
            }
        }, 'json');
    },
    blog_search: function(){
        $('#catalog_scope').html("<img src='"+RS+"img/ajax-loader.gif' alt='loader' class='ajax_loader' />");
        $.post(RS+'Blog/blogSearch/', $('#blog_search').serialize(), function(data, status){
            if (status == 'success') {
                if (data.status == 'success') {
                    $('.blog p.response span').html(data.message);
                    $('#blog_scope').html(data.html);
                }else{
                    $('#blog_scope').html("");
                    $('.blog p.response span').html(data.message);
                }
            }else{
                console.log("Ajax error");
            }
        }, 'json');
    }
}

var locals = {
    cancel_td_modal: function(){
        $('#test_drive_modal').modal('hide');
    }
}

// BLOG SEARCH ON ENTER KEY PRESS
$(document).keyup(function (e) {
    if ($(".blog input[name='search_key']").is(":focus") && (e.keyCode == 13)) {
        ajax.blog_search();
    }
});

