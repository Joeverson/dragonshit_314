$(document).ready(function() {
	
	
	//máscara campo cpf
	$("#cpf").mask("999.999.999-99");
	
	//Submit cadastro
	$("#cadastro").on('submit', function(){
		var erros=0;
		var resp = $("#msg_erro");
		resp.fadeOut(200);
		resp.html("");
		if($("#nome").val()=="") {erros=1; resp.append("<p>Preencher nome</p>"); }
		if($("#email").val()=="") {erros=1; resp.append("<p>Preencher email</p>");}
		if($("#cod_mult").val()=="") {erros=1; resp.append("<p>Preencher código</p>");}
		if($("#senha").val()==""){erros=1; resp.append("<p>Preencher senha</p>"); }
		if(checaSenhas()==false) {erros=1; }
		if (erros == 0) {
			//$(this).submit();
			//return true;
			var dados = 'nome='+ $("#nome").val() +'&email='+ $("#email").val() + '&cod_mult=' +$("#cod_mult").val()+ '&senha=' +$("#senha").val()+ '&cpf=' +$("#cpf").val();
			$.ajax({
				type: "POST",
				url: "../controller/processaCadastro.php",
				data: dados,
				dataType  : 'html',
				success: function( txt )
				{
					$("#cadastro").hide(100);
					$('#form-cad').innerHTML=txt;
				}
			});
		}
		resp.fadeIn(100);
		return false;
	})

	//verifica as senhas
	$("#senha").on('keyup',function(){
		if($("#repita_senha").val()!="") checaSenhas(); 
	})
	
	
	//hover box
	/*$(".box").hover(function() {
        $(this).animate({opacity: 0.7}, 100);
		 }, function() {
        $(this).animate({opacity: 1.0}, 100);
    });*/
	
	
});

/******************************/
//checa senhas digitadas iguais
function checaSenhas(){
	var senha1 = $("#senha").val();
	var senha2 = $("#repita_senha").val();
	var resp = $("#conf_senha");

	if(senha1!=senha2){
		resp.fadeIn(150);
		resp.html("Senhas Não conferem!");
		return false;
		}
	else {
		resp.fadeOut(150);
		return true;
	}
}
