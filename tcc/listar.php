<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="">
    <style>
        table{border-spacing: 1; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; width: 100%; margin: 0 auto; 
            position:relative;}
        div {display: block; margin-top: 10px;} 
        table thead tr {height: 60px; background: #36304a;}
        .table100-head th {font-family: OpenSans-Regular;font-size: 19px;color: #fff;line-height: 1.2;font-weight: unset;}
        table td, table th {text-align: left;padding-left: 8px;}
        .column1 {width: 120px; text-align:left;padding-left: 20px;}
        .column2 {width: 300px;}
        .column3 {width: 220px;}
        .column4 {width: 190px;}
        .column5 {width: 80px;text-align: center;padding-right:20px;}
        .column6 {width: 50px;text-align: right; padding-right:20px;}
        a {color: blue;}
        table tbody tr td.column6{text-align: center;}
        tbody {display: table-row-group;vertical-align: middle;border-color: inherit;}
        table tbody tr {height: 50px;}
        tbody tr {font-family: OpenSans-Regular;font-size: 17px;color: #555555;line-height: 1.2;font-weight: unset; border:0;background-color: #f5f5f5;}
        tbody tr:hover {color: #555555; background-color: #f0f0f0; cursor: pointer;}
        
        .nofind {background-color: #d73851; width: 250px; height: 30px; border-radius: 2px; display: block; align-items: center; }
        div.nofind p{font-size: 18px; font-family: 'Lato', sans-serif; font-weight: 500; color: white; display: inline-block; text-align: center; 
        margin: 5px 20px;}
    </style>
</head>
<body>
    <div class="container">
        <?php
            function consultarAluno($matricula){
                require_once 'conn.php';
                $consultaSQL = "SELECT * FROM CONSULTA_ALUNO where matricula='$matricula'";
                $resultado = mysqli_query($conn, $consultaSQL);
                $nrow = mysqli_num_rows($resultado);
                if ($nrow>0){
                    $row = mysqli_fetch_assoc($resultado);
                    $nome = ucwords(mb_strtolower($row['nome'], 'UTF-8'));
                    $ano_ingresso = $row['ano_ingresso']; 
                    $semestre_ingresso = $row['semestre_ingresso']; 
                    $documentos = $row['documentos']; 
                    $curso_aluno = ucwords(mb_strtolower($row['curso'], 'UTF-8'));
                    $polo = ucwords(mb_strtolower($row['polo'], 'UTF-8'));
                    echo("
                    <div class='table100'>
                    <table>
                    <thead>
                        <tr class='table100-head'>
                            <th class='column1'>Matrícula</th>
                            <th class='column2''>Nome</th>
                            <th class='column3'>Curso</th>
                            <th class='column4'>Pólo</th>
                            <th class='column5'>Ingresso</th>
                            <th class='column6'>Documento</th>
                        </tr>
                    </thead>
                    ");
                    echo "<tbody>
                        <tr>
                            <td class='column1'>$matricula</td>
                            <td class='column2'>$nome</td>
                            <td class='column3'>$curso_aluno</td>
                            <td class='column4'>$polo</td>
                            <td class='column5'>$ano_ingresso/$semestre_ingresso</td>";
							if (strlen($documentos)>600){
                            echo "<td class='column6'><a href='abrir_arquivo.php?id=$matricula'>abrir</a></td>";
							} else echo "<td class='column6'><a target='_blank' href='$documentos'>abrir</a></td>";
						echo "</tr></tbody>";
                    
                    echo("</table></div>"); 
                } else echo "<div class='nofind'><p>Matrícula não encontrada.</p</div>";
            }
        ?>
    </div>
</body>
</html>