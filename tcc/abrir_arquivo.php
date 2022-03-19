<?php
 try
	{
		$conn = mysqli_connect("localhost", "root", "", "tcc");
		$consultaSQL = "SELECT documentos FROM aluno WHERE matricula=$_GET[id]";
		$resultado = mysqli_query($conn, $consultaSQL);

		$row=mysqli_fetch_assoc($resultado);
		$conteudo=$row['documentos'];
        $tipo = 'image/tiff';
        header("Content-Type: $tipo");
        echo $conteudo;	
    }catch(PDOException $erro)
	{
		echo("Errrooooo! foi esse: " . $erro->getMessage());
	}
?>