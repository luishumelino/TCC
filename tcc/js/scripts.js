 function isInputNumber(evt){
	var ch = String.fromCharCode(evt.which);
	if(!(/[0-9]/.test(ch))){
		evt.preventDefault();
	}   
}          
function isMatricula(){
	var matricula = document.getElementById('matricula');;
	var regex = /^(([0-9]{3}\.[0-9]{3}\.[0-9]{3})|([0-9]{8})|([0-9]{9}))$/;
	if (!regex.test(matricula.value)){
		alert('Número de matrícula inválido.');
		return false;
	}
}

 function isInputName(evt){
	var ch = String.fromCharCode(evt.which);
	if(!(/[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]/.test(ch))){
		evt.preventDefault();
	}   
} 