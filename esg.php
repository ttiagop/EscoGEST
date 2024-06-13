<?php 

	include 'dbcon.php';


	$id = $_POST['id'];
	$data = $_POST['data'];
    $sumario = $_POST['sumario'];



	$esg = "UPDATE `aulas` SET `Data`='$data',`Sumario`='$sumario' WHERE NumAula = '$id'";
    $conn->query($esg);


    $conn->close();


    header('Location: es?id=' . urlencode($id));
        

?>