<?php 

	include 'dbcon.php';


	$idf = $_POST['f'];
    $just = $_POST['just'];



	$justificar = "UPDATE `falta_aluno` SET `Just`='$just' WHERE IDFalta = '$idf'";
    $conn->query($justificar);


    $conn->close();


    header('Location: detalhesf?f=' . urlencode($idf));
        

?>