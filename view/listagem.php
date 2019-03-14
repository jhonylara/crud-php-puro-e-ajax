<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script>
			$( document ).ready(function() {
				carregarTabela();
			});
			
			function carregarTabela(){
				var pesquisa = $('#campoPesquisa').val();
				$.ajax({
					url: '../controler/Listagem.php',
					dataType: 'html',
					type: 'POST',
					data: {pesquisa: pesquisa},
					beforeSend: function() {
						//$('#btSubmit').attr('disabled','true');
					},
					success: function(retorno) {
						$('#resultado').html(retorno);
						//$('#btSubmit').attr('disabled','false');
					},
					error: function() {
						//alert('erro no ajax');
					}
				});	 
			}
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
					<li class="nav-item">
						<a class="nav-link" href="../view/cadastro.php">CADASTRO </a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="#">LISTAGEM <span class="sr-only">(current)</span></a>
					</li>
				</ul>
				<div class="form-inline my-2 my-lg-0">
					<input class="form-control mr-sm-2" type="search" id="campoPesquisa" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success my-2 my-sm-0" onclick="carregarTabela()">Search</button>
				</div>
			</div>
		</nav>
		<div style="margin: 30px">
			<div id="resultado">
			</div>
		</div>



	</body>
</html>