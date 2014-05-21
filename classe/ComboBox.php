<?php
include_once("MySqlConn.php");

class ComboBox extends MySqlConn{
/************************************************************
** gera combobox da tela de cadastro e alteração do menu
*************************************************************/
	private $estado;
		
	public function setPaisId($id){
		$this->paisId = $id;
	}
	
	public function setEstadoId($id){
		$this->estadoId = $id;
	}
	
	public function setIdServico($id){
		$this->idServico = $id;
	}
	
	public function setIdCategoria($id){
		$this->idCategoria = $id;
	}
	
	public function setIdServicoSubCategoria($id){
		$this->idServicoSubCategoria = $id;
	}
	
	public function servicoSubCategoria(){
		$sql = "SELECT id, nome 
				FROM servico_subcategoria 
				ORDER BY id ";
	    $qr = self::execSQL($sql);
		
		while($dados = self::listQr($qr)){
			if($this->idServicoSubCategoria == $dados["id"]){
				$select = 'selected="selected"';
			}else{
				$select = '';
			}
			echo '<option value="'.$dados["id"].'" '.$select.'>'.$dados["nome"].'</option>'."\n";
		}
	}
	
	public function outorgaSite($id){
		$sql = "SELECT id, nome 
				FROM outorga 
				WHERE status = 'A'
				ORDER BY id ";
	    $qr = self::execSQL($sql);
		
		while($dados = self::listQr($qr)){
			if($id == $dados["id"]){
				$select = 'selected="selected"';
			}else{
				$select = '';
			}
			echo '<option value="'.$dados["id"].'" '.$select.'>'.$dados["nome"].'</option>'."\n";
		}
	}
	
	public function outorga($id){
		$sql = "SELECT id, nome, status
				FROM outorga 
				ORDER BY id ";
	    $qr = self::execSQL($sql);
		
		while($dados = self::listQr($qr)){
			if($id == $dados["id"]){
				$select = 'selected="selected"';
			}else{
				$select = '';
			}
			echo '<option value="'.$dados["id"].'" '.$select.'>'.$dados["nome"].' - '.$dados["status"].'</option>'."\n";
		}
	}
	
	public function pais($id){
		$sql = "SELECT id, nome 
				FROM pais 
				ORDER BY nome ";
	    $qr = self::execSQL($sql);
		
		while($dados = self::listQr($qr)){
			if($id == $dados["id"]){
				$select = 'selected="selected"';
			}else{
				$select = '';
			}
			echo '<option value="'.$dados["id"].'" '.$select.'>'.$dados["nome"].'</option>'."\n";
		}
	}
	
	public function status($id){
		$sql = "SELECT id, nome 
				FROM status 
				ORDER BY id ";
	    $qr = self::execSQL($sql);
		
		while($dados = self::listQr($qr)){
			if($id == $dados["id"]){
				$select = 'selected="selected"';
			}else{
				$select = '';
			}
			echo '<option value="'.$dados["id"].'" '.$select.'>'.$dados["nome"].'</option>'."\n";
		}
	}
	
	public function estados(){
		$sql = "SELECT id, nome 
				FROM estados 
				WHERE paises_id = $this->paisId
				ORDER BY nome ";
	    $qr = self::execSQL($sql);
		//echo'<option value="">Selecione...</option>';
		while($dados = self::listQr($qr)){
			if($this->estadoId == $dados["id"]){
				$select = 'selected="selected"';
			}else{
				$select = '';
			}
			echo '<option value="'.$dados["id"].'" '.$select.'>'.$dados["nome"].'</option>'."\n";
		}
	}
	
	public function servicos($id){
		$sql = "SELECT id, nome 
				FROM servico 
				WHERE audio = 'COM'
				ORDER BY id ";
	    $qr = self::execSQL($sql);
		
		while($dados = self::listQr($qr)){
			if($id == $dados["id"]){
				$select = 'selected="selected"';
			}else{
				$select = '';
			}
			echo '<option value="'.$dados["id"].'" '.$select.'>'.$dados["nome"].'</option>'."\n";
		}
	}
	
	public function categoriaServico(){
		$sql = "
				SELECT c.id, c.nome
				FROM servico_categoria AS sc
				INNER JOIN categoria_servico AS c ON c.id = sc.categoria_servico_id
				WHERE sc.servico_id = $this->idServico
				ORDER BY c.nome
			   ";
	    $qr = self::execSQL($sql);
		echo'<option value="">Selecione...</option>';
		while($dados = self::listQr($qr)){
			if($this->idCategoria == $dados["id"]){
				$select = 'selected="selected"';
			}else{
				$select = '';
			}
			echo '<option value="'.$dados["id"].'" '.$select.'>'.$dados["nome"].'</option>'."\n";
		}
	}
}
//----------------------------------------------------------------------------------------------------
if($_POST['acao']=="montaEstados"){
	$estados = new ComboBox();
	$estados->setPaisId($_POST['id']);
	$estados->setEstadoId($_POST['estadoId']);
	$estados->estados();

}

if($_POST['acao']=="montaCategoriaServico"){
	$categoria = new ComboBox();
	$categoria->setIdServico($_POST['id']);
	$categoria->setIdCategoria($_POST['idCategoria']);
	$categoria->categoriaServico();

}

?>