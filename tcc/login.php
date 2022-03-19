<?php 
	require_once 'class/user.php';
	$u = new User; 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/style.css">
	<title>TCC</title>
	<script type="text/javascript" src="js/scripts.js"></script>
</head>
<body>
<div class="container"> 
  <form action="" class="form-contact" method="post" tabindex="1">
    <h1>Login</h1> 
  	<input type="text" class="form-contact-input" name="user" maxlength="30" placeholder="User" />
    <input type="password" class="form-contact-input" name="pwd" maxlength="45" placeholder="Senha" />
    <button type="submit" value="Entrar" name="enviar" class="form-contact-button">Enviar</button> 
  </form>  
</div> 

<?php
	if (isset($_POST['enviar'])){
    	$user = addslashes($_POST['user']);
    	$senha = addslashes($_POST['pwd']);

    	if (!empty($user) && !empty($senha)){
    		$u->connect("tcc", "localhost", "root", "");
    		if($u->error == ""){
 				if($u->login($user,$senha)){
 					echo "logou";
 					header("location: index.php");
 				} else {
 					echo "Email ou senha inválidos.";
 				}
    		} else { 
    			echo "Erro: ".$u->error;
    		}
    	} else {
    		echo "Preencha todos os campos!";
    	}
	}
?>
</body>
</html>