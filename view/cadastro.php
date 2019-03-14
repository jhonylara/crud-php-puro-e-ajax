<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script>
			$( document ).ready(function() {
				$( "#cadastroPessoa" ).submit(function(event){
					event.preventDefault();
					var dados = $('#cadastroPessoa').serialize();
					$.ajax({
						url: '../controler/Cadastro.php',
						dataType: 'html',
						type: 'POST',
						data: dados,
						beforeSend: function() {
							//$('#btSubmit').attr('disabled','true');
						},
						success: function(retorno) {
							console.log(retorno);
							$('#status').html(retorno);
							//$('#btSubmit').attr('disabled','false');
						},
						error: function() {
							//alert('erro no ajax');
						}
					});
					  
				});	
			});
		</script>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light" style="border-bottom: 4px solid black">
			<a class="navbar-brand" href="#">PHP PURO</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="#">CADASTRO <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../view/listagem.php">LISTAGEM</a>
					</li>
				</ul>
			</div>
		</nav>
		<div style="margin: 30px">
			<div id="status"></div>
			<form id="cadastroPessoa" action="../controler/Cadastro.php" method="POST">
				<div class="form-group">
					<label for="nome">Nome</label>
					<input type="text" class="form-control" name="nome" id="nome" value="<?php if(isset($pessoa['nome'])){echo $pessoa['nome'];}?>">
				</div>
				
				<div class="form-group">
					<label for="nome">Sobrenome</label>
					<input type="text" class="form-control" name="sobrenome" id="sobrenome" value="<?php if(isset($pessoa['sobrenome'])){echo $pessoa['sobrenome'];}?>">
				</div>
				<div class="form-group">
					<label for="nome">Email</label>
					<input type="text" class="form-control" name="email" id="email" value="<?php if(isset($pessoa['email'])){echo $pessoa['email'];}?>">
				</div>
				<div class="form-group">
					<label for="nome">Senha</label>
					<input type="text" class="form-control" name="senha" id="senha" value="<?php if(isset($pessoa['senha'])){echo $pessoa['senha'];}?>">
				</div>
				<div class="form-group">
					<label for="nome">Confirmar Senha</label>
					<input type="text" class="form-control" name="confirmar" id="confirmar" value="<?php if(isset($pessoa['senha'])){echo $pessoa['senha'];}?>">
				</div>
				<div class="form-group">
					<?php 
						if(isset($pessoa)){
							?>
								<input type="hidden" value="editar" name="metodo">
								<input type="hidden" value="<?php if(isset($pessoa['pessoa_id'])){echo $pessoa['pessoa_id'];}?>" name="pessoa_id">
							<?php
						}else{
							?>
								<input type="hidden" value="inserir" name="metodo">
							<?php
						}
					?>
					<button type="submit" id="btSubmit" class="btn btn-primary">Cadastrar</button>
				</div>		
			</form>
		</div>
	</body>
</html>