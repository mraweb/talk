$(document).ready(function(){
	$("a[rel=external]").attr('target','_blank');
});

jQuery(document).ready(function(){
    jQuery('head').append('<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />')
});

$(function(){ $(".oculta").inFieldLabels(); });

$(".modal").click(function(){
	$(".abre-div, .mask").fadeIn();
});

$(".close, .mask").click(function(){
	$(".abre-div, .close, .mask").fadeOut();
});

// dropdown
jQuery(document).ready(function() {
    var menus = jQuery('#navMenu li');
    menus.on('mouseenter keyup mouseleave keydown',function(e) {
        clearTimeout($.data(this, 'timer'));
        if(e.type == 'mouseenter' || e.type == 'keyup'){
            if(jQuery(this).find('ul').hasClass('sub-nav')){
                jQuery(this).find('a').eq(0).addClass('current-menu');
            }
        $.data(this, 'timer', setTimeout($.proxy(function() {
            jQuery('.sub-nav', this).stop(true, true).fadeIn('slow');
        }, this), 100));
            
        } else if(e.type == 'mouseleave'){
            jQuery(this).find('a').eq(0).removeClass('current-menu');
            jQuery('.sub-nav', this).stop(true, true).fadeOut();

        } else if(e.type == 'keydown'){
            var totalLi = jQuery(this).find('.sub-nav li');
            var qtLi = totalLi.length-1;
            jQuery(this).find('a').eq(0).removeClass('current-menu');
            jQuery(this).find('.sub-nav li').eq(qtLi).focusout(function(){
                jQuery('.sub-nav').stop(true, true).fadeOut('slow');
            });
        }
    });
});

$(document).ready(function() {
	$(".tab_content").hide(); 
		if(location.hash != "") {
		var target = "#"+location.hash.split("#")[1]; // need semicolon at end of line
		$(location.hash).show(); //Show first tab content
		$("ul.tabs li:has(a[href="+target+"])").addClass("active").show();
		rotateTabs=false;
		} else {
		$("ul.tabs li:eq(0)").addClass("active").show(); //Activate first tab
		$(".tab_content:eq(0)").show(); //Show first tab content
	}

	$("ul.tabs li").click(function() {
		$("ul.tabs li").removeClass("active"); 
		$(this).addClass("active"); 
		$(".tab_content").hide(); 
		var activeTab = $(this).find("a").attr("href"); 
		$(activeTab).fadeIn();
		return false
	});
});

$('.sonums').keypress(function(event) {
    var tecla = (window.event) ? event.keyCode : event.which;
    if ((tecla > 47 && tecla < 58)) return true;
    else {
        if (tecla != 8) return false;
        else return true;
    }
});