<?php

	//Se ele receber um post e o metodo do campo hidden for inserir-editar-deletar ele direciona para a função
	if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['metodo'] == 'inserir') {
		$cadastro = new Cadastro;
		$cadastro->inserir($_POST);
	}else if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['metodo'] == 'editar'){
		$cadastro = new Cadastro;
		$cadastro->editar($_POST);
	}else{
		$cadastro = new Cadastro;
		$cadastro->deletar($_POST);
	}
	
	//Cria uma classe de Cadastro para poder dar new
	class Cadastro{
		
		//Construtor para carregar o model.
		function __construct(){
			require_once '../model/cadastro_model.php';
		}
		
		function inserir($dados){		
		
			$validacao = $this->validarCampos($dados);
			if($validacao == false){
				try{
					$model = new Cadastro_Model();
					$model->inserirPessoa($dados);
					die('<div class="alert alert-success">Inserido com sucesso</div>');
				} catch (Exception $e) {
					echo 'Exceção capturada: ',  $e->getMessage(), "\n";
				}					
			}else{
				die($validacao);
			}
		}	
		
		function editar($dados){
			if(isset($dados['pessoa_id'])){
				$validacao = $this->validarCampos($dados);

				if($validacao == false){
					try{
						$model = new Cadastro_Model();
						$model->alterarPessoa($dados);
						die('<div class="alert alert-success">Alterado com sucesso</div>');
					} catch (Exception $e) {
						echo 'Exceção capturada: ',  $e->getMessage(), "\n";
					}					
				}else{
					die($validacao);
				}
			}else{
				$model = new Cadastro_Model();
				$pessoa = $model->retornarPessoaPorId($dados['id']);
				
				$pessoa = $pessoa->fetch_assoc();
				
				include '../view/cadastro.php';
			}
		}
		
		function deletar($id){	
			try{
				$model = new Cadastro_Model();
				$model->deletarPessoa($id['pessoa_id']);
				?>
					<div class="alert alert-success">Deletado com sucesso</div>
				<?php
				include '../view/cadastro.php';
			} catch (Exception $e) {
				echo 'Exceção capturada: ',  $e->getMessage(), "\n";
			}	
		}

		
		function validarCampos($dados){
			$erro = null;
			
			if($dados['nome'] == '' || $dados['nome'] == null){
				$erro .= 'Campo nome e obrigatorio <br/>';
			}
			if($dados['sobrenome'] == '' || $dados['sobrenome'] == null){
				$erro .= 'Campo sobrenome e obrigatorio <br/>';
			}
			if(!preg_match('/^[a-z0-9.]+@[a-z0-9]+\.[a-z]+\.([a-z]+)?$/i', $dados['email']) || $dados['email'] == '' || $dados['email'] == null){
				$erro .= 'Campo email está errado <br/>';
			}
			if($dados['senha'] == '' || $dados['sobrenome'] == null){
				$erro .= 'Campo senha e obrigatorio <br/>';
			}
			if($dados['senha'] != $dados['confirmar']){
				$erro .= 'As senhas não conferem <br/>';
			}
			
			if($erro != null){
				return '<div class="alert alert-danger" role="alert">' . $erro . '</div>';
			}else{
				return false;
			}
		}
	}

	
	




	
?>