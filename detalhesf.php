<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Faltas</title>
</head>
<body>

    <?php 
        include 'header.php'; 

        
    ?>


    <style type="text/css">
        .card-text {
            text-align: left;
        }
    </style>

    <div class="content">

        <h3>Detalhes</h3><br>

        <table class="table">
                          <thead>
                            <tr>
                            <th scope="col">Nome</th>
                              <th scope="col">Data</th>
                              <th scope="col">Disciplina</th>
                              <th scope="col">Tempo</th>
                              <th scope="col">Tipo</th>
                              <th scope="col">Estado</th>
                            </tr>
                          </thead>
        <?php 
        
            include 'dbcon.php';

            $idf = $_GET['f'];
                
            
                $faltas = "SELECT * FROM `falta_aluno` WHERE IDFalta = '$idf'";
            

                $result = $conn->query($faltas);
                
                if ($result->num_rows > 0) {
                    while ($rowfaltas = $result->fetch_assoc()) {
                        $aula = $rowfaltas['AulaFalta'];
                        $tempo = $rowfaltas['Tempo'];
                        $tipo = $rowfaltas['TipoFalta'];
                        $desc = $rowfaltas['DescFalta'];
                        $just = $rowfaltas['Just'];
                        $npa = $rowfaltas['NPAluno'];

                        if ($tipo == 1) {
                            $tipo = "Presença";
                        }

                        if ($tipo == 2) {
                            $tipo = "Atraso";
                        }

                        if ($tipo == 3) {
                            $tipo = "Material";
                        }

                        if ($tipo == 4) {
                            $tipo = "Ocorrência";
                        }

                        if ($tipo == 5) {
                            $tipo = "Disciplinar";
                        }

                        $infoaula = "SELECT * FROM aulas WHERE NumAula = '$aula'";
            

                        $resultinfoaula = $conn->query($infoaula);
                        
                        if ($resultinfoaula->num_rows > 0) {
                                $rowinfo = $resultinfoaula->fetch_assoc();
                                $id = $rowinfo['NumAula'];
                                $regconsulta = $rowinfo['IDReg'];
                                $inicial = $rowinfo['LInicial'];
                                $final = $rowinfo['LFinal'];
                                $dataresult = $rowinfo['Data'];
                                $sumario = $rowinfo['Sumario']; 

                        $d = substr($dataresult, 8, 2) . "/" . substr($dataresult, 5, 2) . "/" . substr($dataresult, 0, 4);

                        //vai buscar o tempo a primeira query
                        if ($tempo == 0) {
                            $tempo = $inicial . " - " . $final;
                        }

                    }
                    
                    $sqlturmas = "SELECT IDDisciplina, IDProf, IDTurma FROM turma_disciplina WHERE IDReg = '$regconsulta'";
                    $resultturmas = $conn->query($sqlturmas); 

                    if ($resultturmas->num_rows > 0) {
                            $rowturmas = $resultturmas->fetch_assoc();
                            $disciplina = $rowturmas['IDDisciplina'];
                            $prof = $rowturmas['IDProf'];
                            $idturma = $rowturmas['IDTurma'];

                  

                        $sqldisciplinas2 = "SELECT NomeDisciplina FROM disciplinas WHERE IDDisciplina = '$disciplina'";
                        $resultdisciplinas2 = $conn->query($sqldisciplinas2);
                            
                            if ($resultdisciplinas2->num_rows > 0) {
    
                                $rowdisciplinas2 = $resultdisciplinas2->fetch_assoc();
    
                            $nomedisciplina = $rowdisciplinas2['NomeDisciplina']; }}

                            $alunos = "SELECT `NProcesso`, `Nome` FROM `utilizadores` WHERE NProcesso = '$npa'";

            $resultalunos = $conn->query($alunos);
                
                if ($resultalunos->num_rows > 0) {
                    while ($rowalunos = $resultalunos->fetch_assoc()) {
                        $nptaluno = $rowalunos['NProcesso'];
                        $nomealuno = $rowalunos['Nome'];

                        ?>


                        
                          <tbody>
                            <tr>
                                <td><b><?php echo $nomealuno; ?></b></td>
                              <td><b><?php echo $d; ?></b></td>
                              <td><?php echo $nomedisciplina; ?></td>
                              <td><?php echo $tempo; ?></td>
                              <td><?php echo $tipo; ?></td>
                              <td>

                                <?php 
                                    if ($just == "") { ?>


                                        <p style="color: red;"><b>Injustificada</b></p>

                                <?php    
                                    } else { ?>

                                        <p style="color: green;"><b>Justificada</b></p>

                                <?php } ?>
                                  
                            
                            </tr>
                            </tbody>
                        </table>

                            <?php 
                                if ($desc != "") {
                            ?>

                            <p><b>Descrição/Notas:</b></p>
                            <p><?php echo $desc; ?></p>

        
                <?php }}}}} else { ?>

                    <h3>Não foram encontrados resultados.</h3>
                    <p style="color: red;"><b>Turma não existente!</b></p>

                <?php }
        
        
            

            if ($just == "") {


            $checkdt = "SELECT `IDDiretor` FROM `turmas` WHERE IDTurma = '$idturma'";

            $resultcheckdt = $conn->query($checkdt);
                
                if ($resultcheckdt->num_rows > 0) {
                    $rowcheckdt = $resultcheckdt->fetch_assoc();
                    $iddt = $rowcheckdt['IDDiretor'];

                    if ($iddt == $nproc) { ?>
                        <br>
                        <form action="justificar" method="POST">
                            <textarea class="form-control" aria-label="With textarea" placeholder="Justificar..." name="just"></textarea>
                            <input type="hidden" name="f" value="<?php echo $idf; ?>">
                            <button type="submit" class="btn btn-success" style="margin-top: 10px;">Justificar</button>
                        </form>

                    <?php }

                    ?>
                

                    
        
        <?php }} else {


            $checkdt = "SELECT `IDDiretor` FROM `turmas` WHERE IDTurma = '$idturma'";

            $resultcheckdt = $conn->query($checkdt);
                
                if ($resultcheckdt->num_rows > 0) {
                    $rowcheckdt = $resultcheckdt->fetch_assoc();
                    $iddt = $rowcheckdt['IDDiretor'];

                    if ($iddt == $nproc) { ?>
                        <br>
                        <p style="color: green;"><b>Justificação:</b></p>
                        <form action="justificar" method="POST">
                            <textarea class="form-control" aria-label="With textarea" placeholder="Justificar..." name="just"><?php echo $just; ?></textarea>
                            <input type="hidden" name="f" value="<?php echo $idf; ?>">
                            <button type="submit" class="btn btn-success" style="margin-top: 10px;">Atualizar justificação</button>
                        </form>


        <?php } else { ?>


            <br>
            <p style="color: green;"><b>Justificação:</b></p>
            <textarea disabled class="form-control" aria-label="With textarea" placeholder="Justificar..." name="just"><?php echo $just; ?></textarea>


    <?php }}}

        $conn->close(); ?>

          
        
        </div>
            


    <?php include 'footer.php'; ?>


</body>
</html>