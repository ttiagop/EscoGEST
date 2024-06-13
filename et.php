<?php

  include 'auth_session.php'; 
  include 'dbcon.php';

  $np = $_SESSION["username"];

  $idt = $_GET["idt"];

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

            // Insere o caminho do ficheiro na tabela 'uploads'
            $sql = "INSERT INTO entrega_tarefa (NProcesso, IDTarefa, Ficheiro) VALUES ('$np', '$idt', '$dest')";
            if ($conn->query($sql) === TRUE) {
                echo "Ficheiro enviado com sucesso.";
                header('Location: tarefa?tr=' . urlencode($idt));
            } else {
                echo "Erro ao enviar o ficheiro: " . $conn->error;
            }

            // Fecha a conexão com a base de dados
            $conn->close();
        } else {
            echo "Erro ao mover o ficheiro para o destino.";
        }
    } else {
        echo "Erro no envio do ficheiro.";
    }
}
?>