/**
 * Main JS file for ferus-core
 * Author: Kael Steinert
 */
jQuery(document).ready(function ($) {

    /**
     * Lightbox
     */
    /*lightbox.option({
        'wrapAround': true
    });*/
    $('.lb-gallery').featherlightGallery();

    /**
     * Header Search
     * @type {*}
     */
    var search_holder = $('.header-search');
    if (search_holder) {
        var searchTrigger = search_holder.find('label[for="search_text"]');
        $(searchTrigger).click(function(){
            if (search_holder.hasClass('active')) {
                search_holder.removeClass('active');
            } else {
                search_holder.addClass('active');
            }
        });
    }
    /**
     * Homepage Slider
     */
    $('.home_slider').slick({
        infinite: true,
        dots: true,
        arrows: false,
        //autoplay: true,
        speed: 1000,
        autoplaySpeed: 4000,
        //fade: true,
    });
    /**
   * Testimonial Slider
   */
    $('.testimonial-slider > .elementor-column-wrap > .elementor-widget-wrap').slick({
        infinite: true,
        dots: true,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 12000,
        adaptiveHeight: true,
        fade: true,
    });
    /**
     * Slideset Logos
     */
    $('.logo-slideset .gallery').slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 300,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 650,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            }
        ]
    });
    /**
     * Gallery Slideset
     */
    $('.gallery-slideset').slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
    /**
     * Homepage Content Slider
     */
    $('.content_slider').slick({
        infinite: true,
        dots: false,
        arrows: true,
        fade: true,
        cssEase: 'linear'
    });
    /**
     * Slick Tab Slider
     * Usage: <button data-slide=3>GoTo Slide 3<button>
     */
    $('.tab-slider').slick({
        dots: false,
        arrows: false,
        speed: 800,
        infinite: true
    });
    $('.tab-slider').on('afterChange', function(event, slick, currentSlide){
        var holder = $(this).closest('section');
        var slideNumber = currentSlide;
        $(holder).find('.tab-slider-nav [data-slide]').removeClass('active');
        $(holder).find('.tab-slider-nav [data-slide="' + slideNumber + '"]').addClass('active');
    });
    $('.tab-slider-nav [data-slide]').click(function () {
        var holder = $(this).closest('section');
        var currentSlider = $(holder).find('.tab-slider');
        var slideNumber = $(this).attr("data-slide");
        var currentSlide = $(currentSlider).slick('slickCurrentSlide');
        $(currentSlider).slick('slickGoTo', slideNumber);
        if (slideNumber != currentSlide) {
            $(holder).find('.tab-slider-nav [data-slide]').removeClass('active');
        }
        $(this).addClass('active');
    });
    /**
     * Accordion
     */
    var allPanels = $('.accordion > [data-accordion=content]').hide();
    var activePanel = $('.accordion > [data-accordion=content].active').show();
    $('.accordion > [data-accordion=title]').click(function () {
        var target = $(this).next();
        var holder = $(this).closest('.accordion');
        var allPanelTitles = holder.find('> [data-accordion=title]');
        var allPanels = holder.find('[data-accordion=content]');

        if (!$(this).hasClass('active')) {
            allPanelTitles.removeClass('active');
            $(this).addClass('active');
        } else if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        }
        if (!target.hasClass('active')) {
            allPanels.removeClass('active').slideUp();
            target.addClass('active').slideDown();
        } else if (target.hasClass('active')) {
            target.removeClass('active').slideUp();
        }
        return false;
    });
    /**
     * Listing Gallery
     * @type {*}
     */
    var listingGallery = $('#listing-gallery');
    if (listingGallery) {
        var galleryView = listingGallery.find('#gallery-view');
        var galleryNavItems = listingGallery.find('#gallery-nav .thumb-item');
        listingGallery.find('#gallery-nav .thumb-item:first-of-type').addClass('active');
        $('#gallery-nav .thumb-item').click(function () {
            var image = $(this).attr('data-image');
            galleryNavItems.removeClass('active');
            $(this).addClass('active');
            galleryView.css('background-image', 'url(' + image + ')');
        });
    }
    /**
     * Listing Gallery Slideset
     */
    $('.prop-gallery-nav').slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 601,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 401,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }
        ]
    });
    /**
     * Condos Gallery Slideset
     */
    $('.condos-slideset').slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 501,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    /**
     * Toggle Floating Contact Form
     */
    var float_contact = $('#contact-float');
    if(float_contact){
        float_contact.find('.toggle').click(function () {
            if(float_contact.hasClass('active')){
                float_contact.removeClass('active');
                $(this).html('Chat Now! <i class="fa fa-envelope"></i>');
            } else {
                float_contact.addClass('active');
                $(this).html('Chat Now! <i class="fa fa-close"></i>');
            }
        });
        float_contact.find('.close').click(function () {
            if(float_contact.hasClass('active')){
                float_contact.removeClass('active');
            }
        });
    }

    // Set Cookie
    function setCookie(cname, cvalue, exdays, path) {
        var d = new Date();
        if (path){
            var path = path;
        } else {
            var path = "";
        }
        if (exdays != 'session') {
            d.setTime(d.getTime() + (exdays*24*60*60*1000));
            var expires = "expires="+d.toUTCString();
            document.cookie = cname + "=" + cvalue + "; " + expires + "; path=/" + path;
        } else {
            document.cookie = cname + "=" + cvalue + "; " + "; path=/" + path;
        }
    }
    // Get Cookie
    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
    // Cookie Enabled Modal
    function cookiePop(){
        var modalSession = getCookie("alert_banner");
        var url = window.location.href;
        if(url.indexOf('?welcome=1') != -1) {
            // query string activation
            //$('#news-modal').modal('show');
        } else {
            if (modalSession != "") {
                // Cookie Found | Don't Trigger Modal
                return false;
                //$('#alert-banner').alert('close');
            } else {
                // Cookie NOT Found | Trigger Modal
                $('#alert-banner').css('display','block');
                //$('#news-modal').modal('show');
            }
        }
    }cookiePop();
    // Set cookie after modal closes
    $('#alert-banner').on('closed.bs.alert', function () {
        setCookie("alert_banner", "value", 'session', "");
    });

});// END document.ready

