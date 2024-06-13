<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Criar tarefa</title>
	<link href="css/bootstrap-4.4.1.css" rel="stylesheet">
	<link href="styles.css" rel="stylesheet">
	<link href="tarefasview.css" rel="stylesheet">
</head>
<body>

	<?php include 'header.php'; ?>

	<div class="content">

		<?php

		$reg = $_GET['c'];

			$sqlturma = "SELECT IDTurma, IDDisciplina FROM turma_disciplina WHERE IDReg = '$reg'";
        	$resultturma = $conn->query($sqlturma);
        
        
        	if ($resultturma->num_rows > 0) {
        		$rowturma2 = $resultturma->fetch_assoc();
        			$idturma = $rowturma2['IDTurma'];
        			$disciplina = $rowturma2['IDDisciplina'];

        			$sqlturma2 = "SELECT AnoLetra FROM turmas WHERE IDTurma = '$idturma'";
        			$resultturma2 = $conn->query($sqlturma2);

        			if ($resultturma2->num_rows > 0) {
        				$rowturma3 = $resultturma2->fetch_assoc();
        				$nometurma = $rowturma3['AnoLetra'];

        				$sqldisciplinas2 = "SELECT NomeDisciplina FROM disciplinas WHERE IDDisciplina = '$disciplina'";
        				$resultdisciplinas2 = $conn->query($sqldisciplinas2);
	        				
	        				if ($resultdisciplinas2->num_rows > 0) {
	
	        					$rowdisciplinas2 = $resultdisciplinas2->fetch_assoc();
	
        					$nomedisciplina = $rowdisciplinas2['NomeDisciplina'];
        				}
        			}
        	    }

        ?>

        <script type="text/javascript">
		    function validartarefa() {
		        var x = document.forms["criartarefa"]["titulo"].value;
		        if (x == "") {
		            document.getElementById("valida").innerHTML = "O título não pode estar vazio";
		            return false;
		        }
		        return true;
		    }
		</script>
		
		<h3>Criar tarefa - <?php echo $nometurma, " - ", $nomedisciplina;?></h3>
		<form name="criartarefa" onsubmit="return validartarefa()" method="post" enctype="multipart/form-data" action="ct">
		
		    <input type="hidden" name="reg" value="<?php echo $reg; ?>">
		    
		    <input class="form-control" type="text" name="titulo" style="margin-bottom: 10px;" placeholder="Título">
		    <b><p id="valida" style="color: red;"></p></b>
		
		    <div class="input-group">
		        <textarea class="form-control" aria-label="With textarea" placeholder="Descrição" name="descricao"></textarea>
		    </div><br>
		    <div>
		        <div class="ficheiro">
		            <div class="mb-3">
		                <div style="display: flex; margin-bottom: 10px;">
		                <b style="color: #575757;">Anexar ficheiro:</b>
		                <input class="form-control" type="file" name="ficheiro" style="margin-bottom: 10px;">
		                </div>    
		                
		                <div style="display: flex; margin-bottom: 10px;">
		                <b style="color: #575757;">Data de conclusão:</b>
		                <input class="form-control" type="datetime-local" name="datafim">
		                </div>

		                <div style="display: flex; margin-bottom: 10px;">
		                <b style="color: #575757;">Permitir entregas após o prazo?</b>
		                <select name="trancar" id="trancar" class="form-control">
						  <option value="0">Sim</option>
						  <option value="1">Não</option>
						</select>
		                </div>
		            </div>
		            <input type="submit" name="criar" class="form-control">
		        </div>
		    </div>
		</form>

		</div>
	</div></div>
	
	<?php include 'footer.php'; ?>

</body>
</html>