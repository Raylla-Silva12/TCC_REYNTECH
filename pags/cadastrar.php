<?php include('../pags/header.php'); ?>

<body class="fundo-login-cad">

    <div class="container">
        <div class="row">

            
                <?php
                    session_start();
                    include_once("../php/conexao.php");
                    if (isset($_POST['nome'], $_POST['email'], $_POST['celular'], $_POST['codigo'], $_POST['senha'], $_POST['c_senha'])) {
                        Cadastrar($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['celular']);
                    }
                ?>

            <form method="POST">
                <section>
                    <div class="container mt-5 pt-5">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-8 col-lg-6 m-auto">
                                <div class="card border-0">
                                    <div class="card-body shadow-lg">
                                        <a href="../index.php"><button type="button" class="btn-close" aria-label="Close"></button></a>
										<img class="rounded mx-auto d-block" src="../assets/cactu.gif" alt="Logo" height="120px" width="150px">
                                        <input class="form-control mb-2" type="text" name="nome" placeholder="Nome" required>
                                        <input class="form-control mb-2" id="email" type="email" name="email" placeholder="E-mail" required>
                                        <input class="form-control mb-2" type="number" name="celular" placeholder="Celular" required>
                                        <input class="form-control mb-2" type="password" id="senha1" name="senha" placeholder="Senha" required>
                                        <input class="form-control mb-2" type="password" id="senha2" onchange="senhaDiff()" name="c_senha" placeholder="Confirmar Senha" required>

                                        <button type="submit" id="btn" class="btn btn-outline-primary btn-sm">Confirmar</button>
                                        <a href="login.php" class="btn btn-outline-primary btn-sm">Voltar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>

            <script>
                function senhaDiff() {
                    var senha1 = document.getElementById("senha1").value;
                    var senha2 = document.getElementById("senha2").value;

                    if (senha2 != senha1) {
                        document.getElementById('senha2').style.borderColor = 'red';
                        document.getElementById('senha2').style.color = 'red';
                        document.getElementById("btn").disabled = true;
                    } else {
                        document.getElementById('senha2').style.borderColor = 'green';
                        document.getElementById('senha2').style.color = 'green';
                    }
                }
            </script>

        </div>
    </div>

</body>

</html>