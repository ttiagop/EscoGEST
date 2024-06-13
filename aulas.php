<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Aulas</title>
</head>
<body>

	<?php include 'header.php'; ?>


	<div class="content">


		<nav class="navbar navbar-expand-lg rounded">
  			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		
		  <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
		    <ul class="navbar-nav">
		      <li class="nav-item">
		        <a class="nav-link" href="novosumario"><b>Novo sumário</b></a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="sumarios"><b>Ver sumários</b></a>
		      </li>
		    </ul>
		  </div>
		</nav>

		<?php

            $sqlhorario = "SELECT IDHorario, FicheiroHorario FROM horario WHERE IDTurma = '$turma'";
            $resulthorario = $conn->query($sqlhorario);
            $rowhorario = $resulthorario->fetch_assoc();

            if ($resulthorario->num_rows > 0) {

            $horarioblob = $rowhorario['FicheiroHorario'];

            $pathhorario = 'horarios/horario' . $rowhorario['IDHorario'] . '.png';

            
            if (file_put_contents($pathhorario, $horarioblob) !== false) {
                // gravado c sucesso
            } else {
                // erro
                echo "Erro ao gravar - $pathhorario";
            } ?>


		<br>
		<h1>Horário</h1>
        <br>
		<img src="horarios/horario<?php echo $rowhorario['IDHorario']; ?>.png" alt="Horário"/>

		<?php } else { ?>

			<br>
			<h3 style="color: red;">Horário não encontrado</h3>

		<?php } ?>

	</div>

    <?php include 'footer.php'; ?>


</body>
</html>