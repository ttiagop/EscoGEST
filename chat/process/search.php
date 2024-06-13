<?php
    include("check.php");

    if ($_GET["term"]){
        $usernamepesq = mysqli_real_escape_string($conn, $_GET["term"]);

        // Query
        $stmt = $conn->prepare("SELECT NProcesso, Nome, Foto, Online FROM utilizadores WHERE (Nome LIKE '%$usernamepesq%') ORDER BY Nome DESC LIMIT 20");
        $stmt->execute();
        $result = $stmt->get_result();
        $count = $result->num_rows;

        if ($count < 1) {
            echo '<p class="noResults">Sem resultados</p>';
        }

        while ($user = $result->fetch_assoc()) {

            if ($user['NProcesso'] != $uid) {

            ?>
            <div class="row" onclick="$('#searchContainer').hide(); chat('<?php echo $user['NProcesso'] ?>');">
                <img src="pPics/<?php 
                
                            $blobpesq = $user['Foto'];
                
                            $path = '../pPics/' . $user['NProcesso'] . '.png';
                            
                            if (file_put_contents($path, $blobpesq) !== false) {
                                // gravado c sucesso
                            } else {
                                // erro
                                echo "Erro ao gravar - $path";
                            }

            echo $user["NProcesso"]; ?>.png" />
                <p><?php echo $user["Nome"] ?></p>
            </div>
            <?php
        } else {
            echo '<p class="noResults">Sem resultados</p>';
        }
        }
    }
?>