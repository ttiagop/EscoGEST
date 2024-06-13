<script type="text/javascript">clearInterval(atualiza);</script>
<?php
    include("check.php");
    include("connection/connect.php");
    

    if (isset($_GET["id"])){
        $user_id = $_GET["id"];

        // Query
        $stmtmsg = $conn->prepare("SELECT `Sender`, `Message`, `Image` FROM chat WHERE (Sender = '$user_id' AND Receiver = '$uid') OR (Receiver = '$user_id' AND Sender = '$uid') ORDER BY ID");
        //$stmt->bind_param("iiii", $user_id, $uid, $user_id, $uid);
        $stmtmsg->execute();
        $result = $stmtmsg->get_result();
        $count = $result->num_rows;

        $getUser = $conn->prepare("SELECT NProcesso, Nome, Foto FROM utilizadores WHERE (NProcesso = '$user_id') LIMIT 1");
        $getUser->execute();
        $user = $getUser->get_result()->fetch_assoc();


        //$getUser = $conn->prepare("SELECT Id, Username, Picture FROM User WHERE (Id LIKE ?) LIMIT 1");
        //$getUser->bind_param("i", $user_id);
        //$getUser->execute();
        //$user = $getUser->get_result()->fetch_assoc();



        if ($count < 1) {
            echo '<p class="info">Envie a sua primeira mensagem para '.$user["Nome"].'</p>';
        } else {
            while ($message = $result->fetch_assoc()) {
                if($message["Sender"] == $uid && $message["Image"] != "") {
                    ?>
                    <div class="row sent">
                        <img src="uploads/<?php echo $message["Image"] ?>" />
                    </div>
                    <?php
                } elseif($message["Sender"] == $uid) {
                    ?>
                    <div class="row sent">
                        <p><?php echo $message["Message"] ?></p>
                    </div>
                    <?php
                } elseif($message["Image"] != "") {
                    ?>
                    <div class="row recieved">
                        <img src="uploads/<?php echo $message["Image"] ?>" />
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="row recieved">
                        <p><?php echo $message["Message"] ?></p>
                    </div>
                    <?php
                }
            }
    
            // Update conversation has opened
            $stmt = $conn->prepare("UPDATE Conversations SET `Unread` = 'n' WHERE (MainUser = '$uid' AND OtherUser = '$user_id')");
            //$stmt->bind_param("ii", $uid, $user_id);
            $stmt->execute();
        }

    } else {
        die(header("HTTP/1.0 401 Faltam parametros"));
    }
?>

