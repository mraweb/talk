<?php 
if($url[0]=="admin"){
	include_once("../classe/MySqlConn.php");
	include_once("../classe/ManipulateData.php");
	include_once("../classe/CriaPaginacao.php");
}else{
	include_once("MySqlConn.php");
	include_once("ManipulateData.php");
	include_once("CriaPaginacao.php");
}

class Entrevista extends CriaPaginacao{

	private $strCampoPesquisa, $strNumPagina, $strPaginas, $strUrl, $idPesquisa, $ordenacao, $coluna;
	
	public function setNumPagina($x){
		$this->strNumPagina = $x;
	}

	public function setUrl($x){
		$this->strUrl = $x;
	}
	
	public function setIdPesquisa($id){
		$this->idPesquisa = $id;
	}
	
	public function setOrdenacao($var){
		$this->ordenacao = $var;
	}
		
	public function setColuna($var){
		$this->coluna = $var;
	}

	public function setCampoPesquisa($x){
		$this->strCampoPesquisa = $x;
	}

	public function setId($id){
		$this->id = $id;
	}
	
	public function setIdImagem($id){
		$this->idImagem = $id;
	}
	
	public function setNomeArquivo($x){
		$this->nomeArquivo = $x;
	}
	
	public function setBusca($x){
		$this->busca = $x;
	}
	


	//------------------------------------------------------------------------------------------------------
	public function getPaginas(){
		return $this->strNumPagina = $x;
	}

	public function getId(){ 
		return $this->id;
	}

	public function getTitulo(){ 
		return $this->titulo;
	}	

	public function getChamada(){ 
		return $this->chamada;
	}

	public function getDescricao(){ 
		return $this->descricao;
	}
	
	public function getDescricaoSite(){ 
		return $this->descricaoSite;
	}
	
	public function getDataEvento(){ 
		return $this->dataEvento;
	}
	
	public function getDataEventoTexto(){ 
		return $this->dataEventoTexto;
	}
	
	public function getImagem(){ 
		return $this->imagem;
	}
	
	public function getVideo(){ 
		return $this->video;
	}
	
	public function getAudio(){ 
		return $this->audio;
	}

	//------------------------------------------------------------------------------------------------------

	public function geraLisEntrevista(){ 
	
		$sql = "
			SELECT id,titulo,dataEvento
			FROM entrevista
			WHERE dataExclusao IS NULL
		";
		if($this->strCampoPesquisa)
			$sql .= " AND titulo LIKE '%$this->strCampoPesquisa%'";
		else	
		 	$sql .= " ORDER BY dataEvento DESC";

		$this->setParametro($this->strNumPagina); //numero de pagina atual
		$this->setFileName($this->strUrl); // nome da pagina atual
		$this->setInfoMaxPag(20); // quantidade de produtos por tela
		$this->setMaximoLinks(10); //quantidade de links para a paginacao
		$this->setSQL($sql);
		self::iniciaPaginacao();
		$contador = 0; // contador para gerar o numero de paginas
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro
		if($qtRegistros > 0){
			while($dados = self::results()){
				$res = $contador % 2;
				$class = "";
				if($res==0){
					$class = 'class="cor"';
				}

				$dataEvento = converteData($dados["dataEvento"]);
				
				$contador ++;
				
				echo'
					<tr '.$class.'>
		            	<td>'.$dataEvento.'</td>
		                <td>'.$dados["titulo"].'</td>
		                <td class="tamanho1"><a href="?telas=nova-entrevista&idAlteracao='.$dados["id"].'&acao=alterar"><img src="img/bteditar.png" width="55" height="17" /></a></td>
		                <td class="tamanho1"><a href="javascript:void(0);" class="excluirRegistro" id="'.$dados["id"].'"><img src="img/btexcluir.png" width="55" height="17" /></a></td>
		            </tr>
				';
				self::setContador($contador);
			}
		}
	}


