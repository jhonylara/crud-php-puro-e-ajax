<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST') { 
		$listagem = new Listagem;
		$listagem->buscar($_POST);
	}

	class Listagem{
		
		function __construct(){
			require_once '../model/cadastro_model.php';
		}
		
		function buscar($dados = null){
			

			$model = new Cadastro_Model();
			$pessoas = $model->retornarPessoas($dados);
			
			$retorno = '<table class="table">';
			while ($pessoa = $pessoas->fetch_assoc()) {
				$retorno .= '<tr>';
				$retorno .= '<td>'. $pessoa["nome"] . '</td>';
				$retorno .= '<td>'. $pessoa["sobrenome"] . '</td>';
				$retorno .= '<td>'. $pessoa["email"] . '</td>';
				$retorno .= '<td>'. $pessoa["senha"] . '</td>';
				$retorno .= '<td style="width: 40px"><form action="../controler/Cadastro.php" method="post"><input type="hidden" name="id" value="'. $pessoa["pessoa_id"] .'" /><input class="btn btn-primary	" type="submit" name="metodo" value="editar" /></form></td>';
				$retorno .= '<td style="width: 40px"><form action="../controler/Cadastro.php" method="post"><input type="hidden" name="pessoa_id" value="'. $pessoa["pessoa_id"] .'" /><input class="btn btn-danger	" type="submit" name="metodo" value="deletar" /></form></td>';
				$retorno .= '</tr>';
			}
			$retorno .= '</table>';


			die($retorno);
		}
	}
?>