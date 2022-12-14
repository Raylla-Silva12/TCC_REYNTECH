<?php include('header.php'); ?>

<body class="fundo-login-cad">

	<div class="container">
		<div class="row">

			<?php
                session_start();
                include_once("../php/conexao.php");
                if (isset($_POST['email'])) {
	                Login($_POST['email'], $_POST['senha']);
                }
                if (isset($_POST['cc'])) {
	                LembrarLogin($_POST['email'], $_POST['senha']);
                } else {
	                NLembrarLogin();
                }
            ?>

			<section>
				<div class="container mt-5 pt-5">
					<div class="row">
						<div class="col-12 col-sm-12 col-md-8 col-lg-6 m-auto">
							<div class="card border-0">
								<div class="card-body shadow-lg">
									<a href="../index.php"><button type="button" class="btn-close"
											aria-label="Close"></button></a>
									<img class="rounded mx-auto d-block" src="../assets/cactu.gif" alt="Logo"
										height="120px" width="150px">
									<form method="POST">
										<div class="form-group">
											<input type="text" class="form-control my-3 py-2 input-bloco" name="email"
												value="<?php echo $_COOKIE['cookie_email']; ?>" placeholder="Usuário"
												required autofocus />
										</div>
										<div class="form-group">
											<input type="password" class="form-control my-3 py-2 input-bloco"
												name="senha" value="<?php echo $_COOKIE['cookie_senha']; ?>"
												placeholder="Senha" required autofocus />
										</div>
										<div>

											<input id="check" type="checkbox" name="cc" id="c1" value="on" <?php echo
												$_COOKIE['checkbox']; ?>>
											<small class="text-black"> Lembrar</small>

											<div class="row">
												<a href="esqueceu_senha.php">Esqueceu a senha?</a>
											</div>
											<div class="row">
												<a href="cadastrar.php"> Não é cadastrado? Cadastre-se aqui! </a>
											</div>
										</div>
										<div class="text-center mt-3">
											<button type="submit" class="btn btn-outline-success px-5 input-focus-color-success">Entrar</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

		</div>
	</div>


</body>

</html>