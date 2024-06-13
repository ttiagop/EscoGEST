<?php 

	include 'dbcon.php';


	$tipo = $_POST['tipoFalta'];
	$anotacoes = $_POST['anotacoes'];
    $tempo = $_POST['selectTempo'];
    $aluno = $_POST['selectAlunos'];
    $aula = $_POST['aula'];

    $t = $_POST['t'];

	$gf = "INSERT INTO `falta_aluno` VALUES (NULL, '$aula', '$tempo', '$aluno', '$tipo', '$anotacoes', '')";
    $conn->query($gf);


    $conn->close();


    header('Location: mf?t=' . $t . '&n=' . $aula);
        

?>