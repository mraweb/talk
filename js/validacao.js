// validacao formulario
jQuery(document).ready(function(){
    jQuery("#formID, #form-Lateral, #conversion-form, #formCadastro").validationEngine();
});
function checkHELLO(field, rules, i, options){
    if (field.val() != "HELLO") {
        return options.allrules.validate2fields.alertText;
    }
}

 $('#tel, #telcadastro').mask('(00) 0000-0000', 
    {onKeyPress: function(phone, e, currentField, options){
     var new_sp_phone = phone.match(/^(\(11\) 9(5[0-9]|6[0-9]|7[01234569]|8[0-9]|9[0-9])[0-9]{1})/g);
     new_sp_phone ? $(currentField).mask('(00) 00000-0000', options) : $(currentField).mask('(00) 0000-0000', options)
   }
 });