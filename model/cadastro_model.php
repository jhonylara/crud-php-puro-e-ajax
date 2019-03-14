<?php
	class Cadastro_Model {
		
		function abrirConexao(){
			$conexao = new mysqli('lab17.dev.iesde.com.br', 'root', 'root', 'cadastro');
			if (mysqli_connect_errno())
			{
				return "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			return $conexao;
		}

		function retornarPessoas($dados){
			if($dados['pesquisa'] == '' ||$dados['pesquisa'] == null){
				$sql = 'SELECT * FROM Pessoa';
			}else{
				$sql = "SELECT * FROM Pessoa WHERE nome LIKE '%" . $dados['pesquisa'] . "%' OR sobrenome LIKE '%" . $dados['pesquisa'] . "%'";
			}
			
			$conexao = $this->abrirConexao();
			
			try{
				$retorno = mysqli_query($conexao, $sql);
				return $retorno;
			} catch (Exception $e) {
				return false;
			}	
		}
		
		function alterarPessoa($dados){
			$conexao = $this->abrirConexao();
			
			$sql = "UPDATE Pessoa SET ";
			$sql .= "nome = '" . $dados['nome'] . "', ";
			$sql .= "sobrenome = '" . $dados['sobrenome'] . "', ";
			$sql .= "email = '" . $dados['email'] . "', ";
			$sql .= "senha = '" . md5($dados['senha']) . "'";
			$sql .= "WHERE pessoa_id = " . $dados['pessoa_id'] . "";
			
			try{
				$retorno = mysqli_query($conexao, $sql);
				return $retorno;
			} catch (Exception $e) {
				return false;
			}	
		}
		
		function retornarPessoaPorId($id){
			$conexao = $this->abrirConexao();
			
			$sql = "SELECT * FROM Pessoa WHERE pessoa_id = '" . $id . "'";
			
			$retorno = mysqli_query($conexao, $sql);
			
			return $retorno;
		}
		
		
		function inserirPessoa($dados){
			
			$conexao = $this->abrirConexao();
			
			$sql = "INSERT INTO Pessoa (nome, sobrenome, email, senha) VALUES (";
			$sql .= "'" . $dados['nome'] . "', ";
			$sql .= "'" . $dados['sobrenome'] . "', ";
			$sql .= "'" . $dados['email'] . "', ";
			$sql .= "'" . md5($dados['senha']) . "')";
			
			try{
				$retorno = mysqli_query($conexao, $sql);
				return true;
			} catch (Exception $e) {
				return false;
			}		
		}
		
		function deletarPessoa($id){
			$conexao = $this->abrirConexao();
			
			$sql = "DELETE FROM Pessoa WHERE pessoa_id = " . $id;
			
			try{
				$retorno = mysqli_query($conexao, $sql);
				return true;
			} catch (Exception $e) {
				return false;
			}
		}
	
	}
?>
