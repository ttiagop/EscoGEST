<?php
    include("connection/connect.php");
    include("../../auth_session.php");

    function timing ($time)
    {

        $time = time() - $time;
        $time = ($time<1) ? 1 : $time;
        $tokens = array (
            31536000 => 'ano',
            2592000 => 'mês',
            604800 => 'semana',
            86400 => 'dia',
            3600 => 'hora',
            60 => 'minuto',
            1 => 'segundo'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);
            if ($text == "segundo") {
                return "agora mesmo";
            }
            return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
        }

    }

    if(isset($_SESSION['username'] /* ou entao _$COOKIE['']) /*&& isset($_COOKIE["TOKEN"]) && isset($_COOKIE["SECURE"])*/)) {
        // Normalization
        $id = $_SESSION["username"]; // ou $_COOKIE["ID/USERNAME"]
        //$token = $_COOKIE["TOKEN"];
        //$secure = $_COOKIE["SECURE"];

        // Query
        $stmt = $conn->prepare("SELECT NProcesso, Nome, Foto, Online FROM utilizadores WHERE (NProcesso = '$id' /*AND Token LIKE ? AND Secure = ?*/) LIMIT 1");
        $stmt->execute();
        $me = $stmt->get_result()->fetch_assoc();
    }
        // Check if exists
        if (!$me) {
            die("<script>location.href = 'auth.html';</script>");
        } else {
            // Normalize information
            $uid = $me["NProcesso"];
            $name = $me["Nome"];
            $user_picture = $me["Foto"];
            $user_online = strtotime($me["Online"]);
            //$user_creation = $me["Creation"];

            // Online status pin-point
            $stmt = $conn->prepare("UPDATE utilizadores SET Online = now() WHERE NProcesso = '$uid' ");
            //$stmt->bind_param("i", $uid);
            $stmt->execute();
        }
    /*else {
        die("<script>location.href = 'auth.html';</script>");
    }*/
?>