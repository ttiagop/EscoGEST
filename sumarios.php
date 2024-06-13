<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pesquisar sumário</title>
	   <link href="css/bootstrap-4.4.1.css" rel="stylesheet">
   <link href="styles.css" rel="stylesheet">
</head>
<body>

	<?php 
		include 'header.php'; 

		if ($tipo != 2) {
				header('Location: nacess');
			}
	?>

	<div class="content">
	
	<h1>Pesquisar sumários</h1><br>

		<form action="versumario.php" method="POST">
		
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

		<input type="submit" class="form-control" value="Pesquisar">

		</form>
		
	</div>

    <?php include 'footer.php'; ?>

</body>
</html>