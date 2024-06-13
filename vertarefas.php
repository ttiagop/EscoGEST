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
	<link href="tarefasview.css" rel="stylesheet">

		<?php

		$reg = $_GET['t'];

			$sqldisciplinas = "SELECT IDDisciplina, IDTurma FROM turma_disciplina WHERE IDReg = '$reg'";
        	$resultdisciplinas = $conn->query($sqldisciplinas);
        
        
        	if ($resultdisciplinas->num_rows > 0) {
        			$rowdisciplinas = $resultdisciplinas->fetch_assoc();
        	       	$disciplina = $rowdisciplinas['IDDisciplina'];
        	       	$turmaC = $rowdisciplinas['IDTurma'];

        	        $sqldisciplinas2 = "SELECT NomeDisciplina FROM disciplinas WHERE IDDisciplina = '$disciplina'";
        			$resultdisciplinas2 = $conn->query($sqldisciplinas2);
        			
        			if ($resultdisciplinas2->num_rows > 0) {

        				$rowdisciplinas2 = $resultdisciplinas2->fetch_assoc();

        				$nomedisciplina = $rowdisciplinas2['NomeDisciplina'];

        			}

        			$sqlturmas2 = "SELECT AnoLetra FROM turmas WHERE IDTurma = '$turmaC'";
        			$resultturmas2 = $conn->query($sqlturmas2);
        			
        			if ($resultturmas2->num_rows > 0) {

        				$rowturmas2 = $resultturmas2->fetch_assoc();

        				$nometurma = $rowturmas2['AnoLetra'];
        			}

        	    }

        ?>

        <h1><?php echo $nometurma; ?> - <?php echo $nomedisciplina; ?></h1>

        <?php 
        	if ($tipo == 2) { ?>

        		<div class="opcoes">
        			<form method="post" action="criartarefa?c=<?php echo $reg; ?>">
        				<button type="submit" class="btn" style="background-color: #3ca9e2; color: white;">Criar tarefa</button>
        			</form>
        		</div><br>

        <?php } ?>

        <?php 

        	$sqltarefas = "SELECT IDTarefa, IDReg, TituloTarefa, DescTarefa, DataPub, DataFim FROM tarefas WHERE IDReg = '$reg' ORDER BY IDTarefa DESC";
        	$resulttarefas = $conn->query($sqltarefas);
        
        
        	if ($resulttarefas->num_rows > 0) {
        	    while ($rowtarefas = $resulttarefas->fetch_assoc()) {
        	        $idtarefa = $rowtarefas['IDTarefa'];
        	        $reg = $rowtarefas['IDReg'];
        	        $titulo = $rowtarefas['TituloTarefa'];
        	        $desc = $rowtarefas['DescTarefa'];
        	        $pub = $rowtarefas['DataPub'];
        	        $fim = $rowtarefas['DataFim'];
        ?>

		<div class="col">
    			<div class="card shadow-sm">
        			<div class="card-body">
          				<h1 class="card-text"><a class="hiperligacoesInicio" href="tarefa?tr=<?php echo $idtarefa; ?>"><?php echo $titulo; ?></a></h1>

          				<?php 

          					$f = substr($fim, 0, 4) . substr($fim, 5, 2) . substr($fim, 8, 2) . substr($fim, 11, 2) . substr($fim, 14, 2);

          					$dataatual = date("YmdHi");
          					//echo "atual: " . $dataatual . " - ";

          					if ($f == 0) { ?>
          						<p style="color: green;"><b>Sem data de conclusão</b></p>
          					<?php } else {

          					if (($f - $dataatual) > 0) {
          						if (($f - $dataatual) <= 1000) { ?>

          							<p style="color: #e6c80b;"><b><?php echo substr($fim, 8, 2) . "/" . substr($fim, 5, 2) . "/" . substr($fim, 0, 4) . " - " . substr($fim, 10, 6) ; ?></b></p>

          						<?php } else { ?>

          							<p style="color: green;"><b><?php echo substr($fim, 8, 2) . "/" . substr($fim, 5, 2) . "/" . substr($fim, 0, 4) . " - " . substr($fim, 10, 6) ; ?></b></p>

          					<?php	}

          					} else { ?>

          						<p style="color: red;"><b><?php echo substr($fim, 8, 2) . "/" . substr($fim, 5, 2) . "/" . substr($fim, 0, 4) . " - " . substr($fim, 10, 6) ; ?></b></p>

          				<?php	}}

          				?>
          			</div>
        		</div>		
     		</div>

		<?php        			
     				}
        	    }
        	?>
	
	</div>

	<?php include 'footer.php'; ?>

</body>
</html>