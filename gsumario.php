<?php 

	include 'dbcon.php';


	$reg = $_POST['reg'];
	$data = $_POST['data'];
    $ntempos = $_POST['tempos'];
    $sumario = $_POST['sumario'];


    $sumarios = "SELECT LInicial, LFinal FROM aulas WHERE IDReg = '$reg' ORDER BY NumAula DESC";
            $result = $conn->query($sumarios);
        
        
            $rowsumarios = $result->fetch_assoc();
                $inicial = $rowsumarios['LInicial'];
                $final = $rowsumarios['LFinal'];


                $i = $final + 1;
                $f = $final + $ntempos;




	$gs = "INSERT INTO `aulas` (`NumAula`, `IDReg`, `LInicial`, `LFinal`, `Data`, `Sumario`) VALUES ('', '$reg', '$i', '$f', '$data', '$sumario');";
    $conn->query($gs);


    $conn->close();


    header('Location: aulas');
        

?>