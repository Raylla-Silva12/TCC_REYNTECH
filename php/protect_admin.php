<?php
session_start();
include_once('conexao.php');

if ((!isset($_SESSION['user_adm']) == true) and (!isset($_SESSION['senha_adm']) == true)) {
	unset($_SESSION['user_adm']);
	unset($_SESSION['senha_adm']);
	header('Location: ../admin/login_admin.php');
}
?>