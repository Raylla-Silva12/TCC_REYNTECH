<?php
    session_start();
    include_once('../php/protect_admin.php');
    include_once('../php/conexao.php');
?>

<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-light mb-5">
        <div class="container-fluid">
            <img src="../assets/logo.png" width="34" height="28" alt="logo"> 
            <a class="navbar-brand mx-3" href="#"><h2>M&S Garden</h2></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav bg-light">
                    <a class="nav-link text-dark" aria-current="page" href="admin.php">Produtos</a>
                    <!-- <a class="nav-link text-dark" href="adminCuriosidades.php">Curiosidades</a> -->
                    <a class="nav-link active" href="adminUsuarios.php">Usuários</a>
                </div>
                <div class="logout-icon">
                    <a href="logoutAdmin.php" class="mx-4">
                        <img src="../assets/logout.svg" class="bg primary" width="35" height="35" alt="logout">  
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!-- FIM NAVBAR -->

    <style>
        .logout-icon {
            margin-left: 70vw;
        }
    </style>    

    <div id="displayUsuario"></div>
    
     <!-- Copyright Start -->
     <div class="container-fluid copyright text-light py-4 wow fadeIn mt-5" data-wow-delay="0.1s">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a href="#">REYNTECH</a>, All Right Reserved.
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <script>
        $(document).ready(function() {
            displayUsuarioData();
        });

        // Exibir display
        function displayUsuarioData() {
            var displayUsuarioData = "true";

            $.ajax({
                url: 'displayUsuarios.php',
                type: 'post',
                data: {
                    displayUsuarioSend: displayUsuarioData
                },
                success: function(data, status) {
                    $('#displayUsuario').html(data);
                }
            });
        }

        // Deleção do Produto
        function deleteProduto(deleteid) {
            $.ajax({
                url: 'db_admin/deleteUsuario.php',
                type: 'post',
                data: {
                    deletesend: deleteid
                },
                success: function(data, status) {
                    displayUsuarioData();
                }
            });
        }

    </script>
</body>

</html>