<?php 

include('dbcon.php');

$username = $_GET['username'];
$password = $_GET['password'];

$md5 = md5($password);

$sql = "SELECT * FROM utilizadores WHERE NProcesso = '$username' AND Password = '$md5'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    $row = $result->fetch_assoc();

    session_start();

    $_SESSION['username'] = $row['NProcesso'];

    var_dump($_SESSION['username']);

    header('Location: /pap');

} else {

    header('Location: entrar ');

}

?>