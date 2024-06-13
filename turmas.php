<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Turmas</title>
	<link href="tarefas1.css" rel="stylesheet">
</head>
<body>

	<?php 
		include 'header.php'; 

		if ($tipo != 2) {
				header('Location: nacess');
			}
	?>

	<div class="content">
		
		<h1>Turmas</h1>
		<h2>Escolha a turma desejada</h2><br>
		
		<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
			<?php

			$getidturma = "SELECT `IDTurma` FROM `turmas` WHERE IDDiretor = '$nproc'";

            $resultidturma = $conn->query($getidturma);
                
                if ($resultidturma->num_rows > 0) { ?>


			<div class="col">
    			<div class="card shadow-sm">
        			<div class="card-body">
          				<h1 class="card-text"><a class="hiperligacoesInicio" href="dt">Direção de Turma</a></h1>
          			</div>
        		</div>		
     		</div>

			<?php

		}

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


			<div class="col">
    			<div class="card shadow-sm">
        			<div class="card-body">
          				<h1 class="card-text"><a class="hiperligacoesInicio" href="turma?id=<?php echo $reg ;?>"><?php echo $nometurma . " - " . $nomedisciplina ; ?></a></h1>
          			</div>
        		</div>		
     		</div>

     		<?php        			
     				}}
        	    }}
        	?>



		</div>
	</div>

	<?php include 'footer.php'; ?>

</body>
</html>