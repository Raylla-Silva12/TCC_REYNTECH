<?php
	session_start();
	include_once('conexao.php');

	if (!isset($_SESSION['user_adm']) && !isset($_SESSION['senha_adm'])) {
		header('Location: ../admin/login_admin.php');
	}
?>