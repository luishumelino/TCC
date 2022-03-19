<?php
  session_start();
    if(!isset($_SESSION['id_user'])){
      header("location: login.php");
      exit;
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/main_style.css">
  <title>TCC</title>
  <script type="text/javascript" src="js/scripts.js"></script>
</head>
<body>
<div class="container">
  <header>
    <h2><a href="http://www.uff.br/"><img id="logo-uff" src="img/logo-padrao-branco.png" /></a></h2>
    <nav>
      <ul>
        <li>
          <a href="cadastrar.php" class="btn" title="Cadastrar">Cadastrar Aluno</a>
        </li>
		<li>
          <a href="search.php" class="btn" title="Inserir em Massa">Inserir em Massa</a>
        </li>
        <li>
          <a class="btn" href="sair.php" title="Logout">Logout</a>
        </li>
      </ul>
    </nav>
  </header>

  <div class="cover">
    <h1>Consultar Aluno:</h1>
      <form class="flex-form" name="matriculaform" method="post" tabindex="1" onsubmit="return isMatricula();">

      <input type="search" id="matricula" name="matricula" placeholder="Insira a matrícula aqui" required onkeypress="isInputNumber(event)" />
      <input type="submit" name="enviar" value="Procurar">
    </form>
    <?php
      if (isset($_POST['enviar'])){
        $matricula=$_POST['matricula'];
        include("listar.php");
        consultarAluno($matricula);
      } 
    ?>
  </div>

</div>
</body>

</html>