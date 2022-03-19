<?php
	session_start();
    if(!isset($_SESSION['id_user'])){
		header("location: login.php");
		exit;
    }		
	function cadastrarAluno($matricula, $nome, $doc){
		require_once 'conn.php';
		$matricula = trim($matricula);
        $matricula = str_replace(".", "", $matricula);
        $semestre = $matricula[0];
        $ano = '20'.$matricula[1].$matricula[2];
        $curso = $matricula[3].$matricula[4].$matricula[5];
		if($ano > date('Y')+3) {
		   $ano = $ano - 100;
		}

        $find_curso_query = "select id_curso from curso where cod='$curso'";
	 	$resultado = mysqli_query($conn, $find_curso_query);
		$nrow = mysqli_num_rows($resultado);

		if ($nrow>0){
			$row = mysqli_fetch_assoc($resultado);
			$curso_id=$row['id_curso'];
			$insere_aluno_sql = "INSERT INTO ALUNO (MATRICULA, NOME, ANO_INGRESSO, SEMESTRE_INGRESSO, DOCUMENTOS, CURSO_ALUNO) VALUES ('$matricula', '$nome', '$ano', '$semestre','$doc','$curso_id')";
			$resultado_insere_aluno = mysqli_query($conn, $insere_aluno_sql);
			if ($resultado_insere_aluno){
				echo "<div class='queryok'>Inserido com sucesso!</div>";
			} else {
				$e=mysqli_error($conn);
				echo "<div class='queryfb'>Erro ao inserir. <br> '$e'.</div>";
			}
		} else echo "<div class='queryfb'> 
		<span>Número de matrícula inválido. Curso inexistente.</span>
		</div>";
	}	
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/estilo_cadastrar.css">
  <style>
    .queryfb {width: 25%; background-color: red;  margin-top: 7px; color: white; border-radius: 2px; padding-left: 4px; text-align: center; }
	.queryok {width: 25%; background-color: green;  margin-top: 7px; color: white; border-radius: 2px; padding-left: 4px; text-align: center; }
	
  </style>
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
          <a href="index.php" class="btn" title="Consultar Aluno">Consultar Aluno</a>
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
    <h1>Cadastro de Aluno</h1>
      <form class="formc" method="post" tabindex="1" enctype="multipart/form-data" onsubmit="return isMatricula();">
	  <input type="text" id="matricula" name="matricula" placeholder="Matrícula do Aluno" onkeypress="isInputNumber(event)" required />
      <input type="text" name="nome" onkeypress="isInputName(event)" placeholder="Nome do Aluno" required />
      <input type="file" id="arquivo" name="arquivo" accept="image/tiff"  />
      <label for="arquivo">Anexar Documento</label>
      <input type="submit" name="enviar" value="Cadastrar">
    </form>
  <?php 
    if (isset($_POST['enviar'])){ 
      $matricula = $_POST['matricula'];
      $nome = $_POST['nome'];   
      $arquivo = $_FILES["arquivo"]["tmp_name"]; 
      $tamanho = $_FILES["arquivo"]["size"];
      $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
      if (($nome!="" and $matricula!="" and $arquivo!="") and ($extensao=='.tif' or $extensao=='tiff')){
        $fp = fopen($arquivo, "rb");
        $conteudo = fread($fp, $tamanho);
        $conteudo = addslashes($conteudo);
        fclose($fp);                                       
       // include("cadastra_aluno.php"); 
        cadastrarAluno($matricula, $nome, $conteudo);
      } else echo "<div class='queryfb'> <p>Por favor, insira um documento do tipo tif.</p></div>";
    } 
  ?>
  </div>
</div>
</body>

</html>