	public function geraDadosIdEntrevista(){
		$sql = "
			SELECT id,titulo,chamada,descricao,dataEvento,imagem,video,audio
			FROM entrevista
			WHERE dataExclusao IS NULL
			";

		if($this->id)
			$sql .= " AND id = ".$this->id;

		$qr = self::execSql($sql);
		$dados = self::listQr($qr);
		
		$descricaoSite = str_replace("%%video%%", $dados["video"], $dados["descricao"]);
		$descricaoSite = str_replace("%%audio%%", $dados["audio"], $descricaoSite);
		
		$this->dataEvento = converteData($dados["dataEvento"]);
		$data = explode("/", $this->dataEvento);		
		$dataEventoTexto = $data[0].' de '.retornoNomeMes($data[1]).' de '.$data[2];

		$this->id = $dados["id"];
		$this->titulo = $dados["titulo"];
		$this->chamada = $dados["chamada"];
		$this->descricao = $dados["descricao"];
		$this->descricaoSite = $descricaoSite;		
		$this->dataEventoTexto = $dataEventoTexto;
		$this->imagem = $dados["imagem"];
		$this->video = $dados["video"];
		$this->audio = $dados["audio"];
	}


	public function galeriaImagensEntrevista(){ 
	
		$sql = "	
			SELECT id, thumb, imagem
			FROM entrevista_imagem
			WHERE entrevista_id = $this->id
		";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro	 
		$i = 1;
		while($lista = self::resultsAll($this->qr)){

			if($lista['imagem']){
				$caminhoImagemCheck = 'upload/imagem/'.$lista['imagem'];

				//if(file_exists($caminhoImagemCheck)){
				  $caminhoImagem = URL.'upload/imagem/'.$lista['imagem'];
				  $caminhoImagemThumb = URL.'upload/thumb/'.$lista['thumb'];

				  echo'
				  	<li><a title="Foto" href="'.$caminhoImagem.'"><img alt="Foto" src="'.$caminhoImagemThumb.'" width="118" height="95"></a></li>
				  ';
				//}
			}
			
		$i++;
		}
	}
	
	public function geraImagensEntrevista(){ 
	
		$sql = "	
			SELECT i.id, i.thumb, i.imagem
			FROM entrevista_imagem AS i
			WHERE i.entrevista_id = $this->id
		";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro	 
		$i = 1;
		while($lista = self::resultsAll($this->qr)){

			if($lista['imagem']){
				$caminhoImagemCheck = URL.'upload/imagem/'.$lista['imagem'];

				//if(file_exists($caminhoImagemCheck)){
				  $caminhoImagem = URL.'upload/imagem/'.$lista['imagem'];
				  $caminhoImagemThumb = URL.'upload/thumb/'.$lista['thumb'];

				  echo'
				  	<li id="li_'.$lista['id'].'"><img src="'.$caminhoImagemThumb.'" width="55" height="50" /><a href="javascript:void(0);" id="'.$lista['id'].'" class="excluirImagemGaleria"><img src="img/btexcluir.png" width="55" height="17" ></a></li>
				  ';
				//}
			}
			
		$i++;
		}
	}
	
	public function getEntrevista(){ 
	
		$sql = "
			SELECT id,titulo,descricao,dataEvento,imagem,chamada
			FROM entrevista
			WHERE dataExclusao IS NULL
		";
		if($this->busca)
			$sql .= " AND titulo like '%$this->busca%'";
		
		$sql .=" ORDER BY dataEvento DESC, id DESC ";

		$this->setParametro($this->strNumPagina); //numero de pagina atual
		$this->setFileName($this->strUrl); // nome da pagina atual
		$this->setInfoMaxPag(4); // quantidade de produtos por tela
		$this->setMaximoLinks(10); //quantidade de links para a paginacao
		$this->setSQL($sql);
		self::iniciaPaginacao();
		$contador = 0; // contador para gerar o numero de paginas
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro
		if($qtRegistros > 0){
			while($lista = self::results()){
				$contador ++;

				$data = explode("/", converteData($lista["dataEvento"]));		
				$dataEventoTexto = $data[0].' de '.retornoNomeMes($data[1]).' de '.$data[2];

				$link = URL.'talkradioshow/entrevista/'.criarSlug($lista['titulo']);
				$caminhoImagem = URL.'upload/img_large/'.$lista['imagem'];
				$sizeImagem = explode("|", SizeImage($caminhoImagem));
				
				echo'
					<article>
		                <h2><a href="'.$link.'" title="'.$lista['titulo'].'">'.$lista['titulo'].'</a></h2>
		
		                <p class="data-post">'.$dataEventoTexto.' | <a href="<?php echo $host; ?>" class="link">Ver comentários</a></p>
		
		                <img src="'.$caminhoImagem.'" alt="'.$lista['titulo'].'" width="'.$sizeImagem[0].'" height="'.$sizeImagem[1].'" class="img-left" />
		
		                <p>'.$lista['chamada'].'</p>
		
		                <p class="bt-leia">Leia Mais &raquo;</p>
		            </article>
				';
				self::setContador($contador);
			}
		}
	}
	
