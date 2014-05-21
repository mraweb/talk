<?php
class upload {
	var $codigo;
	var $nomeArquivo;
	var $pasta;			// caminho de destino da imagem
	var $pasta_nome;		// caminho de destino da imagem com o nome da pasta
	var $nome;			// nome da imagem
	var $largura;		// largura limite desejada
	var $altura;		// altura limite desejada
	var $tmp_nome;			// nome temporário da imagem
	var $img_marca	= false;	// caminho completo para a imagem da marca d'agua

	public function __construct($arquivo = null, $pasta = null, $codigo = null){
		if(is_array($arquivo)) { 
			$this->nome = $codigo. '-' . criarSlug($arquivo['name']);
			$this->tmp_nome = $arquivo['tmp_name'];
			$this->pasta_nome = $pasta . '' . $this->nome;
		} else exit('Informe o nome da imagem'); 
	}

	//método para subir o arquivo para o servidor
	public function enviaArquivo() {
		if(copy($this->tmp_nome, $this->pasta_nome)) {
			if($this->img_marca) $this->marcaDagua();
			return $this->redimensiona();
		}
		exit('Erro ao copiar a imagem para o diretório ' . $this->pasta);
	}

	//método para redimensionar a imagem
	private function redimensiona() {
		$img = $this->pasta_nome;
		$nomeArquivo = $this->nome;
		// recupera tamanho da imagem e tipo
		list($larguraOriginal, $alturaOriginal, $type) = getimagesize($img);
		// faz checagem se a redimensão será via largura ou altura
		if ($this->largura && ($larguraOriginal < $alturaOriginal)) {
			$this->largura = ($this->altura / $alturaOriginal) * $larguraOriginal;
		} else {
			$this->altura = ($this->largura / $larguraOriginal) * $alturaOriginal;
		}
		// cria imagem com as dimensoes especificadas por parametro
		$novaImagem = imagecreatetruecolor($this->largura, $this->altura);
		// cria imagem JPEG
		$image = imagecreatefromjpeg($img);
		imagecopyresampled($novaImagem, $image, 0, 0, 0, 0, $this->largura, $this->altura, $larguraOriginal, $alturaOriginal);
		$image = imagejpeg($novaImagem, $img, 100);
		if($image) return $nomeArquivo;
		else exit('Erro ao redimensionar imagem');
	}

	//método para colocar a marca d'agua na imagem
	private function marcaDagua() {
		// Obtém o cabeçalho de ambas as imagens
		$cab_marca  = imagecreatefrompng($this->img_marca);
		$cab_imagem = imagecreatefromjpeg($this->pasta_nome);
		// Obtém os tamanhos de ambas as imagens
		$tam_imagem    = getimagesize($this->pasta_nome);
		$tam_marca     = getimagesize($this->img_marca);
		$largura_img   = $tam_imagem[0];
		$altura_img    = $tam_imagem[1];
		$largura_marca = $tam_marca[0];
		$altura_marca  = $tam_marca[1];
		// Aqui, defini-se a posição onde a marca deve aparecer na foto: Rodapé Direito
		$eixo_x = ($largura_img - $largura_marca) - 5;
		$eixo_y = ($altura_img - $altura_marca) - 5;
		imagecolortransparent($cab_marca, imagecolorallocate($cab_marca, 4, 137, 193));
		// A função principal: misturar as duas imagens
		imageCopyMerge($cab_imagem, $cab_marca, $eixo_x, $eixo_y, 0, 0, $largura_marca, $altura_marca, 50);
		// Cria a imagem com a marca da agua
		$image = imagejpeg($cab_imagem, $this->pasta_nome, 90);
		if($image) return $img;
		else exit('Erro ao gerar marca d`agua');
	}
}
