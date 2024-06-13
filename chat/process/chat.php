<?php


    include("connection/connect.php");
    include("check.php");


    if (isset($_GET["id"]) && $_GET["id"] > 0){
        $user_id = $_GET["id"]; //isto antes estava como id

        // Get user

        //fazer a mesma coisa para os EE e professores (fazer algoritmo)

        $getUser = $conn->prepare("SELECT NProcesso, Nome FROM utilizadores WHERE (NProcesso LIKE '$user_id') LIMIT 1");
        $getUser->execute();
        $user = $getUser->get_result()->fetch_assoc();

        ?>
        <div class="topMenu">
            <img src="img/close.png" onclick="chat()" />
            <p class="title"><?php echo $user["Nome"]; ?></p>
        </div>

        <div class="innerContainer"></div>

        <form method="POST" enctype="multipart/form-data" id="sendMessage">
            <input type="number" value="<?php echo $user_id; ?>" name="id" hidden />
            <input type="text" maxlength="500" name="message" id="messageInput" placeholder="Escreva aqui a sua mensagem" />
            <input type='file' name="image" accept="image/x-png,image/jpeg" id="sendImage" hidden />
            <label for="sendImage"><img src="img/image.png" /></label>
        </form>

        <script>


            function sendMessage() {
                var formData = new FormData($("#sendMessage")[0]);
                $.ajax({
                    type: 'post',
                    url: 'process/send.php',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        $("#sendMessage")[0].reset();
                    },
                    error: function (error) {
                        Swal.fire({
                            title: 'Mensagem não enviada',
                            text: error.statusText,
                            icon: 'error',
                            confirmButtonText: 'Tentar novamente'
                        })
                    }
                });

                $.ajax({


                    url: 'process/retrieve.php?id=<?php echo $user_id; ?>',
                    success: function (data) {
                        $('#chat .innerContainer').html(data);
                        $('#chat .innerContainer').scrollTop($('#chat .innerContainer').prop("scrollHeight"));
                        
                    },
                    error: function (error) {
                        Swal.fire({
                            title: 'Erro de chat',
                            text: error.statusText,
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        })
                    }
                });

            }

            $("#messageInput").on('keyup', function (e) {
                if (e.keyCode === 13 && ($("#messageInput").val().length > 0)) {
                    sendMessage()
                }
            });

            $("#sendImage").change(function() {
                sendMessage();
                console.log("SEND");
            });


            setInterval(() => {
                $.ajax({
                    url: 'process/retrieve.php?id=<?php echo $user_id; ?>',
                    success: function (data) {
                        $('#chat .innerContainer').html(data);
                        $('#chat .innerContainer').scrollTop($('#chat .innerContainer').prop("scrollHeight"));
                    },
                    error: function (error) {
                        Swal.fire({
                            title: 'Erro de chat',
                            text: error.statusText,
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        })
                    }
                });
            }, 1000);


        </script>

            

        <?php
    } else {
        ?>
        <div class="empty">
            <img src="img/empty-chat.png" />
            <p>Selecione uma conversa, ou crie uma nova</p>
        </div>
        <?php
    }
?>