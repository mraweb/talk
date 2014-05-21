// link externo
$(document).ready(function(){
    $("a[rel=external]").attr('target','_blank');
});

// desabilitar skype
jQuery(document).ready(function(){
    jQuery('head').append('<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />')
});

// Link div
$(document).ready(function(){                  
    $(".slides div, .box-noti, .box-noticias, .box-imprensa").click(function(){
        window.location=$(this).find("a").attr("href");return false;
    });
});

// navegacao entre abas
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

// navegacao entre abas
$(document).ready(function() {
    $(".tab_content1").hide(); 
        if(location.hash != "") {
        var target = "#"+location.hash.split("#")[1]; // need semicolon at end of line
        $(location.hash).show(); //Show first tab content
        $("ul.tabs1 li:has(a[href="+target+"])").addClass("active").show();
        rotateTabs=false;
        } else {
        $("ul.tabs1 li:eq(0)").addClass("active").show(); //Activate first tab
        $(".tab_content1:eq(0)").show(); //Show first tab content
    }

    $("ul.tabs1 li").click(function() {
        $("ul.tabs1 li").removeClass("active"); 
        $(this).addClass("active"); 
        $(".tab_content1").hide(); 
        var activeTab = $(this).find("a").attr("href"); 
        $(activeTab).fadeIn();
        return false
    });
});

// navegacao entre abas
$(document).ready(function() {
    $(".tab_content2").hide(); 
        if(location.hash != "") {
        var target = "#"+location.hash.split("#")[1]; // need semicolon at end of line
        $(location.hash).show(); //Show first tab content
        $("ul.tabs2 li:has(a[href="+target+"])").addClass("active").show();
        rotateTabs=false;
        } else {
        $("ul.tabs2 li:eq(0)").addClass("active").show(); //Activate first tab
        $(".tab_content2:eq(0)").show(); //Show first tab content
    }

    $("ul.tabs2 li").click(function() {
        $("ul.tabs2 li").removeClass("active"); 
        $(this).addClass("active"); 
        $(".tab_content2").hide(); 
        var activeTab = $(this).find("a").attr("href"); 
        $(activeTab).fadeIn();
        return false
    });
});

// navegacao entre abas
$(document).ready(function() {
    $(".tab_content3").hide(); 
        if(location.hash != "") {
        var target = "#"+location.hash.split("#")[1]; // need semicolon at end of line
        $(location.hash).show(); //Show first tab content
        $("ul.tabs3 li:has(a[href="+target+"])").addClass("active").show();
        rotateTabs=false;
        } else {
        $("ul.tabs3 li:eq(0)").addClass("active").show(); //Activate first tab
        $(".tab_content3:eq(0)").show(); //Show first tab content
    }

    $("ul.tabs3 li").click(function() {
        $("ul.tabs3 li").removeClass("active"); 
        $(this).addClass("active"); 
        $(".tab_content3").hide(); 
        var activeTab = $(this).find("a").attr("href"); 
        $(activeTab).fadeIn();
        return false
    });
});

// navegacao entre abas
$(document).ready(function() {
    $(".tab_content4").hide(); 
        if(location.hash != "") {
        var target = "#"+location.hash.split("#")[1]; // need semicolon at end of line
        $(location.hash).show(); //Show first tab content
        $("ul.tabs4 li:has(a[href="+target+"])").addClass("active").show();
        rotateTabs=false;
        } else {
        $("ul.tabs4 li:eq(0)").addClass("active").show(); //Activate first tab
        $(".tab_content4:eq(0)").show(); //Show first tab content
    }

    $("ul.tabs4 li").click(function() {
        $("ul.tabs4 li").removeClass("active"); 
        $(this).addClass("active"); 
        $(".tab_content4").hide(); 
        var activeTab = $(this).find("a").attr("href"); 
        $(activeTab).fadeIn();
        return false
    });
});

// navegacao entre abas
$(document).ready(function() {
    $(".tab_content5").hide(); 
        if(location.hash != "") {
        var target = "#"+location.hash.split("#")[1]; // need semicolon at end of line
        $(location.hash).show(); //Show first tab content
        $("ul.tabs5 li:has(a[href="+target+"])").addClass("active").show();
        rotateTabs=false;
        } else {
        $("ul.tabs5 li:eq(0)").addClass("active").show(); //Activate first tab
        $(".tab_content5:eq(0)").show(); //Show first tab content
    }

    $("ul.tabs5 li").click(function() {
        $("ul.tabs5 li").removeClass("active"); 
        $(this).addClass("active"); 
        $(".tab_content5").hide(); 
        var activeTab = $(this).find("a").attr("href"); 
        $(activeTab).fadeIn();
        return false
    });
});

// navegacao entre abas
$(document).ready(function() {
    $(".tab_content6").hide(); 
        if(location.hash != "") {
        var target = "#"+location.hash.split("#")[1]; // need semicolon at end of line
        $(location.hash).show(); //Show first tab content
        $("ul.tabs6 li:has(a[href="+target+"])").addClass("active").show();
        rotateTabs=false;
        } else {
        $("ul.tabs6 li:eq(0)").addClass("active").show(); //Activate first tab
        $(".tab_content6:eq(0)").show(); //Show first tab content
    }

    $("ul.tabs6 li").click(function() {
        $("ul.tabs6 li").removeClass("active"); 
        $(this).addClass("active"); 
        $(".tab_content6").hide(); 
        var activeTab = $(this).find("a").attr("href"); 
        $(activeTab).fadeIn();
        return false
    });
});

