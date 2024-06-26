<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EscoGEST - Chat</title>
    <link rel="icon" type="image/png" href="img/favicon.png" />
	    <!-- Bootstrap -->
    <link href="/pap/css/bootstrap-4.4.1.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="style/homepage.css">
    <link type="text/css" rel="stylesheet" href="style/inbox.css">
    <link type="text/css" rel="stylesheet" href="style/chat.css">
    <link type="text/css" rel="stylesheet" href="style/profile.css">
    <script src="js/jquery.js"></script>

    <!-- Other imports -->
    <script src="js/sweetalert2.js"></script>
    <link rel="stylesheet" href="style/sweetalert2.css">
	
</head>

	<?php  
      include '../auth_session.php'; 
      include 'process/connection/connect.php';
    ?>

	

  <body>
    
    <div id="loading">Loading&#8230;</div>

    <div id="inbox" class="column">
        <p class="title">Conversas</p>
        <input type="text" maxlength="32" name="username" class="searchField" onkeyup="search()" placeholder="Pesquisar utilizador" />
        <div id="searchContainer"></div>
        <div class="container"></div>
    </div>

    <div id="chat" class="column"></div>

    <div id="profile" class="column">
        <p class="title">Perfil</p>
        <div class="container"></div>
        <div class="menu">
        </div>
    </div>

    <script>
        function loadInbox() {
            $.ajax({
                url: 'process/inbox.php',
                success: function (data) {
                    $('#inbox .container').html(data);
                },
                error: function (error) {
                    console.log(error);
                    Swal.fire({
                        title: 'Erro',
                        text: error.statusText,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    })
                }
            });
        }

        setInterval(loadInbox, 3000);

        function loadProfile(id = 0) {
            $.ajax({
                url: 'process/profile.php?id=' + id,
                success: function (data) {
                    $('#profile .container').html(data);
                },
                error: function (error) {
                    console.log(error);
                    Swal.fire({
                        title: 'Erro',
                        text: error.statusText,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    })
                }
            });
        }

        function chat(id = 0) {
            $.ajax({
                url: 'process/chat.php?id=' + id,
                success: function (data) {
                    $('#chat').html(data);
                    loadProfile(id);
                    console.log(id);
                },
                error: function (error) {
                    console.log(error);
                    Swal.fire({
                        title: 'Erro',
                        text: error.statusText,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    })
                }
            });
        }

        function search() {
            var term = $( "input.searchField" ).val();
            if (term.length >= 3) {
                $.ajax({
                    url: 'process/search.php?term=' + term,
                    success: function (data) {
                        $('#searchContainer').show();
                        $('#searchContainer').html(data);
                    }
                });
            } else {
                $('#searchContainer').hide();
            }
        }

        function logout() {
            $.ajax({
                url: 'process/logout.php',
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function () {
                    location.href = 'auth.html';
                }
            });
        }

        $( document ).ready(function() {
            setInterval(() => {
                loadInbox();
            }, 3000);
            loadProfile();
            chat();
        });
    </script>
</body>
</html>