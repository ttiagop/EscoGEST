<?php 

	include 'dbcon.php';

	$dest = "";

	$reg = $_POST['reg'];
	$titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    //$ficheiro = $_FILES['ficheiro'];
    $datafim = $_POST['datafim'];
    $tranca = $_POST['trancar'];

    $time = time();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o ficheiro foi enviado sem erros
    if (isset($_FILES["ficheiro"]) && $_FILES["ficheiro"]["error"] == 0) {
        $nomeficheiro = basename($_FILES["ficheiro"]["name"]);
        $dest = "uploads/" . $time . "_" . $nomeficheiro; // Define o caminho de destino

        // Move o ficheiro para o destino
        if (move_uploaded_file($_FILES["ficheiro"]["tmp_name"], $dest)) {
            // Conecta aa base de dados (substitua com suas configurações)
            // Verifica a conexão
            if ($conn->connect_error) {
                die("Falha na conexão com a base de dados: " . $conn->connect_error);
            }
        } else {
            echo "Erro ao mover o ficheiro para o destino.";
        }
    } else {
        echo "Erro no envio do ficheiro.";
    }
}


	$ct = "INSERT INTO `tarefas` (`IDTarefa`, `IDReg`, `TituloTarefa`, `DescTarefa`, `DataFim`, TrancarEntrega, `Anexo`) VALUES (NULL, '$reg', '$titulo', '$descricao', '$datafim', '$tranca', '$dest');";

    if ($conn->query($ct) === TRUE) {
                echo "Ficheiro enviado com sucesso.";
                header('Location: vertarefas?t=' . urlencode($reg));
            } else {
                echo "Erro ao enviar o ficheiro: " . $conn->error;
            }

            // Fecha a conexão com a base de dados
            $conn->close();
        

?>