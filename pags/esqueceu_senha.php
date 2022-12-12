<?php include('header.php'); ?>

<body>
	

	<div class="position-absolute top-50 start-50 translate-middle">
		<form method="post">
			<div class="card border-primary	text-center" style="width: 34rem;">
				<div class="card-header bg-light border-primary py-3 text-dark">Esqueceu sua senha?</div>
					<div class="card-body py-4">
						<h5 class="card-title">Recuperação de Senha</h5>
						<p class="card-text">Insira seu e-mail para maiores instruções.</p>
						<input class="form-control border-primary" type="email" name="email" id="email" placeholder="E-mail" required>
						<button class="btn btn-outline-primary mt-3" type="button" onclick="sendEmail()">Enviar</button>
					</div>
				</div>
			</div>
		</form>
	</div>
	 
	<script>
	function sendEmail() {
	var email = document.getElementById("email"). value;
	var mensagem = "http://localhost:81/REYNTECH/pags/troca_senha.php?h=";
	var cod = email;

		Email.send({
		Host : "smtp.elasticemail.com",
		Username : "raylla.l.silva@gmail.com",
		Password : "B1EA8D7A4303C4BE5D0D454BB6955285CE15",
		To : email,
		From : "raylla.l.silva@gmail.com",
		Subject : "REYNTECH",
		Body :"Clique aqui para alterar sua senha " + mensagem + cod
		}).then(
			message => alert("Verifique seu email --- Pode cair na caixa de spam")
		);
	}
	</script>    
</body>
</html>