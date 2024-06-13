<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>
<body>
    <?php include 'header.php'; ?>
    
	<div class="content">
		<?php

            if ($tipo != 1) {
                header('Location: aulas');
            } 

            $sqlhorario = "SELECT IDHorario, FicheiroHorario FROM horario WHERE IDTurma = '$turma'";
            $resulthorario = $conn->query($sqlhorario);
            $rowhorario = $resulthorario->fetch_assoc();

            $horarioblob = $rowhorario['FicheiroHorario'];

            $pathhorario = 'horarios/horario' . $rowhorario['IDHorario'] . '.png';
            
            if (file_put_contents($pathhorario, $horarioblob) !== false) {
                // gravado c sucesso
            } else {
                // erro
                echo "Erro ao gravar - $pathhorario";
            }
        ?>

        <h1>Horário</h1>
        <br>
		<img src="horarios/horario<?php echo $rowhorario['IDHorario']; ?>.png" alt="Horário"/>
	</div>

    <?php include 'footer.php'; ?>
</body>
</html>