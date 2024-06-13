<?php
    include("check.php");
    include("connection/connect.php");


    /* ?>
    <div class="chat selected" onclick="chat('<?php echo $user['Id']; ?>')">
        <img src="img/globe.png" />
        <p>Toda a comunidade</p>
    </div>
    <?php */
    
    // Query
    $stmt = $conn->prepare("SELECT * FROM Conversations WHERE (MainUser = '$uid') ORDER BY Modification DESC");
    //$stmt->bind_param("i", $uid);
    $stmt->execute();
    $result = $stmt->get_result();
    $count = $result->num_rows;

    if ($count < 1) {
        echo '<div class="empty"><p>Pesquise por um utilizador e começe um novo chat!</p></div>';
    }

    while ($inbox = $result->fetch_assoc()) {

        $inbox2 = $inbox["OtherUser"];

        $stmt = $conn->prepare("SELECT NProcesso, Nome, Foto FROM utilizadores WHERE (NProcesso = '$inbox2') LIMIT 1");
        //$stmt->bind_param("i", $inbox["OtherUser"]);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();

        if ($user) {
            ?>
            <div class="chat <?php if($inbox["Unread"] == "y") { echo "new"; } ?>" onclick="chat('<?php echo $user['NProcesso']; ?>')">
                <img src="pPics/<?php echo $inbox["OtherUser"]; ?>" />
                <p><?php echo $user["Nome"]; ?></p>
            </div>
            <?php
        }
    }
?>