	public function colunaUltimasEntrevistas(){ 
	
		$sql = "	
			SELECT id,titulo,imagem
			FROM entrevista
			ORDER BY dataEvento DESC, id DESC 
			LIMIT 6
		";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro	 
		$i = 1;
		while($lista = self::resultsAll($this->qr)){

			if($lista['imagem']){
				$caminhoImagemCheck = 'upload/img_small/'.$lista['imagem'];
				$link = URL.'talkradioshow/entrevista/'.criarSlug($lista['titulo']);

				if(file_exists($caminhoImagemCheck)){
				  $caminhoImagem = URL.'upload/img_small/'.$lista['imagem'];
				  $sizeImagem = explode("|", SizeImage($caminhoImagem));

				  echo'
				  	<li>
						<h4>
							<a title="'.$lista['titulo'].'" href="'.$link.'">'.$lista['titulo'].'</a>
						</h4>
						<img width="'.$sizeImagem[0].'" height="'.$sizeImagem[1].'" alt="'.$lista['titulo'].'" src="'.$caminhoImagem.'">
					</li>
				  ';
				}
			}
			
		$i++;
		}
	}
	
	public function slideUltimasEntrevistas(){ 
	
		$sql = "	
			SELECT id,titulo,imagem,chamada
			FROM entrevista
			ORDER BY dataEvento DESC, id DESC 
			LIMIT 4
		";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro	 
		$i = 1;
		while($lista = self::resultsAll($this->qr)){

			if($lista['imagem']){
				$caminhoImagemCheck = 'upload/img_full/'.$lista['imagem'];
				$link = URL.'talkradioshow/entrevista/'.criarSlug($lista['titulo']);

				//if(file_exists($caminhoImagemCheck)){

				  $caminhoImagem = URL.'upload/img_full/'.$lista['imagem'];
				  $sizeImagem = explode("|", SizeImage($caminhoImagem));

				  echo'
				  	<div class="slides">
	                    <img src="'.$caminhoImagem.'" alt="'.$lista['titulo'].'" width="'.$sizeImagem[0].'" height="'.$sizeImagem[1].'" />
	
	                    <section>
	                        <h2><a href="'.$link.'" title="'.$lista['titulo'].'">'.$lista['titulo'].'</a></h2>
	
	                        <p class="box-white">'.$lista['chamada'].'</p>
	
	                        <p class="bt-ver">ver mais &raquo;</p>
	                    </section>
                	</div>
				  ';
				//}
			}
			
		$i++;
		}
	}
	
