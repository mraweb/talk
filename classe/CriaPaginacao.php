<?php
include_once("MySqlConn.php");

	class criaPaginacao extends MySqlConn{
				
		private $ida, $param;
		private $maxPage, $maxLink, $numeroPaginas;
		private $sqlA, $sqlB;
		private $fileName, $nomeArquivoHTML;
		private $temp;
		private $passoA, $passoB;
		private $qrA, $qrB;
		private $totRegA, $totRegB;
		private $resultadoTotal, $resultadoParcial, $resultadoDiv, $numeroInt;
		private $pagAtual, $proxPag, $ultPag, $pagAnt;
		private $regInicial;
		private $dadosGerados;
		private $registroFinal;
		
		public function setParametro($cod){
			$this->ida = $cod;
		}
		
		public function setFileName($file){
			$this->fileName = $file;
		}
		
		public function setInfoMaxPag($max){
			$this->maxPage = $max;
		}
		
		public function setMaximoLinks($max){
			$this->maxLink = $max;
		}
		
		public function setSQL($qr){
			$this->sqlA = $qr;
		}
		
		public function setContador($cont){
			$this->registroFinal = $this->param + $cont;
		}
		
		public function setNomeArquivoHTML($arq){
			$this->nomeArquivoHTML = $arq;
		}
		
		public function setPalavraPesquisa($palavra){
			$this->palavraPesquisa = $palavra;
		}		
/**********************************************************************************************************/		

		protected function iniciaPaginacao(){
		
			if (empty($this->ida)){
				$this->param = 0;
			} else {
				$this->temp = $this->ida;
				$this->passoA = $this->temp - 1;
				$this->passoB = $this->passoA * $this->maxPage;
				$this->param = $this->passoB;
			}	
				//$parametroTemp = $this->parametro - 1;
				$this->sqlB = $this->sqlA." LIMIT ".$this->param.",".$this->maxPage;
				
				//cria as conexÃµes
				$this->qrA = self::execSQL($this->sqlA);
				$this->qrB = self::execSQL($this->sqlB);
  				$this->totRegA = self::countData($this->qrA);
				$this->totRegB = self::countData($this->qrB);

				//carrega as variÃ¡veis
			
				$this->resultadoTotal = $this->totRegA;
				$this->resultadoParcial = $this->totRegB;
				$this->resultadoDiv = $this->resultadoTotal / $this->maxPage;
				$this->numeroInt = (int)$this->resultadoDiv;
				if ($this->numeroInt < $this->resultadoDiv){
					$this->numeroPaginas = $this->numeroInt + 1;
				}else{
					$this->numeroPaginas = $this->resultadoDiv;
				}
				$this->pagAtual = $this->param / $this->maxPage + 1;
				$this->regInicial = $this->param + 1;
				$this->pagAnt = $this->pagAtual - 1;
				$this->proxPag = $this->pagAtual + 1;
		}
		protected function results(){
			$this->dadosGerados = self::listQr($this->qrB);
			return $this->dadosGerados;
		}
		
		protected function resultsAll($query){
			$this->dadosGerados = self::listQr($query);
			return $this->dadosGerados;
		}
		
		// mÃ©todo que busca o quantidade de dados cadastrado em uma query
		public function getQuantidadeData($sql){
			$this->sql = $sql;
			$this->qr = self::execSql($this->sql);
			return mysql_num_rows($this->qr);
		}
		
		// mÃ©todo que busca o quantidade de dados cadastrado em uma query
		public function getTotalRecord($sql){
			$this->sql = $sql;
			$this->qr = self::execSql($this->sql);
			$this->data = self::listQr($this->qr);
			return $this->data["total"];
		}
		
	// mÃ©todo que busca o quantidade de dados cadastrado em uma query
		public function getUmRecord($sql,$atributo){
			$this->sql = $sql;
			$this->qr = self::execSql($this->sql);
			$this->data = self::listQr($this->qr);
			return $this->data["$atributo"];
		}
/**********************************************************************************************************/		

		public function geraNumeros(){
  		echo '
		<div id="pages">
    		<ul class="paginacao">';
			if ($this->ida > 1) { 
                           echo "<li><a href=\"$this->fileName&pg=$this->pagAnt&txtCampoPesquisa=$this->palavraPesquisa\" title=\"$this->pagAnt\">&laquo;</a>\n </li>";
					   }
			           if ($this->temp >= $this->maxLink){
			             if ($this->numeroPaginas > $this->maxLink){
						     $n_maxlnk = $this->temp + 6;
			                 $this->maxLink = $n_maxlnk;
			                 $n_start = $this->maxLink - 6;
			                 $lnk_impressos = $n_start;
				         }
			           }
			           //mostra os nÃºmeros das pÃ¡ginas
					   if($this->numeroPaginas > 1){
						   while(($lnk_impressos < $this->numeroPaginas) and ($lnk_impressos < $this->maxLink)){ 
							   $lnk_impressos ++; 
								  // Mostra a pÃ¡gina atual sem o link
								  if ($this->pagAtual == $lnk_impressos){
									 echo "<li class='current'><strong>$lnk_impressos</strong> \n </li>";
							   //mostra os nÃºmeros das 
							   	  }else{
								  	 echo "<li><a href=\"$this->fileName&pg=$lnk_impressos&txtCampoPesquisa=$this->palavraPesquisa\" title=\"$lnk_impressos\">$lnk_impressos</a>\n</li>";
								  } 
							   }
					   }
                      // mostra o link PRÃ“XIMO >>
					  if ($this->registroFinal < $this->resultadoTotal){
                            echo"<li><a href=\"$this->fileName&pg=$this->proxPag&txtCampoPesquisa=$this->palavraPesquisa\" title=\"$this->proxPag\">&raquo;</a>\n </li>";
					 }	
		echo'
			</ul>
		</div>
		';			
		}
		
		
		public function geraPaginacaoSite(){
  		echo '
		<ul class="paginacao">';
			if ($this->ida > 1) { 
						   echo'<li><a href="'.$this->fileName.'/pagina/'.$this->pagAnt.'" title="página '.$this->pagAnt.'"> &laquo; </a></li>';		
                           //echo "<li><a href=\"pagina/$this->pagAnt\" title=\"$this->pagAnt\">Anterior</a>\n </li>";
					   }
			           if ($this->temp >= $this->maxLink){
			             if ($this->numeroPaginas > $this->maxLink){
						     $n_maxlnk = $this->temp + 6;
			                 $this->maxLink = $n_maxlnk;
			                 $n_start = $this->maxLink - 6;
			                 $lnk_impressos = $n_start;
				         }
			           }
			           //mostra os números das páginas
			           //---parte que deixa páginação com o máximo de 3 números----------
				           $totalPag = $this->numeroPaginas;
				           $pagAtual = $this->pagAtual;
				           
				           if($totalPag == 2){
				           	$inicioLoop = 1;
				           	$fimLoop = 2;
				           }elseif($totalPag > 2 && $pagAtual == 1){
				           	$inicioLoop = 1;
				           	$fimLoop = 3;
				           	}elseif($totalPag > 2 && $pagAtual > 1){
				           		
				           		$inicioLoop = $pagAtual - 1;
				           		if($pagAtual == $totalPag)
				           			$fimLoop = $pagAtual;
				           		else
				           			$fimLoop = $pagAtual + 1;
				           	}
						//------------------------------------------------------------------
					   if($this->numeroPaginas > 1){
						   while($inicioLoop <= $fimLoop){ 
								  if ($this->pagAtual == $inicioLoop){
								  	 echo'<li><a class="ativo" href="javascript:void(0);" title="página atual">'.$inicioLoop.'</a></li>';
							   	  }else{
							   	  	echo'<li><a href="'.$this->fileName.'/pagina/'.$inicioLoop.'" title="página '.$inicioLoop.'"> '.$inicioLoop.' </a></li>';
								  } 
								  $inicioLoop++;
							   }
					   }
                      // mostra o link PROXIMO >>
					  if ($this->registroFinal < $this->resultadoTotal){
					  		echo'<li><a href="'.$this->fileName.'/pagina/'.$this->proxPag.'" title="página '.$this->proxPag.'"> &raquo; </a></li>';
					 }	
		echo'
			</ul>
		';			
		}
		
		
		
		public function getTime(){ 
			list($sec, $usec) = explode(" ",microtime()); 
			return ($sec + $usec); 
		}
		
		//paginacao do ste
		public function geraPaginacao(){

			if ($this->ida > 1) { 
                           echo "<li><a href=\"$this->fileName/pg/$this->pagAnt/$this->palavraPesquisa\" title=\"$this->pagAnt\">Anterior</a>\n </li>";
					   }
			           if ($this->temp >= $this->maxLink){
			             if ($this->numeroPaginas > $this->maxLink){
						     $n_maxlnk = $this->temp + 6;
			                 $this->maxLink = $n_maxlnk;
			                 $n_start = $this->maxLink - 6;
			                 $lnk_impressos = $n_start;
				         }
			           }
			           //mostra os nÃºmeros das pÃ¡ginas
					   if($this->numeroPaginas > 1){
						   while(($lnk_impressos < $this->numeroPaginas) and ($lnk_impressos < $this->maxLink)){ 
							   $lnk_impressos ++; 
								  // Mostra a pÃ¡gina atual sem o link
								  if ($this->pagAtual == $lnk_impressos){
									 echo "<li class='current'><strong>$lnk_impressos</strong> \n </li>";
							   //mostra os nÃºmeros das 
							   	  }else{
								  	 echo "<li><a href=\"$this->fileName/pg/$lnk_impressos/$this->palavraPesquisa\" title=\"$lnk_impressos\">$lnk_impressos</a>\n</li>";
								  } 
							   }
					   }
                      // mostra o link PRÃ“XIMO >>
					  if ($this->registroFinal < $this->resultadoTotal){
					  		
                            echo"<li><a href=\"$this->fileName/pg/$this->proxPag/$this->palavraPesquisa\" title=\"$this->proxPag\">Pr&oacute;ximo</a>\n </li>";
					 }	
			
		}
		
	}
?>