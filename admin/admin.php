<?php

session_start();
include_once("../php/conexao.php");
?>

<body>
    <link rel="stylesheet" href="css/estilo_adm.css">
    <a href="../index.php">Voltar</a>

    <h3 class='my-3 mx-3'>Produtos</h3>

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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <a class="btn btn-dark mb-3 mx-3" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Adicionar Produto</a>
    <!-- Fim do Modal de Cadastro -->




    <!-- Modal de Edição -->
    <div class="modal fade" id="updateModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">Modal 1</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nomeProduto">Nome do Produto</label>
                        <input type="text" class="form-control" id="nomeProdutoAlter" placeholder="Nome do Produto">
                    </div>
                    <div class="form-group">
                        <label for="valorProduto">Valor</label>
                        <input type="number" class="form-control" id="valorProdutoAlter" placeholder="Valor">
                    </div>
                    <div class="form-group">
                        <label for="descricaoProduto">Descrição</label>
                        <input type="text" class="form-control" id="descricaoProdutoAlter" placeholder="Descrição">
                    </div>
                    <div class="form-group">
                        <label for="qtdProduto">Quantidade</label>
                        <input type="text" class="form-control" id="qtdProdutoAlter" placeholder="Quantidade">
                    </div>
                    <div class="form-group">
                        <label for="categoriaProduto">Categoria</label>
                        <input type="number" class="form-control" id="categoriaProdutoAlter" placeholder="Categoria">
                    </div>
                    <div class="form-group">
                        <script>
                            $(document).ready(function() {
                                $("#imagemProdutoAlter").change(function() {
                                    var nomeImgAlter = $('#imagemProdutoAlter').val();
                                    $("#status-input-alter").val("Arquivo selecionado: " + nomeImgAlter);
                                });
                            });
                        </script>

                        <div class="input-group mb-3">
                            <input type="file" class="form-control" id="imagemProdutoAlter" name="imagemProdutoAlter">
                            <label for="file" class="label-file rounded-start">Selecione uma Imagem</label>
                            <input type="text" class="form-control input-file" id="status-input-alter" value="Arquivo não selecionado" disabled>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" onclick="updateDetails()">Alterar</button>
                    <input type="hidden" id="hiddendata">
                </div>
            </div>
        </div>
    </div>
    <!-- Fim do Modal de Edição -->


    <div id="displayAdmin"></div>


    <?php include('../pags/footer.php'); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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