	public function homeUltimasEntrevistas(){ 
	
		$sql = "	
			SELECT id,titulo,imagem,descricao,chamada
			FROM entrevista
			ORDER BY dataEvento DESC, id DESC 
			LIMIT 4
		";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro	 
		$i = 1;
		while($lista = self::resultsAll($this->qr)){

			if($lista['imagem']){
				$caminhoImagemCheck = 'upload/img_full/'.$lista['imagem'];
				$link = URL.'talkradioshow/entrevista/'.criarSlug($lista['titulo']);

				//if(file_exists($caminhoImagemCheck)){

				  $caminhoImagem = URL.'upload/img_medium/'.$lista['imagem'];
				  $sizeImagem = explode("|", SizeImage($caminhoImagem));

				  echo'
				  	<li>
	                    <img src="'.$caminhoImagem.'" alt="Radio brodcast" width="'.$sizeImagem[0].'" height="'.$sizeImagem[1].'" />
	
	                    <h3><a href="'.$link.'" title="'.$lista['titulo'].'">'.$lista['titulo'].'</a></h3>
	
	                    <p>'.$lista['chamada'].'</p>
	
	                    <p class="bt-veja">veja mais &raquo;</p>
                	</li>
				  ';
				//}
			}
			
		$i++;
		}
	}
	
	
	//exclui imagem temp
	public function excluirImagemTemp(){ 
		
		//deleta a imagem da pasta
		include_once("../funcoes/geral.php");
		deletaImagemTemp($this->nomeArquivo);//deleto arquivo
		
	}
	

	
	//exclui imagem
	public function excluirImagem(){ 
		
		//deleta a imagem da pasta
		include_once("../funcoes/geral.php");
		$sql = "
			SELECT imagem
			FROM entrevista
		"; 
		if($this->id)
			$sql .=" WHERE id = '$this->id'";
			

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro	 
		if($qtRegistros > 0){
			while($lista = self::resultsAll($this->qr)){

				deletaImagem($lista["imagem"]);//deleto a imagem do arquivo
			
			}
		}
		
	}
	
	//exclui imagem da galeria
	public function excluirImagemGaleria(){ 
		
		//deleta a imagem da pasta
		include_once("../funcoes/geral.php");
		$sql = "
			SELECT thumb
			FROM entrevista_imagem
		"; 
		if($this->idImagem)
			$sql .=" WHERE id = '$this->idImagem'";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro	 
		if($qtRegistros > 0){
			while($lista = self::resultsAll($this->qr)){

				deletaImagem($lista["thumb"]);//deleto a imagem do arquivo
			
			}
		}

	}
	
	//exclui imagem
	public function excluirImagemUpdate(){ 
		
		$sql = " UPDATE entrevista SET imagem = '' "; 
		if($this->id)
			$sql .=" WHERE id = '$this->id'";

			echo $sql;
		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		
		//deleta a imagem da pasta
		include_once("../funcoes/geral.php");		
		deletaArquivoEntrevista($this->nomeArquivo);//deleto arquivo
		
	}
	
	public function totalRegistros(){ 

		$sql = "
			SELECT id
			FROM entrevista
			WHERE dataExclusao IS NULL
		";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro

		return $qtRegistros;

	}

	

}

