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

<body>

<style>
  body {
      overflow-x: hidden !important;
  }
</style>

    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid top-bar bg-dark text-light px-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="row gx-0 align-items-center d-none d-lg-flex">
            <div class="col-lg-6 px-5 text-start">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="small text-light" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="small text-light" href="#">Produtos</a></li>
                    <li class="breadcrumb-item"><a class="small text-light" href="#">Curiosidades</a></li>
                </ol>
            </div>
            <div class="col-lg-6 px-5 text-end">
                <div class="h-100 d-inline-flex align-items-center">
                    <a class="btn-lg-square text-primary border-end rounded-0" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn-lg-square text-primary border-end rounded-0" href=""><i class="fab fa-whatsapp"></i></a>
                    <a class="btn-lg-square text-primary pe-0" href=""><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <?php
        include("navbar.php");
    ?>
    <!-- Navbar End -->

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center pt-5 pb-3">
            <h1 class="display-4 text-white animated slideInDown mb-3">Produtos</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-primary" href="#">Páginas</a></li>
                    <li class="breadcrumb-item text-white" aria-current="page">Sobre</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <div class="container-xxl bg-light my-3 py-4 pt-0">
        <div class="container">
          <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="text-primary text-uppercase mb-2">// PRODUTOS</p>
                <h1 class="display-6 mb-4">Nossos Maravilhosos Produtos</h1>
            </div>
          
          
          <div class="row g-4">
              <?php
                session_start();
                include_once("../php/conexao.php");

                $sql = "SELECT * FROM tb_produto";
                $result = mysqli_query($mysqli, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                  echo '
                          <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s" data-bs-toggle="modal" data-bs-target="#ProdutoModal">
                            <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                              <div class="text-center p-4">';
                  echo '        <div class="d-inline-block border border-primary rounded-pill px-3 mb-3">R$ '.number_format($row['vl_preco'], 2, ',', '.').'</div>';
                  echo '          <h3 class="mb-3">'.$row['nm_produto'].'</h3>
                                  <span>Tempor erat elitr rebum at clita dolor diam ipsum sit diam amet diam et eos</span><br><br>';
                  echo '          
                                    <div class="text-center mb-4"><a class="btn btn-md btn-outline-light bg-primary p-2" href="carrinho.php?acao=add&id=' . $row['cd_produto'] . '">COMPRAR</a></div>';
                  echo '         
                                  <div class="position-relative mt-auto">
                                    <img class="img-fluid" src="../admin/db_admin/'.$row['ft_produto_principal'].'" alt="">
                                    <div class="product-overlay">
                                      <a class="btn btn-lg-square btn-outline-light rounded-circle" href=""><i class="fa fa-eye text-primary"></i></a>
                                    </div>
                                  </div>
                              </div>
                            </div>
                          </div>
                          

                          <!-- Modal -->
                          <div class="modal fade" id="ProdutoModal" tabindex="-1" aria-labelledby="ProdutoModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="ProdutoModalLabel">'.$row['nm_produto'].'</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                  <div class="row">
                                    <div class="col-lg-6">
                                      <img class="img-fluid border border-2 border-primary p-2 mb-2 rounded" src="../admin/db_admin/'.$row['ft_produto_principal'].'" alt="">
                                    </div>
                                    
                                    <div class="col-lg-6 ms-auto">
                                      <h2>R$ '.number_format($row['vl_preco'], 2, ',', '.').'</h2>
                                      <h6>Descrição do Produto</h6>
                                      <p>'.$row['ds_produto'].'</p>
                                      <h6>Estoque</h6>
                                      <p>'.$row['qtd_produto'].'</p>
                                      <p><a href="curiosidades.php">Curiosidades</a></p>
                                    </div>
                                  </div>

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                  <button type="button" class="btn btn-primary"><a class="text-white" href="carrinho.php?acao=add&id=' . $row['cd_produto'] . '">Adicionar ao Carrinho</a></button>
                                </div>
                              </div>
                            </div>
                          </div>


                          ';
                }
              ?>
          </div>
        </div>
      </div>
  
  <?php include('footer2.php'); ?>

