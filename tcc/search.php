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
<?php
	// Copiar as pastas GRADUACAO E CEDERJ para dentro de C:\xampp\htdocs\tcc\Scan\ATUALIZACAO\
	// quando for inserir da pasta cederj ou graduacao é só comentar uma e descomentar outra.
	//$dir    = 'C:\xampp\htdocs\tcc\Scan\ATUALIZACAO\CEDERJ\\';
	$dir    = 'C:\xampp\htdocs\tcc\Scan\ATUALIZACAO\GRADUACAO\\';

	$graduacao_ano = scandir($dir);
	require_once 'conn.php';

	for ($i=2; $i < count($graduacao_ano); $i++){
		$vestibular_ano = $graduacao_ano[$i];
		$vestibular_dir = scandir($dir.$vestibular_ano);
		for ($x=2; $x < count($vestibular_dir); $x++){ 
			$nome_curso = $vestibular_dir[$x];
			$curso_dir= scandir($dir.$vestibular_ano.'\\'.$nome_curso);
			for ($y=2; $y < count($curso_dir); $y++){
				$semestre = $curso_dir[$y];
				$semestre_dir = scandir($dir.$vestibular_ano.'\\'.$nome_curso.'\\'.$semestre);
				for ($z=2; $z < count($semestre_dir); $z++){
					$aluno = $semestre_dir[$z];
					$matricula = strpbrk($aluno, '0123456789');
					$len_nome = strlen($aluno) - strlen($matricula);
					$nome = trim(ucwords(mb_strtolower(substr($aluno, 0, $len_nome))));
					$dir_final=$dir.$vestibular_ano.'\\'.$nome_curso.'\\'.$semestre.'\\'.$aluno;
					$doc = scandir($dir_final);
					$iano= '20'.$matricula[1].$matricula[2];
					$isem= $matricula[0];
					$curso=$curso = $matricula[3].$matricula[4].$matricula[5];
					$find_curso_query = "select id_curso from curso where cod='$curso'";
					$find_matricula_query = "select matricula from consulta_aluno where matricula='$matricula'";
					$resultado_curso = mysqli_query($conn, $find_curso_query);
					$resultado_matricula = mysqli_query($conn, $find_matricula_query);
					$nrow_mat = mysqli_num_rows($resultado_matricula);
					$nrow = mysqli_num_rows($resultado_curso);
					if ($nrow>0){
						if ($nrow_mat==0) {
							for ($w=2; $w < count($doc); $w++){		
								$documento=$dir_final.'\\'.$doc[$w];
								$doc_final=substr($documento, 20);	//substituir o numero 20 pelo numero de letras até a pasta o inicio da palavra Scan (contando com as barras)
								$doc_final = mysqli_real_escape_string($conn, $doc_final);
								$resultado = mysqli_query($conn,"INSERT INTO ALUNO (matricula, NOME, ANO_INGRESSO, SEMESTRE_INGRESSO, documentos, curso_aluno) VALUES ('$matricula', '$nome', '$iano', '$isem', '$doc_final', '$curso')");
								if ($resultado) echo "Inseriu aluno $nome de matricula $matricula com sucesso. <br>"; 
								else {echo "$nome de matricula $matricula não foi inserido. Erro: "; echo mysqli_error($conn)."<br>";}
							}
						}
					} else echo "Código de curso inválido para o aluno $nome de matricula $matricula <br>";
				}		
			}
		}
	}
?>
  </div>
</div>
</body>

</html>