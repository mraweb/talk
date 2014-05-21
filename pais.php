<?php 
include_once("classe/Empresa.php");
$empresa = new Empresa();
?>
<div class="geral">
<!-- ****** CLIQUE VINDO DO BOTAO BRASIL ****** -->
<section id="brasil" class="pais">
    <h3>Brasil</h3>

    <a href="#" title="Fechar" class="bt-fechar hidetxt">Fechar</a>

    <ul class="menu-pais">
        <li><a href="#norte" title="Região Norte">Norte</a></li>
        <li><a href="#nordeste" title="Região Nordeste">Nordeste</a></li>
        <li><a href="#centro" title="Região Centro Oeste">Centro Oeste</a></li>
        <li><a href="#sudeste" title="Região Sudeste">Sudeste</a></li>
        <li><a href="#sul" title="Região Sul">Sul</a></li>
    </ul>

    <div id="norte" class="content-pais">
        <?php 
    		$empresa->setCodigoPais(50);
    		$empresa->setNomeRegiao("regiao-norte");
    		$empresa->getRede();
    	?>
    </div>

    <div id="nordeste" class="content-pais">
        <?php 
    		$empresa->setCodigoPais(50);
    		$empresa->setNomeRegiao("regiao-nordeste");
    		$empresa->getRede();
    	?>
    </div>

    <div id="centro" class="content-pais">
        <?php 
    		$empresa->setCodigoPais(50);
    		$empresa->setNomeRegiao("regiao-centro");
    		$empresa->getRede();
    	?>
    </div>

    <div id="sudeste" class="content-pais">
        <?php 
    		$empresa->setCodigoPais(50);
    		$empresa->setNomeRegiao("regiao-sudeste");
    		$empresa->getRede();
    	?>
    </div>

    <div id="sul" class="content-pais">
        <?php 
    		$empresa->setCodigoPais(50);
    		$empresa->setNomeRegiao("regiao-sul");
    		$empresa->getRede();
    	?>
    </div>
</section>


<!-- ****** CLIQUES VINDO DO MAPA ****** -->
<section id="regiao-norte" class="pais">
    <h3>Brasil - Região Norte</h3>

    <a href="#" title="Fechar" class="bt-fechar hidetxt">Fechar</a>

    <div class="content-regiao">
        <?php 
    		$empresa->setCodigoPais(50);
    		$empresa->setNomeRegiao("regiao-norte");
    		$empresa->getRede();
    	?>
    </div>
</section>

<section id="regiao-nordeste" class="pais">
    <h3>Brasil - Região Nordeste</h3>

    <a href="#" title="Fechar" class="bt-fechar hidetxt">Fechar</a>

    <div class="content-regiao">
        <?php 
    		$empresa->setCodigoPais(50);
    		$empresa->setNomeRegiao("regiao-nordeste");
    		$empresa->getRede();
    	?>
    </div>
</section>

<section id="regiao-centro" class="pais">
    <h3>Brasil - Região Centro-Oeste</h3>

    <a href="#" title="Fechar" class="bt-fechar hidetxt">Fechar</a>

    <div class="content-regiao">
        <?php 
    		$empresa->setCodigoPais(50);
    		$empresa->setNomeRegiao("regiao-centro");
    		$empresa->getRede();
    	?>
    </div>
</section>

<section id="regiao-sudeste" class="pais">
    <h3>Brasil - Região Sudeste</h3>

    <a href="#" title="Fechar" class="bt-fechar hidetxt">Fechar</a>

    <div class="content-regiao">  
		<?php 
    		$empresa->setCodigoPais(50);
    		$empresa->setNomeRegiao("regiao-sudeste");
    		$empresa->getRede();
    	?>
    </div>
</section>

<section id="regiao-sul" class="pais">
    <h3>Brasil - Região Sul</h3>

    <a href="#" title="Fechar" class="bt-fechar hidetxt">Fechar</a>

    <div class="content-regiao">
        <?php 
    		$empresa->setCodigoPais(50);
    		$empresa->setNomeRegiao("regiao-sul");
    		$empresa->getRede();
    	?>
    </div>
</section>






<!-- ****** A PARTIR DAQUI FAZ O LOOPING QUE CRIA AS SECTIONS DOS PAISES ****** -->
<section id="eua" class="pais">
    <h3>Estados Unidos</h3>

    <a href="#" title="Fechar" class="bt-fechar hidetxt">Fechar</a>

    <div class="content-regiao">
        <table>
            <thead>
                <tr>
                    <td class="tam01">Afiliada</td>
                    <td>Dial</td>
                    <td>Cidade</td>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>Mix belém</td>
                    <td>100.9</td>
                    <td>Londrina</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>




<div id="mask"></div>
</div>