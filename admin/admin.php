<?php
    session_start();
    include_once('../php/protect_admin.php');
    include_once("../php/conexao.php");
?>

<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <img src="../assets/logo.png" width="34" height="28" alt="logo"> 
            <a class="navbar-brand mx-3" href="#"><h2>M&S Garden</h2></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav bg-light">
                    <a class="nav-link active" aria-current="page" href="admin.php">Produtos</a>
                    <a class="nav-link text-dark" href="#">Curiosidades</a>
                    <a class="nav-link text-dark" href="#">Usuários</a>
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
            margin-left: 64vw;
        }

        /* ADM */
        input[type="file"] {
            display: none;
        }

        .label-file {
            padding: 16px 16px;
            border: 1px solid var(--secondary);
            color: var(--secondary);
            display: block;
            cursor: pointer;
        }

        .label-file:hover {
            background-color: var(--primary); 
            opacity: 0.8;
            border: 1px solid var(--primary);
            color: white;
        }

        .input-file {
            border-left: 1px solid var(--secondary) !important;
            background-color: white !important;
        }

        .add_Categoria {
            display: none !important;
        }

        .add_Categoria_btn {
            border-start-end-radius: 8px !important;
            border-end-end-radius: 8px !important;
        }
    </style>

    <!-- Modal de Cadastro -->
    <form method="POST" id="addForm" enctype="multipart/form-data">
        <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" data-static tabindex="-1">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel">Cadastrar Produto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="px-4">
                            <div class="row g-4">
                                <div class="col-md py-2">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="nomeProduto" placeholder="Rosa">
                                        <label for="nomeProduto">Nome do Produto</label>
                                    </div>
                                </div>

                                <div class="col-md py-2">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" name="valorProduto" placeholder="R$10,00">
                                        <label for="valorProduto">Valor do Produto</label>
                                    </div>
                                </div>
                            </div>


                            <div class="row g-4">
                                <div class="col-md py-2">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Bela rosa..." name="descricaoProduto"></textarea>
                                        <label for="descricaoProduto">Descrição do Produto</label>
                                    </div>
                                </div>

                                <div class="col-md py-2">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" name="qtdProduto" placeholder="3">
                                        <label for="qtdProduto">Quantidade do Produto</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-4">
                                <div class="col-md py-2">
                                    <div class="input-group">
                                        <select class="form-select py-3" id="select" name="categoriaProduto" onchange="adicionarCategoria()">
                                            <option selected>Categoria do Produto</option>

                                            <?php
                                            $sql = "SELECT * FROM tb_categoria";
                                            $res = mysqli_query($mysqli, $sql);

                                            while ($row = mysqli_fetch_assoc($res)) {
                                                echo "<option id='categoriaProduto' value='" . $row['cd_categoria'] . "'>" . $row['cd_categoria'] . "- " . $row['nm_categoria'] . "</option>";
                                            };
                                            ?>

                                        </select>

                                        <script>
                                            $(document).ready(function() {
                                                $("#btn").click(function() {
                                                    $("#addCat").toggleClass("add_Categoria");
                                                    $("#btn").toggleClass("add_Categoria_btn");
                                                    $("#btnSalvar").toggleClass("add_Categoria");
                                                });
                                            });
                                        </script>

                                        <button class="btn btn-outline-secondary add_Categoria_btn" id="btn" type="button">Add</button>
                                        <input type="text" id="addCat" class="form-control add_Categoria" placeholder="Adicionar Categoria" onchange="addCat()">
                                        <button class="btn btn-outline-secondary add_Categoria_btn add_Categoria" id="btnSalvar" onclick="salvarCat()" type="button">+</button>
                                    </div>
                                </div>

                                <div class="col-md py-2">

                                    <script>
                                        $(document).ready(function() {
                                            $("#file").change(function() {
                                                var nomeImg = $('#file').val();
                                                $("#status-input").val("Arquivo selecionado: " + nomeImg);
                                            });
                                        });
                                    </script>

                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control" id="file" name="file">
                                        <label for="file" class="label-file rounded-start">Selecione uma Imagem</label>
                                        <input type="text" class="form-control input-file" id="status-input" value="Arquivo não selecionado" disabled>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <a class="btn btn-dark mb-3 mx-3" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Adicionar Produto</a>
    <!-- Fim do Modal de Cadastro -->




    <!-- Modal de Edição -->
    <div class="modal fade" id="updateModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" data-static tabindex="-1">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel">Modal 1</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                        <div clas="px-4">
                    
                            <div class="row g-4">
                                <div class="col-md py-2">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="nomeProdutoAlter" placeholder="Nome do Produto">
                                        <label for="nomeProdutoAlter">Nome do Produto</label>
                                    </div>
                                </div>
                                <div class="col-md py-2">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="valorProdutoAlter" placeholder="Valor">
                                        <label for="valorProdutoAlter">Valor do Produto</label>
                                    </div>
                                </div> 
                            </div>

                            <div class="row g-4">
                                <div class="col-md py-2">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Bela rosa..." id="descricaoProdutoAlter"></textarea>
                                        <label for="descricaoProdutoAlter">Descrição do Produto</label>
                                    </div>
                                </div>

                                <div class="col-md py-2">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="qtdProdutoAlter" placeholder="3">
                                        <label for="qtdProdutoAlter">Quantidade do Produto</label>
                                    </div>
                                </div>
                            </div>


                            <div class="row g-4">
                                <div class="col-md py-2">
                                    <div class="input-group">
                                        <select class="form-select py-3" id="select">
                                            <option selected>Categoria do Produto</option>

                                            <?php
                                            $sql = "SELECT * FROM tb_categoria";
                                            $res = mysqli_query($mysqli, $sql);

                                            while ($row = mysqli_fetch_assoc($res)) {
                                                echo "<option id='categoriaProduto' value='" . $row['cd_categoria'] . "'>" . $row['cd_categoria'] . "- " . $row['nm_categoria'] . "</option>";
                                            };
                                            ?>

                                        </select>

                                        <script>
                                            $(document).ready(function() {
                                                $("#btn").click(function() {
                                                    $("#addCat").toggleClass("add_Categoria");
                                                    $("#btn").toggleClass("add_Categoria_btn");
                                                    $("#btnSalvar").toggleClass("add_Categoria");
                                                });
                                            });
                                        </script>

                                        <button class="btn btn-outline-secondary add_Categoria_btn" id="btn" type="button">Add</button>
                                        <input type="text" id="addCat" class="form-control add_Categoria" placeholder="Adicionar Categoria" onchange="addCat()">
                                        <button class="btn btn-outline-secondary add_Categoria_btn add_Categoria" id="btnSalvar" onclick="salvarCat()" type="button">+</button>
                                    </div>
                                </div>

                                <div class="col-md py-2">

                                    <script>
                                        $(document).ready(function() {
                                            $("#file").change(function() {
                                                var nomeImg = $('#file').val();
                                                $("#status-input").val("Arquivo selecionado: " + nomeImg);
                                            });
                                        });
                                    </script>

                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control" id="file" name="file">
                                        <label for="file" class="label-file rounded-start">Selecione uma Imagem</label>
                                        <input type="text" class="form-control input-file" id="status-input" value="Arquivo não selecionado" disabled>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary" onclick="updateDetails()">Alterar</button>
                        <input type="hidden" id="hiddendata">
                    </div>
                </div>
            </div>
    </div>
    <!-- Fim do Modal de Edição -->


    <div id="displayAdmin"></div>
    
     <!-- Copyright Start -->
     <div class="container-fluid copyright text-light py-4 wow fadeIn" data-wow-delay="0.1s">
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
            displayData();
        });

        // Exibir display
        function displayData() {
            var displayData = "true";

            $.ajax({
                url: 'display.php',
                type: 'post',
                data: {
                    displaySend: displayData
                },
                success: function(data, status) {
                    $('#displayAdmin').html(data);
                }
            });
        }
        

        // Exibir Categoria
        var categoriaProdutoAdd;

        function adicionarCategoria() {
            categoriaProdutoAdd = $(".form-select option:checked").val();
        }

        // Adicionar categoria

        if ($('#addCat').val() != null) {
            $("#btnSalvar").click(function(e){
                e.preventDefault();
                var retorno = confirm("O modal será reiniciado!");
                if (retorno == true) {
                    var addCat = $('#addCat').val();

                    $.ajax({
                        url: 'db_admin/addCat.php',
                        type: 'post',
                        data: {
                            addCatSend: addCat,
                        },
                        success: function(data, status) {
                            displayData();
                            location.reload();
                        }
                    });
                }
            });
        }


        // File type validation
        $("#file").change(function() {
            var file = this.files[0];
            var fileType = file.type;
            var match = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))) {
                alert('Sorry JPG, JPEG, & PNG files are allowed to upload.');
                $("#file").val('');
                return false;
            }
        });

        $(document).ready(function(e) {
            $("#addForm").on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'db_admin/addProduto.php',
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        displayData();
                        location.reload();
                    },
                    success: function(response) {
                        $('.statusMsg').html('');
                        if (response.status == 1) {
                            $('#addForm')[0].reset();
                            $('.statusMsg').html('<p class="alert alert-success">' + response.message + '</p>');
                        } else {
                            $('.statusMsg').html('<p class="alert alert-danger">' + response.message + '</p>');
                        }
                        displayData();
                    }
                });
            });
        });


        // Deleção do Produto
        function deleteProduto(deleteid) {
            $.ajax({
                url: 'db_admin/deleteProduto.php',
                type: 'post',
                data: {
                    deletesend: deleteid
                },
                success: function(data, status) {
                    displayData();
                }
            });
        }


        // Alteração de Produto
        function GetDetails(updateid) {
            $('#hiddendata').val(updateid);
            $.post('db_admin/updateProduto.php', {
                updateid: updateid
            }, function(data, status) {
                var produto = JSON.parse(data);
                $('#nomeProdutoAlter').val(produto.nm_produto);
                $('#valorProdutoAlter').val(produto.vl_preco);
                $('#descricaoProdutoAlter').val(produto.ds_produto);
                $('#qtdProdutoAlter').val(produto.qtd_produto);
                $('#categoriaProdutoAlter').val(produto.id_categoria);
                $('#imagemProdutoAlter').val(produto.ft_produto_principal);
            });

            $('#updateModal').modal('show');
        }

        //Eevento onclick do EDITAR 
        function updateDetails() {
            var nomeProdutoAlter = $('#nomeProdutoAlter').val();
            var valorProdutoAlter = $('#valorProdutoAlter').val();
            var descricaoProdutoAlter = $('#descricaoProdutoAlter').val();
            var qtdProdutoAlter = $('#qtdProdutoAlter').val();
            var categoriaProdutoAlter = $('#categoriaProdutoAlter').val();
            var imagemProdutoAlter = $('#imagemProdutoAlter').val();
            var hiddendata = $('#hiddendata').val();

            $.post('db_admin/updateProduto.php', {
                nomeProdutoAlter: nomeProdutoAlter,
                valorProdutoAlter: valorProdutoAlter,
                descricaoProdutoAlter: descricaoProdutoAlter,
                qtdProdutoAlter: qtdProdutoAlter,
                categoriaProdutoAlter: categoriaProdutoAlter,
                imagemProdutoAlter: imagemProdutoAlter,
                hiddendata: hiddendata,
            }, function(data, status) {
                $('#updateModal').modal('hide');
                displayData();
            });
        }
    </script>
</body>

</html>