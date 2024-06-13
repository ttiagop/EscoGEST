<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tarefas</title>
	<link href="tarefas1.css" rel="stylesheet">
</head>
<body>

	<?php include 'header.php'; ?>

	<div class="content">
		
		<h1>Tarefas</h1>
		<h2>Escolha a disciplina</h2><br>
		
		<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
			
			<?php

			$sqldisciplinas = "SELECT IDReg, IDDisciplina FROM turma_disciplina WHERE IDTurma = '$turma'";
        	$resultdisciplinas = $conn->query($sqldisciplinas);
        
        
        	if ($resultdisciplinas->num_rows > 0) {
        	    while ($rowdisciplinas = $resultdisciplinas->fetch_assoc()) {
        	        $reg = $rowdisciplinas['IDReg'];
        	        $disciplina = $rowdisciplinas['IDDisciplina'];

        	        $sqldisciplinas2 = "SELECT NomeDisciplina FROM disciplinas WHERE IDDisciplina = '$disciplina'";
        			$resultdisciplinas2 = $conn->query($sqldisciplinas2);
        			
        			if ($resultdisciplinas2->num_rows > 0) {

        				$rowdisciplinas2 = $resultdisciplinas2->fetch_assoc();

        				$nomedisciplina = $rowdisciplinas2['NomeDisciplina'];

        	?>


			<div class="col">
    			<div class="card shadow-sm">
        			<div class="card-body">
          				<h1 class="card-text"><a class="hiperligacoesInicio" href="vertarefas?t=<?php echo $reg ;?>"><?php echo $nomedisciplina; ?></a></h1>
          			</div>
        		</div>		
     		</div>

     		<?php        			
     				}
        	    }}
        	?>



		</div>
	</div>

	<?php include 'footer.php'; ?>

</body>
</html>