/*************************************************************************/
/* Window.load  */
/*************************************************************************/
jQuery(window).load(function () {

    /**
     * Smooth Scroll
     */
    jQuery('a.smooth[href^="#"]:not([href="#"])').on('click', function (e) {
        e.preventDefault();
        var target = this.hash;
        var $target = jQuery(target);
        if (jQuery(window).width() > 767 && jQuery(window).width() < 991) {
            var $offset = $target.offset().top - 225;
        }
        else {
            var $offset = $target.offset().top - 180;
        }
        jQuery('html, body').stop().animate({
            'scrollTop': $offset
        }, 900, 'swing', function () {
            window.location.hash = target;
        });
    });

});/* END window.load */

/**
 * Proper Parallax
 */
function getTop(elem) {
    var box = elem.getBoundingClientRect();
    var body = document.body;
    var docEl = document.documentElement;
    var scrollTop = window.pageYOffset || docEl.scrollTop || body.scrollTop;
    var clientTop = docEl.clientTop || body.clientTop || 0;
    var top  = box.top +  scrollTop - clientTop;
    return Math.round(top);
}
function parallaxImages() {
    // Set the scroll for each parallax individually
    var plx = document.getElementsByClassName('parallax');
    for(i=0;i<plx.length;i++){
        var height = plx[i].clientHeight;
        var img = plx[i].getAttribute('data-plx-img');
        var plxImg = document.createElement("div");
        plxImg.className += " plx-img";
        plxImg.style.height = (height+(height/2))+'px';
        plxImg.style.backgroundImage = 'url('+ img +')';
        plx[i].insertBefore(plxImg, plx[i].firstChild);
    }
}
window.addEventListener('load', parallaxImages);
function plxScroll(){
    var scrolled = window.scrollY;
    var win_height_padded = window.innerHeight * 1.25;
    // Set the scroll for each parallax individually
    var plx = document.getElementsByClassName('parallax');
    for(i=0;i<plx.length;i++){
        var offsetTop = getTop(plx[i]);
        //var orientation = plx[i].getAttribute('data-plx-o');
        if (scrolled + win_height_padded >= offsetTop) {
            var plxImg = plx[i].getElementsByClassName('plx-img')[0];
            if(plxImg) {
                var plxImgHeight = plxImg.clientHeight;
                var singleScroll = (scrolled - offsetTop) - plxImgHeight/5;
                plxImg.style.top = (singleScroll / 5) + "px";
            }
        }
    }
}
window.addEventListener('load', plxScroll);
window.addEventListener('resize', plxScroll);
window.addEventListener('scroll', plxScroll);
/**
 * Elementor Parallax
 */

