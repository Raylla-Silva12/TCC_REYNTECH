<?php
$usuario = 'root';
$senha = 'usbw';
$database = 'db_msgarden';
$host = 'localhost';

$mysqli = new mysqli($host, $usuario, $senha, $database);

if($mysqli->error) {
    die("Falha ao conectar ao banco de dados: " . $mysqli->error);
}


//FUNÇÃO DE ADM
function LoginAdmin($user_adm, $senha_adm){
	$sql = 'SELECT * FROM tb_admin WHERE nm_admin ="' . $user_adm . '"';
	$sql .= ' AND ds_senha ="' . $senha_adm . '"';
	$res = $GLOBALS['mysqli']->query($sql);

    if ($res->num_rows > 0) { //ENCONTROU O USUÁRIO
		$usuario = $res->fetch_array(); //array com os dados
		//armazenando dados da sessão
		$_SESSION['user_adm'] = $usuario['nm_admin'];
		$_SESSION['senha_adm'] = $usuario['ds_senha'];
        header('Location: ../admin/admin.php');
    } else {
        ?>
        <script>
            alert("Usuário invalido.");
        </script>
        <?php
    }
}
//FIM DA FUNÇÃO DE ADM



//FUNÇÃO DE LEMBRAR LOGIN
function LembrarLogin($email, $senha){
	$cookie_email = $_POST['email'];
	$cookie_senha = $_POST['senha'];
	$checkbox = 'checked'; 

	setcookie('cookie_email', $cookie_email, time() + 3600);
	setcookie('cookie_senha', $cookie_senha, time() + 3600);
	setcookie('checkbox', $checkbox, time() + 3600);

}
function NLembrarLogin(){
	setcookie('cookie_email','""', time() + 3600);
	setcookie('cookie_senha','""', time() + 3600);
	setcookie('checkbox','""', time() + 3600);
}
//FIM DA FUNÇÃO DE LEMBRAR LOGIN



// FUNÇÃO DE LOGIN
function Login($email, $senha) {
    
	$sql = 'SELECT * FROM tb_usuario WHERE ds_email="' . $email . '"';
	$sql .= ' AND ds_senha ="' . $senha . '"';
	$res = $GLOBALS['mysqli']->query($sql);

    if ($res->num_rows > 0) { //ENCONTROU O USUÁRIO
		$usuario = $res->fetch_array(); //array com os dados
		//armazenando dados da sessão
		$_SESSION['email'] = $usuario['ds_email'];
		$_SESSION['senha'] = $usuario['ds_senha'];

        header('Location: ../index.php');
    } else {
        ?>
        <script>
            alert("Usuário invalido.");
        </script>
        <?php
    }
}
// FIM DA FUNÇÃO DE LOGIN



// FUNÇÃO DE CADASTRAR
function Cadastrar($nome, $email, $senha, $celular) {
	$img = 1;

	$sql = 'INSERT INTO tb_usuario (cd_usuario, nm_usuario, dt_ingresso, ds_email, ds_email_recuperacao, ds_senha, nr_celular, id_imagem_usuario) 
	VALUES (null, "'. $nome .'", NOW(), "' . $email . '", null , "' . $senha . '", "' . $celular . '", "' . $img . '");';
	$res = $GLOBALS['mysqli']->query($sql);

    if ($res) {
		//Cadastrado
		$email = $_SESSION['email'];
		$nome = $_SESSION['nome'];
		header('Location: ../php/sendEmail.php');
	} else {
		echo "error";
		//erro ao cadastrar
	}
}
// FIM FUNÇÃO DE CADASTRAR




