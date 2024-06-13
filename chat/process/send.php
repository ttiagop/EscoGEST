<?php
    include("check.php");
    include("connection/connect.php");

    if(isset($_POST["message"]) && isset($_POST["id"])) {

        // Normalization
        $user_id = $_POST["id"];
        $message = $_POST["message"];
        $image = "";

        if($_FILES['image']['error'] <= 0) {
            $image = $username."_MESSAGE_".rand(999, 999999).$_FILES['image']['name'];
            $imagetemp = $_FILES['image']['tmp_name'];
            $imagePath = "../uploads/";
            if (is_uploaded_file($imagetemp)) {
                if (move_uploaded_file($imagetemp, $imagePath . $image)) {
                    echo "OK";
                } else {
                    die(header("HTTP/1.0 401 Erro ao guardar imagem"));
                }
            } else {
                die(header("HTTP/1.0 401 Erro ao carregar imagem"));
            }
        } elseif ($user_id == "" || $message == "") {
            die(header("HTTP/1.0 401 Escreva uma mensagem"));
        }

        // Check if conversation exists
        $checkConversation = $conn->prepare("SELECT Id FROM `Conversations` WHERE (MainUser = '$uid' AND OtherUser = '$user_id')");
        //$checkConversation->bind_param("ii", $uid, $user_id);
        $checkConversation->execute();
        $count = $checkConversation->get_result()->num_rows;
        
        if ($count < 1) {
            // Create conversation user side
            $createChat = $conn->prepare("INSERT INTO Conversations (`MainUser`, `OtherUser`, `Unread`, `Creation`) VALUES ('$uid', '$user_id', 'n', now())");
            //$createChat->bind_param("ii", $uid, $user_id);
            $createChat->execute();

            // Create conversation other user side
            $createChat2 = $conn->prepare("INSERT INTO Conversations (`MainUser`, `OtherUser`, `Unread`, `Creation`) VALUES ('$user_id', '$uid', 'y', now())");
            
            $createChat2->execute();


            //$createChat2->bind_param("ii", $user_id, $uid); meti aqui para a print
        } else {
            $update = $conn->prepare("UPDATE `Conversations` SET Unread = 'y' WHERE (MainUser = '$uid' AND OtherUser = '$user_id')");
            //$update->bind_param("ii", $uid, $user_id);
            $update->execute();
        }
        
        $stmtchat = $conn->prepare("INSERT INTO Chat (`Sender`, `Receiver`, `Message`, `Image`, `Creation`) VALUES ('$uid', '$user_id', '$message', '$image', now())");
        /*$stmtchat->bindParam(':uid', $uid);
        $stmtchat->bindParam(':user_id', $user_id);
        $stmtchat->bindParam(':message', $message);
        $stmtchat->bindParam(':image', $image);*/
        //$stmtchat->execute();

        if ($stmtchat->execute()) {
            echo "Inserção bem-sucedida!";
        } else {
            echo "Erro ao inserir os dados: " . $stmtchat->errorInfo()[2];
        }


        if (!$stmtchat || !$update) {
            die(header("HTTP/1.0 401 Ocorreu um erro ao enviar a sua mensagem"));
        }
    } else {
        die(header("HTTP/1.0 401 Faltam parametros"));
    }
?>