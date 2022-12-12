<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <title>M&S Garden</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../lib/animate/animate.min.css" rel="stylesheet">
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
</head>

<?php
  session_start();
  include_once("../php/conexao.php");

  if (isset($_SESSION['email']) && isset($_SESSION['senha'])) {
    if (!isset($_SESSION['carrinho'])) {
      $_SESSION['carrinho'] = array();
    }

    //ADD PRODUTO

    if (isset($_GET['acao'])) {
        //ADD CARRINHO

        if ($_GET['acao'] == 'add') {
            $id = intval($_GET['id']);
            if (!isset($_SESSION['carrinho'][$id])) {
                $_SESSION['carrinho'][$id] = 1;
            } else {
                $_SESSION['carrinho'][$id] += 1;
            }
        }

        //REMOVER CARRINHO
        if ($_GET['acao'] == 'del') {
            $id = intval($_GET['id']);
            if (isset($_SESSION['carrinho'][$id])) {
                unset($_SESSION['carrinho'][$id]);
            }
        }

        //ALTERAR QUANTIDADE
        if ($_GET['acao'] == 'up') {
            if (is_array($_POST['prod'])) {
                foreach ($_POST['prod'] as $id => $qtd) {
                    $id = intval($id);
                    $qtd = intval($qtd);
                    if (!empty($qtd) || $qtd <> 0) {
                        $_SESSION['carrinho'][$id] = $qtd;
                    } else {
                        unset($_SESSION['carrinho'][$id]);
                    }
                }
            }
        }
    }
  } else {
    header("Location: login.php");
  } 
?>

<body>

<div class="container px-3 my-5 clearfix">
    <!-- Shopping cart table -->
    <div class="card">
        <div class="card-header">
            <h2>Carrinho</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered m-0">
                <thead>
                  <tr>
                    <!-- Set columns width -->
                    <th class="text-center py-3 px-4" style="min-width: 400px;">Produtos</th>
                    <th class="text-right py-3 px-4" style="width: 100px;">Preço</th>
                    <th class="text-center py-3 px-4" style="width: 120px;">Quantidade</th>
                    <th class="text-right py-3 px-4" style="width: 100px;">Total</th>
                    <th class="text-center align-middle py-3 px-0" style="width: 40px;"><a href="#" class="shop-tooltip float-none text-light" title="" data-original-title="Clear cart"><i class="ino ion-md-trash"></i></a></th>
                  </tr>
                </thead>
                    
                <form action="?acao=up" id="form" method="POST">
             <tbody>
          <?php
                if (count($_SESSION['carrinho']) == 0) {
                    echo '<tr><td colspan="5"> Não há produto no carrinho </td></tr>';
                } else {
                    foreach ($_SESSION['carrinho'] as $id => $qtd) {
                        $sql = "SELECT * FROM tb_produto WHERE cd_produto= '$id'";
                        $result = mysqli_query($mysqli, $sql);

                        $row = mysqli_fetch_assoc($result);
                        $img = $row['ft_produto_principal'];
                        $nome = $row['nm_produto'];
                        $valor = number_format($row['vl_preco'], 2, ',', '.');
                        $sub = number_format($row['vl_preco'] * $qtd, 2, ',', '.');
                        $total += $sub;

                        echo'

                  <tr>
                    <td class="p-4">
                      <div class="media align-items-center">
                      <img class="d-block ui-w-40 ui-bordered mr-4" src="../admin/db_admin/'.$row['ft_produto_principal'].'" alt="">
                        <div class="media-body">
                          <a href="#" class="d-block text-dark">' . $nome . '</a>
                        </div>
                      </div>
                    </td>
                    <td class="text-right font-weight-semibold align-middle p-4">$' . $valor . '</td>
                    <td class="align-middle p-4"><input type="number" onchange="alterar()" id="qtd" name="prod[' . $id . ']" value="' . $qtd . '"> </td>
                    <td class="text-right font-weight-semibold align-middle p-4">$' . $sub . '</td>
                    <td class="text-center align-middle px-0"> <a href="?acao=del&id=' . $row['cd_produto'] . '"> <i class="bi bi-trash text-muted"> </i> <a/> </td>
                  </tr>
                  ';
                    }
                } 
              $total = number_format($total, 2, ',', '.');
                echo '

                </tbody>
              </table>
            </div>
        
            <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
              <div class="d-flex">
                <div class="text-right mt-4">
                  <label class="text-muted font-weight-normal m-0">Preço Total</label>
                  <div class="text-large"><strong> $' . $total . ' </strong></div>
                </div>
              </div>
            </div>
        
            <div class="float-right">
              <button type="button"  onclick="voltar()" class="btn btn-lg btn-default md-btn-flat mt-2 mr-3">Voltar as compras</button>
              <button type="button"  onclick="comprar()" class="btn btn-lg btn-primary mt-2">Confirmar Compra</button>
            </div>
            ';
          ?>
          </div>
      </div>
  </div>



</body>

<script>
    function alterar() {
        document.getElementById("form").submit();
    }

    function comprar() {
        window.location.assign("../php/comprovante.php");
    }

    function voltar(){
        window.location.assign("pag_produtos.php");
    }
</script>

  <style>
    body{
    margin-top:20px;
    background:#eee;
}
.ui-w-40 {
    width: 40px !important;
    height: auto;
}

.card{
    box-shadow: 0 1px 15px 1px rgba(52,40,104,.08);    
}

.ui-product-color {
    display: inline-block;
    overflow: hidden;
    margin: .144em;
    width: .875rem;
    height: .875rem;
    border-radius: 10rem;
    -webkit-box-shadow: 0 0 0 1px rgba(0,0,0,0.15) inset;
    box-shadow: 0 0 0 1px rgba(0,0,0,0.15) inset;
    vertical-align: middle;
}
  </style>