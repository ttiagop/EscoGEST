<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sumários</title>
</head>
<body>

	<?php 
		include 'header.php'; 

		if ($tipo != 2) {
				header('Location: nacess');
			}
	?>
	
	<div class="content">
	
		<h1>Novo sumário</h1><br>

		<form action="gsumario.php" method="POST">
		
		<div>
			<h3>Turma/Disciplina</h3>
			<select class="form-control" name="reg">

				<?php

			$sqlturmas = "SELECT IDTurma, IDReg, IDDisciplina FROM turma_disciplina WHERE IDProf = '$nproc'";
        	$resultturmas = $conn->query($sqlturmas);
        
        
        	if ($resultturmas->num_rows > 0) {
        	    while ($rowturmas = $resultturmas->fetch_assoc()) {
        	        $reg = $rowturmas['IDReg'];
        	        $turma = $rowturmas['IDTurma'];
        	        $disciplina = $rowturmas['IDDisciplina'];

        	        $sqlturmas2 = "SELECT AnoLetra FROM turmas WHERE IDTurma = '$turma'";
        			$resultturmas2 = $conn->query($sqlturmas2);
        			
        			if ($resultturmas2->num_rows > 0) {

        				$rowturmas2 = $resultturmas2->fetch_assoc();

        				$nometurma = $rowturmas2['AnoLetra'];

        				$sqldisciplinas2 = "SELECT NomeDisciplina FROM disciplinas WHERE IDDisciplina = '$disciplina'";
        				$resultdisciplinas2 = $conn->query($sqldisciplinas2);
	        				
	        				if ($resultdisciplinas2->num_rows > 0) {
	
	        					$rowdisciplinas2 = $resultdisciplinas2->fetch_assoc();
	
        					$nomedisciplina = $rowdisciplinas2['NomeDisciplina'];

        	?>

				<option value="<?php echo $reg ;?>"><?php echo $nometurma . " - " . $nomedisciplina ; ?></option>



				<?php        			
     				}}
        	    }}
        	?>

			</select>
		</div>
		<br>

		<h3>Data</h3>
		<input class="form-control" type="date" name="data"><br>

		<h3>N.º de tempos</h3>
		<input class="form-control" type="number" name="tempos" value="1" min="1" max="4" maxlength="1" oninput="validarEntradaNumerica(event)"><br>

		<script type="text/javascript">
			function validarEntradaNumerica(event) {
			    let valorAtual = event.target.value;
			
			    let valorNumerico = valorAtual.replace(/[^1-4]/g, '1');
			
			    event.target.value = valorNumerico;
			}
		</script>
		
		<h3>Sumário</h3>
		<div class="input-group">
			<textarea class="form-control" aria-label="With textarea" placeholder="Escrever sumário..." name="sumario"></textarea>
		</div>
		<br>
		<input type="submit" class="form-control" value="Guardar">

		</form>
		
	</div>

    <?php include 'footer.php'; ?>


</body>
</html>