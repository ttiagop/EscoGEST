<?php 

            $nproc = $_SESSION['username'];

            $sql2 = "SELECT FotoAluno FROM alunos WHERE NProcesso = '$nproc'";
            $result2 = $conn->query($sql2); 

            $row2 = $result2->fetch_assoc();

            $alunoblob = $row2['FotoAluno'];

            $path = '../pPics/' . $nproc . '.png';
            
            if (file_put_contents($path, $alunoblob) !== false) {
                // gravado c sucesso
            } else {
                // erro
                echo "Erro ao gravar - $path";
            }

         ?>