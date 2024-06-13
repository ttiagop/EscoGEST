<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Marcar faltas</title>
</head>

<script type="text/javascript">
	function selecionarAluno(npaluno) {

    var selectAlunos = document.getElementById("selectAlunos");
    var options = selectAlunos.options;
    for (var i = 0; i < options.length; i++) {
        if (options[i].getAttribute("data-nprocesso") === npaluno) {
            options[i].selected = true;
            break;
        }
    }
    window.scrollTo({
        top: 200,
        behavior: 'smooth'
    });
}
</script>

<style type="text/css">
	.gallery:hover {
		cursor: pointer;
	}
</style>

<body>

	<div><?php include 'header.php'; ?></div>
	<?php 

		$turmaidreg = $_GET['t'];
		$naula = $_GET['n'];

		$sqlturmas = "SELECT IDTurma, IDReg, IDDisciplina FROM turma_disciplina WHERE IDReg = '$turmaidreg' AND IDProf = '$nproc'";
      	$resultturmas = $conn->query($sqlturmas); 

        	if ($resultturmas->num_rows > 0) {
        	    	$rowturmas = $resultturmas->fetch_assoc();
        	      $reg = $rowturmas['IDReg'];
        	      $turma = $rowturmas['IDTurma'];
        	      $disciplina = $rowturmas['IDDisciplina'];

        	      $sqlturmas2 = "SELECT AnoLetra, IDDiretor FROM turmas WHERE IDTurma = '$turma'";
        			$resultturmas2 = $conn->query($sqlturmas2);
        			
        			if ($resultturmas2->num_rows > 0) {

        				$rowturmas2 = $resultturmas2->fetch_assoc();

        				$nometurma = $rowturmas2['AnoLetra'];
        				$dt = $rowturmas2['IDDiretor'];

        				$sqldisciplinas2 = "SELECT NomeDisciplina FROM disciplinas WHERE IDDisciplina = '$disciplina'";
        				$resultdisciplinas2 = $conn->query($sqldisciplinas2);
	        				
	        				if ($resultdisciplinas2->num_rows > 0) {
	
	        					$rowdisciplinas2 = $resultdisciplinas2->fetch_assoc();
	
        					$nomedisciplina = $rowdisciplinas2['NomeDisciplina'];

        					
        						$sqldt = "SELECT Nome FROM utilizadores WHERE NProcesso = '$dt'";
        						$resultdt = $conn->query($sqldt);
	        				
	        					if ($resultdt->num_rows > 0) {
	
	        						$rowdt = $resultdt->fetch_assoc();
        							$nomedt = $rowdt['Nome']; 

        						}}
        					}}
	

				
				$sumarios = "SELECT * FROM aulas WHERE NumAula = '$naula'";
            

                $result = $conn->query($sumarios);
                
                if ($result->num_rows > 0) {
                    	$rowsumarios = $result->fetch_assoc();
                        $id = $rowsumarios['NumAula'];
                        $regconsulta = $rowsumarios['IDReg'];
                        $inicial = $rowsumarios['LInicial'];
                        $final = $rowsumarios['LFinal'];
                        $dataresult = $rowsumarios['Data'];
                        $sumario = $rowsumarios['Sumario']; 

                        $d = substr($dataresult, 8, 2) . "/" . substr($dataresult, 5, 2) . "/" . substr($dataresult, 0, 4);


                    }
                      


			
        	?>

	<div class="content">

		<h1>Marcar faltas</h1>
		<h2><?php echo $nometurma . " - " . $nomedisciplina; ?></h2>
		<h3><?php echo $d; ?> - Aula<?php if ($inicial != $final) { echo "s"; }?> N.º: <?php echo $inicial; if ($inicial != $final) { echo " - " . $final; }?></h3>
		<form action="inserirfalta.php" method="POST">
		<p style="text-align: right;">
			<button type="submit" class="btn btn-info">Guardar</button>
		</p>
		
		<label>Tipo de falta:</label>
		<select id="tipoFalta" name="tipoFalta" class="form-control">
		    <option value="1">Presença</option>
		    <option value="2">Atraso</option>
		    <option value="3">Material</option>
		    <option value="4">Ocorrência</option>
		    <option value="5">Disciplinar</option>
		</select><br>
		<div class="input-group">
			<textarea class="form-control" aria-label="With textarea" placeholder="Anotações" name="anotacoes"></textarea>
		</div><br>
		<label>Selecionar tempo:</label>
		<select id="selectTempo" name="selectTempo" class="form-control">
		    <?php
		        
		    	for ($i=$inicial; $i <= $final ; $i++) { 

		    		$tempo += 1;

		    		?>
		    		
		    		<option value="<?php echo $i; ?>"><?php echo $i; ?>.º aula - <?php echo $tempo; ?>.º tempo</option>

		    	<?php }

		    ?>
		    <option value="0">Todos os tempos</option>
		</select><br>
		<label>Selecionar aluno:</label>
        <select id="selectAlunos" name="selectAlunos" class="form-control">
		    <?php
		        $sqlalunos = "SELECT NProcesso, Nome FROM utilizadores WHERE Turma = '$turma'";
		        $resultalunos = $conn->query($sqlalunos);
		
		        if ($resultalunos->num_rows > 0) {
		            while ($rowalunos = $resultalunos->fetch_assoc()) {
		                $npaluno = $rowalunos['NProcesso'];
		                $nomealuno = $rowalunos['Nome'];
		    ?>
		        <option value="<?php echo $npaluno; ?>" data-nprocesso="<?php echo $npaluno; ?>" class="form-control" style="background-image:url(pPics/<?php echo $npaluno;?>.png);">
		            <?php echo $nomealuno; ?>
		        </option>
		    <?php
		            }
		        }
		    ?>
		</select>
		<input type="hidden" name="aula" value="<?php echo $_GET['n'] ?>">
		<input type="hidden" name="t" value="<?php echo $_GET['t'] ?>">
		</form>
		<div class="alunos">
		    <?php
		        $sqlalunos = "SELECT NProcesso, Nome FROM utilizadores WHERE Turma = '$turma'";
		        $resultalunos = $conn->query($sqlalunos);
		
		        if ($resultalunos->num_rows > 0) {
		            while ($rowalunos = $resultalunos->fetch_assoc()) {
		                $npaluno = $rowalunos['NProcesso'];
		                $nomealuno = $rowalunos['Nome'];
		    ?>
		        <div class="gallery" onclick="selecionarAluno('<?php echo $npaluno; ?>')">
		            <img src="pPics/<?php echo $npaluno;?>.png" alt="">
		            <div class="descf"><?php echo $nomealuno; ?></div>
		        </div>
		    <?php
		            }
		        }
		    ?>
		</div>
		<br>

</body>
</html>