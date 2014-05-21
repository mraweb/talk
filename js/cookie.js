/**
 * strCookie = Nome do cookie
 * strValor = Valor que será salvo no cookie
 * lngDias = Dias de validade do cookie
 */
function gerarCookie(strCookie, strValor, lngDias) {
  $.cookie(strCookie, strValor, {
    expires : lngDias
  });
}

/**
 * nomeCookie = Nome que foi dado ao cookie durante a criação
 */
function lerCookie(nomeCookie) {
  if ( $.cookie(nomeCookie) == 1 )
    return true;
  else
    return false;
}