var ajaxloader = '<div id="ajaxloader" class="spinner-4"><div class="spinner ajaxloader"></div></div>';

var loader = {
    start: function() {
        $('body').append(ajaxloader);
    },
    stop: function() {
        $('#ajaxloader').remove();
    },
    nomore: function() {
//        var ajaxloader = '<div id="ajaxloader"><div class="fix-animate-loader-center animation-hatch">No More Post To Show</div></div>';
//        $('body').append(ajaxloader);
        $('#ajaxloader').remove();
    }
};

function validateEmail(sEmail) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(sEmail)) {
        return true;
    }
    else {
        return false;
    }
}

/*-------------
 * 
 * @string str
 * ex: validation.isEmailAddress(str)
 * ex: validation.isNotEmpty(str)
 * ex: validation.isNumber(str)
 * ex: validation.isSame(str1, str2)
 */
var validation = {
    isEmailAddress: function(str) {
        var pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        return pattern.test(str);  // returns a boolean
    },
    isNotEmpty: function(str) {
        var pattern = /\S+/;
        return pattern.test(str);  // returns a boolean
    },
    isNumber: function(str) {
        var pattern = /^\d+$/;
        return pattern.test(str);  // returns a boolean
    },
    isSame: function(str1, str2) {
        return str1 === str2;
    }
};

/*--------------------------
 * scroll up down detect
 */
var scroll = {
    detect: function(div_id) {
        var mousewheelevt = (/Firefox/i.test(navigator.userAgent)) ? "DOMMouseScroll" : "mousewheel" //FF doesn't recognize mousewheel as of FF3.x
        $(div_id).bind(mousewheelevt, function(e) {

            var evt = window.event || e //equalize event object     
            evt = evt.originalEvent ? evt.originalEvent : evt; //convert to originalEvent if possible               
            var delta = evt.detail ? evt.detail * (-40) : evt.wheelDelta //check for detail first, because it is used by Opera and FF

            if (delta > 0) {
                //scroll up
                return 'up';
            }
            else {
                //scroll down
                return 'down';
            }
        });
    }
};

$(function() {
    // close popover when click outside
    $('[data-toggle="popover"]').popover();

    $('body').on('click', function(e) {
        $('[data-toggle="popover"]').each(function() {
            //the 'is' for buttons that trigger popups
            //the 'has' for icons within a button that triggers a popup
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                $(this).popover('hide');
            }
        });
    });

    $('body').on('click', function(e) {
        $('[data-toggle="popover"]').each(function() {
            //the 'is' for buttons that trigger popups
            //the 'has' for icons within a button that triggers a popup
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                $(this).popover('hide');
            }
        });
    });
});

/*  
 * serializeObject
 * EX: $('#result').text(JSON.stringify($('form').serializeObject()));  
 */
$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] || o[this.name] == '') {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

function response_message(message) {
    var err_mes = $.parseJSON(message);
    if (err_mes[0].CODE == 'ERR') {
        bootbox.alert(err_mes[0].MESS, function() {
        }).find("div.modal-dialog").addClass("largeWidth");
    } else {
        $('#myavatar').attr('src', err_mes[0].MESS);
    }
    loader.stop();
}

var cryout_toTop_offset = 1300;
var offset = 100;
var duration = 500;
var top_offset = 10;
jQuery(window).scroll(function() {
    if (jQuery(this).scrollTop() > offset) {
        jQuery('#toTop').css({'margin-left': '' + cryout_toTop_offset + 'px', 'opacity': 0.5});
        jQuery('#toTop').css({'margin-right': '' + cryout_toTop_offset + 'px', 'opacity': 0.5});
    } else {
        jQuery('#toTop').css({'margin-left': '' + (cryout_toTop_offset + 150) + 'px', 'opacity': 0});
        jQuery('#toTop').css({'margin-right': '' + (cryout_toTop_offset + 150) + 'px', 'opacity': 0});
    }
    //
    if (jQuery(this).scrollTop() > top_offset) {
        $('.top-social-holder').slideDown('fast');
    } else {
        $('.top-social-holder').slideUp('fast');
    }
});


jQuery('#toTop').click(function(event) {
    event.preventDefault();
    jQuery('html, body').animate({scrollTop: 0}, duration);
    return false;
});

/* check if scrollbar visible */
/* 
 * - this.get(0).clientHeight 
 * - this.innerHeight()
 * - this.height()
 * element.hasScrollBar()             // Returns { vertical: true/false, horizontal: true/false }
 * element.hasScrollBar().vertical    // Returns true/false
 * element.hasScrollBar().horizontal  // Returns true/false
 * */
(function($) {
    $.fn.hasScrollBar = function() {
        var hasScrollBar = {}, e = this.get(0);
        hasScrollBar.vertical = (e.scrollHeight > e.clientHeight) ? true : false;
        hasScrollBar.horizontal = (e.scrollWidth > e.clientWidth) ? true : false;
        return hasScrollBar;
    }
})(jQuery);

$(function($) {
    $(".various").fancybox({
        maxWidth: 1300,
        maxHeight: 600,
        fitToView: false,
        width: '100%',
        height: '100%',
        autoSize: false,
        closeClick: false,
        openEffect: 'none',
        closeEffect: 'none'
    });
});

$(function() {
//    $(document).click(function() {
//        if ($('.balloon-quote').is(':visible'))
//            $('.balloon-quote').slideUp('fast');
//    });
    $('.close-yt-rel').on('click', function(){
        $('.yt-rel-holder').hide();
    });
    
    $('.btn-cate-st').on('click', function(){
       location.href = $(this).data('href');
    });
    
//    $('.btn-cate-st').each(function(){
//       $(this).mouseover(function(){
//           var img = $('.hov-top-men', this);
//           var src = $(img).data('img-h');
//           $(img).attr('src', src);
//       }),
//       $(this).mouseout(function(){
//           var img = $('.hov-top-men', this);
//           var src = $(img).data('img-d');
//           $(img).attr('src', src);
//       });
//    });
});

$(document).ready(function() {

    $('.jp-pause').hide();

    var $voice_click = null;
    var $this = null;
    $("#jquery_jplayer").jPlayer({
        ready: function(event) { // The $.jPlayer.event.ready event
            $this = $(this);
            //
            $('.jp-play').on('click', function(e) {
                e.preventDefault();
                $voice_click = $(this);
                var mp3_url = $(this).data('url');
                //
                $voice_click.hide();
                $voice_click.next().show();
                //
                $this.jPlayer("setMedia", {// Set the media
                    mp3: mp3_url
                }).jPlayer("play", event.jPlayer.status.currentTime); // Attempt to auto play the media
            });
            //
            $('.jp-pause').on('click', function(e) {
                $voice_click.show();
                $voice_click.next().hide();
                $this.jPlayer("pause");
            });
        },
        ended: function() { // The $.jPlayer.event.ended event
            $voice_click.show();
            $voice_click.next().hide();
//            $(this).jPlayer("play"); // Repeat the media
        },
        supplied: "mp3",
        wmode: "window",
        size: {
            width: "0",
            height: "0"
        },
        cssSelector: {
            play: '.jp-play',
            pause: '.jp-pause',
            stop: '.jp-stop'
        },
        errorAlerts: false,
        warningAlerts: false
    });
    //
});

$(function(){
   $('.language').on('click', function(){
      $('.lang').slideToggle();
   });
});