function ElementorParallaxImages() {
    // Set the scroll for each parallax individually
    var plx = document.getElementsByClassName('el-parallax');
    for(i=0;i<plx.length;i++){
        var height = plx[i].clientHeight;
        var plxImg = plx[i].getElementsByClassName('elementor-background-overlay')[0];
        plxImg.style.height = (height+(height/2))+'px';
    }
}
window.addEventListener('load', ElementorParallaxImages);
function ElementorPlxScroll(){
    var scrolled = window.scrollY;
    var win_height_padded = window.innerHeight * 1.25;
    // Set the scroll for each parallax individually
    var plx = document.getElementsByClassName('el-parallax');
    for(i=0;i<plx.length;i++){
        var offsetTop = getTop(plx[i]);
        if (scrolled + win_height_padded >= offsetTop) {
            var plxImg = plx[i].getElementsByClassName('elementor-background-overlay')[0];
            if(plxImg) {
                var plxImgHeight = plxImg.clientHeight;
                var singleScroll = (scrolled - offsetTop) - plxImgHeight/5;
                plxImg.style.top = (singleScroll / 5) + "px";
            }
        }
    }
}
window.addEventListener('load', ElementorPlxScroll);
window.addEventListener('resize', ElementorPlxScroll);
window.addEventListener('scroll', ElementorPlxScroll);
/**
 * Scroll Revealing Items
 */
var isScrolling = false;
window.addEventListener("scroll", throttleScroll);
function throttleScroll(e) {
    if (isScrolling == false) {
        window.requestAnimationFrame(function() {
            scrolling(e);
            isScrolling = false;
        });
    }
    isScrolling = true;
}
document.addEventListener("DOMContentLoaded", scrolling, false);

function scrolling(e) {
    var scrollItems = document.querySelectorAll("[data-reveal]");
    for (var i = 0; i < scrollItems.length; i++) {
        var scrollItem = scrollItems[i];
        var animationType = scrollItems[i].getAttribute('data-reveal');

        if (isPartiallyVisible(scrollItem)) {
            scrollItem.classList.add('animated', animationType);
        } /*else {
            scrollItem.classList.remove('animated', animationType);
        }*/
    }
}
function isPartiallyVisible(el) {
    var elementBoundary = el.getBoundingClientRect();
    var top = elementBoundary.top;
    var bottom = elementBoundary.bottom;
    var height = elementBoundary.height;

    return ((top + height >= 0) && (height + window.innerHeight >= bottom));
}
function isFullyVisible(el) {
    var elementBoundary = el.getBoundingClientRect();
    var top = elementBoundary.top;
    var bottom = elementBoundary.bottom;

    return ((top >= 0) && (bottom <= window.innerHeight));
}

/**
 * Location Map with Radius
 */
mapboxgl.accessToken = 'pk.eyJ1Ijoia2FlbHN0ZWluZXJ0IiwiYSI6ImNrbGNqNDhnYjBpODEyb29ieXhjZHQ2bDUifQ.tOZCvt-60dSTXstDAh2ccA';
const mapCenter = [-79.48264546626893, 37.66008850652548];
var mapContainer = document.getElementById('service-area-map');
if(mapContainer) {
    var map = new mapboxgl.Map({
        container: 'service-area-map',
        zoom: 7,
        center: mapCenter,
        style: 'mapbox://styles/mapbox/streets-v11'
    });
    // Add zoom and rotation controls to the map.
    map.addControl(new mapboxgl.NavigationControl());


    var createGeoJSONCircle = function(center, radiusInKm, points) {
        if(!points) points = 1164;

        var coords = {
            latitude: center[1],
            longitude: center[0]
        };

        var km = radiusInKm;

        var ret = [];
        var distanceX = km/(111.320*Math.cos(coords.latitude*Math.PI/180));
        var distanceY = km/110.574;

        var theta, x, y;
        for(var i=0; i<points; i++) {
            theta = (i/points)*(2*Math.PI);
            x = distanceX*Math.cos(theta);
            y = distanceY*Math.sin(theta);

            ret.push([coords.longitude+x, coords.latitude+y]);
        }
        ret.push(ret[0]);

        return {
            "type": "geojson",
            "data": {
                "type": "FeatureCollection",
                "features": [{
                    "type": "Feature",
                    "geometry": {
                        "type": "Polygon",
                        "coordinates": [ret]
                    }
                }]
            }
        };
    };

    // add the custom style layer to the map
    map.on('load', function () {
        map.addSource("polygon", createGeoJSONCircle(mapCenter, 70));
        map.addLayer({
            "id": "polygon",
            "type": "fill",
            "source": "polygon",
            "layout": {},
            "paint": {
                "fill-color": "#48c1f0",
                "fill-opacity": 0.33
            }
        });
    });
}// End: check for map wrapper