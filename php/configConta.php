<?php
    session_start();
    include_once("conexao.php"); 

    if (isset($_SESSION['email']) || isset($_POST['alterEmail']) || isset($_POST['addEmail']) || isset($_POST['atualSenha']) || isset($_POST['novaSenha']) || isset($_POST['confirmSenha'])) {

        // $sessaoEmail = $_SESSION['email'];
        $alterEmail = $_POST['alterEmail'];
        $addEmail = $_POST['addEmail'];
        $atualSenha = $_POST['atualSenha'];
        $novaSenha = $_POST['novaSenha'];
        $confirmSenha = $_POST['confirmSenha'];

        $sql = "UPDATE tb_usuario SET ds_email='$alterEmail', ds_email_recuperacao='$addEmail', ds_senha='$confirmSenha' WHERE cd_usuario=1";
        $result = mysqli_query($mysqli, $sql); 

        $mensagem = '<script>alert("Dados atualizados com sucesso!");</script>';
       
    }

    header("Location: ../pags/conta.php");
?>

