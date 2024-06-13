<?php 

	include 'dbcon.php';


	$id = $_POST['id'];


	$ds = "DELETE FROM `aulas` WHERE NumAula = '$id'";
    $conn->query($ds);


    $conn->close();


    header('Location: sumarios');
        

?>