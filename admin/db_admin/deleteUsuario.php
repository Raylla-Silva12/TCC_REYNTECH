<?php
    include '../../php/conexao.php';

    if (isset($_POST['deletesend'])) {
        $unique = $_POST['deletesend'];

        $sql = "DELETE FROM tb_usuario WHERE cd_usuario=$unique";
        $result = mysqli_query($mysqli, $sql);
    }
?>