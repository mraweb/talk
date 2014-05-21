$('.refresh').click(function() {  
	change_captcha();
});

function change_captcha(){
	var urlbase = $('#urlbase').val();
	document.getElementById('captcha').src=""+urlbase+"funcoes/get_captcha.php?rnd=" + Math.random();
}