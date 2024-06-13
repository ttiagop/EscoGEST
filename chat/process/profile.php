<?php
    include("check.php");
    include("connection/connect.php");


    if(isset($_GET["id"])) {
        $id = $_GET["id"];
    } else {
        die(header("HTTP/1.0 401 Falta de parametros na chamada"));
    }

    // Check if is logged user
    if($id == 0) {
        $id = $uid;
        ?>
        <form method="POST" enctype="multipart/form-data" id="uploadPic">
            <div class="pictureContainer">
                <img id="userImg" src="./pPics/<?php 

                    $alunoblob = $user_picture;

                    $path = $uid . '.png';
                    
                    if (file_put_contents($path, $alunoblob) !== false) {
                        // gravado c sucesso
                    } else {
                        // erro
                        echo "Erro ao transferir imagem - $path";
                    }

                    echo $uid; 

            ?>.png"/>
                <label for="imgInp"></label>
            </div>
            <p class="name"><?php echo $name; ?></p>
        </form>
        <?php
    } else {
        // Query
        $stmt = $conn->prepare("SELECT NProcesso, Nome, Foto, Tipo FROM utilizadores WHERE (NProcesso = '$id') LIMIT 1");
        //$stmt->bind_param("i", $id);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
        
        

        ?>
        <div class="pictureContainer">
            <img id="userImg" src="pPics/<?php echo $id; ?>.png" /><br>
            <p class="name"><?php echo $user['Nome']; ?></p>

            <?php 

                if ($user['Tipo'] == 0) {
                    $tipo = "Administrador";
                }

                if ($user['Tipo'] == 1) {
                    $tipo = "Aluno";
                }

                if ($user['Tipo'] == 2) {
                    $tipo = "Professor";
                }

                if ($user['Tipo'] == 3) {
                    $tipo = "Encarregado de Educação";
                }

            ?>

            <p class="row" style="text-align: center;"><b><?php echo $tipo; ?></b></p>
        </div>
        <?php
    }
?>