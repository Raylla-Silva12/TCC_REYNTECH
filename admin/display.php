<!-- HEADER -->

<style>
  body {
    overflow-x: hidden !important;
  }
</style>

<?php
  session_start();
  include_once('../php/protect_admin.php');
  include_once('../php/conexao.php');
  include_once('../pags/header.php');


  if (isset($_POST['displaySend'])) {
      echo '
        <div class="container-xxl bg-light my-3 py-4 pt-0">
          <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
              <h1 class="display-6 mb-4">Produtos</h1>
            </div>
            <div class="row g-4">
      ';

      $sql = "SELECT * FROM tb_produto";
      $result = mysqli_query($mysqli, $sql);

      while ($row = mysqli_fetch_assoc($result)) {
          $cd_produto = $row['cd_produto'];
          $nm_produto = $row['nm_produto'];
          $vl_preco = $row['vl_preco'];
          $ds_produto = $row['ds_produto'];
          $qtd_produto = $row['qtd_produto'];
          $ft_produto_principal = $row['ft_produto_principal'];
          $id_categoria = $row['id_categoria'];

        echo '
                  <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                      <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                          <div class="p-4">
                              <h3 class="mb-4  text-center">'.$nm_produto.'</h3>
                              <p><b>Código:</b> '.$cd_produto.'</p>
                              <p><b>Preço:</b> R$ '.number_format("$vl_preco",2,",",".").'</p>
                              <p><b>Quantidade:</b> '.$qtd_produto.'</p>
                              <p><b>Descrição:</b> '.$ds_produto.'</p>';

                              $sql = "SELECT nm_categoria FROM tb_categoria WHERE cd_categoria=$id_categoria";
                              $res = mysqli_query($mysqli, $sql);
                              
                              while ($row = mysqli_fetch_assoc($res)) {
                                  $row['nm_categoria'];
                              
        echo '                <p><b>'.$row['nm_categoria'].'</b></p>';
                              }    
        echo '            </div>
                          <div class="position-relative mt-auto">
                              <img class="img-fluid" src="db_admin/'.$ft_produto_principal.'" alt="Imagem do Produto">
                              <div class="product-overlay">
                                <button class="btn btn-primary mx-3" onclick="GetDetails('.$cd_produto.')">Editar</button>
                                <button class="btn btn-dark" onclick="deleteProduto('.$cd_produto.')">Deletar</button>
                              </div>
                          </div>
                      </div>
                  </div>
              ';    
    }
        echo '    
              </div>
            </div>
          </div>';
  }
?>

</body>
</html>