//------acoes------------------------------------------------------------------------------------------------------

	//cadastrar o registro
	if(isset($_POST["cadastrar"])){

		include_once("../funcoes/geral.php");
		//recupera os valores do formulario
		$dataEvento = converteData($_POST["dataEvento"]);
		$titulo = addslashes($_POST["titulo"]);
		$chamada = $_POST["chamada"];
		$descricao = addslashes($_POST["descricao"]);
		$video = addslashes($_POST["video"]);
		$audio = addslashes($_POST["audio"]);
		$dataCadastro = date("Y-m-d H:m:s");
		

		$nomeArquivo = $_REQUEST['nomeArquivoTemp'];
		//se a imagem nao existir
		if($nomeArquivo){

			$nomeArquivo = str_replace('<div id="isChormeWebToolbarDiv" style="display: none;"></div>', '', $nomeArquivo);
					 		
		 	moveImg("../uploadTemp/img_small","../upload/img_small",$nomeArquivo);
		 	moveImg("../uploadTemp/img_medium","../upload/img_medium",$nomeArquivo);
		 	moveImg("../uploadTemp/img_large","../upload/img_large",$nomeArquivo);
		 	moveImg("../uploadTemp/img_full","../upload/img_full",$nomeArquivo);
	  		 
	  	 	cropEntrevista($nomeArquivo);
		}
		
	
		//instanciando o objeto de cadastro
		$cad = new ManipulateData();
		$cad->setTable("entrevista");
		$cad->setFields("titulo,chamada,descricao,dataEvento,imagem,video,audio,dataCadastro");
		$cad->setDados("'$titulo','$chamada','$descricao','$dataEvento','$nomeArquivo','$video','$audio','$dataCadastro'");
		$cad->insert();
		$idRegistro = $cad->getRetornaIdCadastro(); 
		$erro = base64_encode($cad->getStatus());
		
		if($_POST['nomeImagemTemp']){
			foreach ($_POST['nomeImagemTemp'] as $nomeArquivo) {
				if($nomeArquivo){		
					 //$descricaoImagem = $_REQUEST['descricaoImagem'];
					 $imgThumb = $nomeArquivo;
					 $imgGde = str_replace("thumb", "imagem", $nomeArquivo);
					 
					 $imgThumb = str_replace('<div id="isChormeWebToolbarDiv" style="display: none;"></div>', '', $imgThumb);
				 	 $imgGde = str_replace('<div id="isChormeWebToolbarDiv" style="display: none;"></div>', '', $imgGde);
			
					 $deThumb = "../uploadTemp/thumb/".$imgThumb;
			  		 $paraThumb = "../upload/thumb/".$imgThumb;
			  		 copy($deThumb, $paraThumb);
			  		 @unlink($deThumb);
			  		 
			  		 $deGde = "../uploadTemp/imagem/".$imgGde;
			  		 $paraGde = "../upload/imagem/".$imgGde;
			  		 copy($deGde, $paraGde);
			  		 @unlink($deGde);
			  		 	//cadastro da imagem
			  		 	$cad = new ManipulateData();
			  		 	$cad->setTable("entrevista_imagem");
			  		 	$cad->setFields("entrevista_id,imagem,thumb");
						$cad->setDados("'$idRegistro','$imgGde','$imgThumb'");
						$cad->insert();
				}
			}
		}
	$urlRedirecionamento = '../admin/?telas=nova-entrevista&msn='.$erro;
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=$urlRedirecionamento'>";
	}
	//alterar o registro
	if(isset($_POST["alterar"])){
		include_once("../funcoes/geral.php");
		//recupera os valores do formulario
		$idAlteracao = $_POST["idAlteracao"];
		$dataEvento = converteData($_POST["dataEvento"]);
		$titulo = addslashes($_POST["titulo"]);
		$chamada = $_POST["chamada"];
		$descricao = addslashes($_POST["descricao"]);
		$video = addslashes($_POST["video"]);
		$audio = addslashes($_POST["audio"]);
		$dataAlteracao = date("Y-m-d H:i:s");
		

		$nomeArquivo = $_POST['nomeArquivoTemp'];
		//se a imagem nao existir
		if($nomeArquivo){

			 //$descricaoImagem = $_REQUEST['descricaoImagem'];
			 $imgThumb = $nomeArquivo;
			 $imgGde = str_replace("thumb", "imagem", $nomeArquivo);
			 
			 $imgThumb = str_replace('<div id="isChormeWebToolbarDiv" style="display: none;"></div>', '', $imgThumb);
		 	 $imgGde = str_replace('<div id="isChormeWebToolbarDiv" style="display: none;"></div>', '', $imgGde);
	
			 $deThumb = "../uploadTemp/thumb/".$imgThumb;
	  		 $paraThumb = "../upload/thumb/".$imgThumb;
	  		 copy($deThumb, $paraThumb);
	  		 @unlink($deThumb);
	  		 
	  		 $deGde = "../uploadTemp/imagem/".$imgGde;
	  		 $paraGde = "../upload/img_full/".$imgGde;
	  		 copy($deGde, $paraGde);
	  		 @unlink($deGde);
	  		 
	  		 cropEntrevista($imgGde);
		}
		
	
		//instanciando o objeto de alteracao
		$alt = new ManipulateData();
		$alt->setTable("entrevista");//envio o nome da tabela
			//enviando os atributos do banco
			$alt->setFields("titulo='$titulo', chamada='$chamada', descricao='$descricao', dataEvento='$dataEvento', video='$video', audio='$audio', dataAlteracao='$dataAlteracao'");
			//envio o campo de referente ao id de alteracao
			$alt->setFieldId("id");
			//envio o valor de referente ao id de alteracao
			$alt->setValueId($idAlteracao);
			//efetuando a alteracao
			$alt->update();
			$erro = base64_encode($alt->getStatus());
			
			if($nomeArquivo){
				//enviando os atributos do banco
				$alt->setFields("imagem='$imgGde'");
				//envio o campo de referente ao id de alteracao
				$alt->setFieldId("id");
				//envio o valor de referente ao id de alteracao
				$alt->setValueId($idAlteracao);
				//efetuando a alteracao
				$alt->update();
				base64_encode($alt->getStatus());
			}
			
		if($_POST['nomeImagemTemp']){
			foreach ($_POST['nomeImagemTemp'] as $nomeArquivo) {
				if($nomeArquivo){		
					 //$descricaoImagem = $_REQUEST['descricaoImagem'];
					 $imgThumb = $nomeArquivo;
					 $imgGde = str_replace("thumb", "imagem", $nomeArquivo);
					 
					 $imgThumb = str_replace('<div id="isChormeWebToolbarDiv" style="display: none;"></div>', '', $imgThumb);
				 	 $imgGde = str_replace('<div id="isChormeWebToolbarDiv" style="display: none;"></div>', '', $imgGde);
			
					 $deThumb = "../uploadTemp/thumb/".$imgThumb;
			  		 $paraThumb = "../upload/thumb/".$imgThumb;
			  		 copy($deThumb, $paraThumb);
			  		 @unlink($deThumb);
			  		 
			  		 $deGde = "../uploadTemp/imagem/".$imgGde;
			  		 $paraGde = "../upload/imagem/".$imgGde;
			  		 copy($deGde, $paraGde);
			  		 @unlink($deGde);
			  		 	//cadastro da imagem
			  		 	$cad = new ManipulateData();
			  		 	$cad->setTable("entrevista_imagem");
			  		 	$cad->setFields("entrevista_id,imagem,thumb");
						$cad->setDados("'$idAlteracao','$imgGde','$imgThumb'");
						$cad->insert();
				}
			}
		}

		$urlRedirecionamento = '../admin/?telas=nova-entrevista&idAlteracao='.$idAlteracao.'&acao=alterar&msn='.$erro;
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=$urlRedirecionamento'>";
	}
	
	//excluir o registro
	if(isset($_POST['id'])){

		$itemExclusao = $_POST['id'];
		
		//deleta imagens da noticia
			$conteudo = new Entrevista();
			$conteudo->setId($itemExclusao);
			$conteudo->excluirImagem();
	
		//instanciando o objeto de exclusao
		$exc = new ManipulateData();
		//envio o nome da tabela
		$exc->setTable("entrevista");
		//envio o campo de referente ao id de exclusao
		$exc->setFieldId("id");
		//envio o valor de referente ao id de exclusao
		$exc->setValueId($itemExclusao);
		//efetuando a exclusao
		$exc->delete();
		$erro = $exc->getStatus();
		
		$exc->setTable("entrevista_imagem");
		//envio o campo de referente ao id de exclusao
		$exc->setFieldId("entrevista_id");
		//envio o valor de referente ao id de exclusao
		$exc->setValueId($itemExclusao);
		//efetuando a exclusao
		$exc->delete();
		echo $erro = $exc->getStatus();
	}
		
	if($_POST['acao']=="excluirImagemTemp"){
		$arquivoTemp = $_POST['arquivoTemp'];
		$exc = new Entrevista();
		//envio o nome da tabela
		$exc->setNomeArquivo($arquivoTemp);
		$exc->excluirImagemTemp();
	}
	
	if($_POST['acao']=="excluirImagemUpdate"){
		$arquivo = $_POST['arquivoTemp'];
		$exc = new Entrevista();
		//envio o nome da tabela
		$exc->setNomeArquivo($arquivo);
		$exc->setId($_POST['idImagem']);
		$exc->excluirImagemUpdate();
	}
	
	if($_POST['acao']=="excluirImagemGaleria"){
		$idImagem = $_POST['idImagem'];

		$exc = new Entrevista();
		$exc->setidImagem($idImagem);
		$exc->excluirImagemGaleria();
		
		//deleto o registro	
			//instanciando o objeto de exclusao
			$exc = new ManipulateData();
			//envio o nome da tabela
			$exc->setTable("entrevista_imagem");
			//envio o campo de referente ao id de exclusao
			$exc->setFieldId("id");
			//envio o valor de referente ao id de exclusao
			$exc->setValueId($idImagem);
			//efetuando a exclusao
			$exc->delete();
		
	}
	

?>
