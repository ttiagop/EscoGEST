<?php 

	include 'dbcon.php';

	$id = $_GET['id'];
	$reg = $_GET['reg'];


    $deleteentrega = "DELETE FROM entrega_tarefa WHERE IDTarefa = '$id'";

    if ($conn->query($deleteentrega) === TRUE) {
                echo "Entrega eliminada com sucesso.";
            } else {
                echo "Erro! " . $conn->error;
            }


	$elt = "DELETE FROM tarefas WHERE IDTarefa = '$id'";

    if ($conn->query($elt) === TRUE) {
                echo "Tarefa eliminada com sucesso.";
                header('Location: vertarefas?t=' . urlencode($reg));
            } else {
                echo "Erro! " . $conn->error;
            }

            // Fecha a conexão com a base de dados
            $conn->close();
        

?>