// navegacao entre abas
$(document).ready(function() {
    $(".tab_content7").hide(); 
        if(location.hash != "") {
        var target = "#"+location.hash.split("#")[1]; // need semicolon at end of line
        $(location.hash).show(); //Show first tab content
        $("ul.tabs7 li:has(a[href="+target+"])").addClass("active").show();
        rotateTabs=false;
        } else {
        $("ul.tabs7 li:eq(0)").addClass("active").show(); //Activate first tab
        $(".tab_content7:eq(0)").show(); //Show first tab content
    }

    $("ul.tabs7 li").click(function() {
        $("ul.tabs7 li").removeClass("active"); 
        $(this).addClass("active"); 
        $(".tab_content7").hide(); 
        var activeTab = $(this).find("a").attr("href"); 
        $(activeTab).fadeIn();
        return false
    });
});

// navegacao entre abas quem somos
$(document).ready(function() {
    $(".tab_content-equipe").hide(); 
        if(location.hash != "") {
        var target = "#"+location.hash.split("#")[1]; // need semicolon at end of line
        $(location.hash).show(); //Show first tab content
        $("ul.tabs-equipe li:has(a[href="+target+"])").addClass("active").show();
        rotateTabs=false;
        } else {
        $("ul.tabs-equipe li:eq(0)").addClass("active").show(); //Activate first tab
        $(".tab_content-equipe:eq(0)").show(); //Show first tab content
    }

    $("ul.tabs-equipe li").click(function() {
        $("ul.tabs-equipe li").removeClass("active"); 
        $(this).addClass("active"); 
        $(".tab_content-equipe").hide(); 
        var activeTab = $(this).find("a").attr("href"); 
        $(activeTab).fadeIn();
        return false
    });
});

// navegacao entre abas quem somos
$(document).ready(function() {
    $(".content-pais").hide(); 
        if(location.hash != "") {
        var target = "#"+location.hash.split("#")[1]; // need semicolon at end of line
        $(location.hash).show(); //Show first tab content
        $("ul.menu-pais li:has(a[href="+target+"])").addClass("active").show();
        rotateTabs=false;
        } else {
        $("ul.menu-pais li:eq(0)").addClass("active").show(); //Activate first tab
        $(".content-pais:eq(0)").show(); //Show first tab content
    }

    $("ul.menu-pais li").click(function() {
        $("ul.menu-pais li").removeClass("active"); 
        $(this).addClass("active"); 
        $(".content-pais").hide(); 
        var activeTab = $(this).find("a").attr("href"); 
        $(activeTab).fadeIn();
        return false
    });
});

$("#close, #close1, #close2, #close3, #close4, #close5, #close6, #close7").click(function(e){
    e.preventDefault();
    $(".programa").fadeOut();
});

// slide home
$(function(){
    // Set starting slide to 1
    var startSlide = 1;
    // Get slide number if it exists
    if (window.location.hash) {
        startSlide = window.location.hash.replace('#','');
    }
    // Initialize Slides
    $('#slide-home').slides({
        preload: true,
        preloadImage: 'img/loading.gif',
        generatePagination: true,
        generateNextPrev: false,
        control: true,
        play: 8000,
        pause: 2500,
        hoverPause: true,
        start: startSlide,
        effect: 'fade'
    });
});

jQuery(document).ready(function() {
	jQuery('.padrao').jcarousel({
		scroll:1,
        itemFallbackDimension: 920
	});
});

// toltip
$(".padrao li a").on({
    mouseenter: function(){
        var _This = $(this),
        id = _This.data("radio");
        $(".toltip").find("#"+id).fadeIn();
    },
    mouseleave: function(){
        var _This = $(this),
        id = _This.data("radio");
        $(".toltip").find("#"+id).stop().fadeOut();
    }
});

$(document).ready(function(){
    $(".fimdeano a, #mask1").click(function(e){
        e.preventDefault();
        $('.fimdeano, #mask1').fadeOut();
    })
});



// facebook
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=609431695811376";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


//carrega os estados, da página de cadastro
$(".selecionaEstados").change(function() {
	  	var valor = $('#pais').val();
	  	var acao = "montaEstados";
	$('#estado').html("<option value='0'>Carregando...</option>");
	setTimeout(function(){
		$('#estado').load("classe/ComboBox.php",{id:valor, acao:acao})
	}, 2000);
});

//verifica se o dados já esta cadastrado
$(".checkDados").change(function() {
	var name = $(this).attr('name');
	var value = $('#'+name).val();
	var idCheck = null;	
	var acao = "checkDados";

	$.post('classe/Empresa.php', {acao: acao, name: name, value: value, idCheck: idCheck}, function(resposta) {
		if(resposta == 1){
			$('#error_'+name).html(value+" já existe! Infome outro");
			$('#error_'+name).show();
			$('#'+name).val("");
			$('#'+name).focus();
		}
	});
});

$(".hideInputError").keyup(function() {
	var total = $(this).val().length;
	var name = $(this).attr("name");
	if(total >= 1){
		$('#error_'+name).html("");
		$('#error_'+name).hide();
	}
});