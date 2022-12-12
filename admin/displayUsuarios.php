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


  if (isset($_POST['displayUsuarioSend'])) {
      echo '
        <div class="container-xxl bg-light my-3 py-4 pt-0">
          <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
              <h1 class="display-6 mb-4">Usuários</h1>
            </div>
            <div class="row g-4">
      ';

      $sql = "SELECT * FROM tb_usuario";
      $result = mysqli_query($mysqli, $sql);

      while ($row = mysqli_fetch_assoc($result)) {
          $cd_usuario = $row['cd_usuario'];
          $nm_usuario = $row['nm_usuario'];
          $dt_ingresso = $row['dt_ingresso'];
          $ds_email = $row['ds_email'];
          $nr_celular = $row['nr_celular'];

          // Formatando a data
          $data = implode("/",array_reverse(explode("-",$dt_ingresso)));

        
        echo '
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                            <div class="p-4">
                                <h3 class="mb-4  text-center">'.$nm_usuario.'</h3>
                                <p><b>Código:</b> '.$cd_usuario.'</p>
                                <p><b>Data de ingresso:</b> '.$data.'</p>
                                <p><b>E-mail:</b> '.$ds_email.'</p>
                                <p><b>Celular:</b> '.$nr_celular.'</p>
                            </div>
                            <div class="position-relative mt-auto">
                                <img class="img-fluid" src="../assets/user.png" alt="Imagem do Produto">
                                <div class="product-overlay">
                                  <button class="btn btn-dark" onclick="deleteProduto('.$cd_usuario.')">Deletar</button>
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