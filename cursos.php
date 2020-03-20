<?php 
ob_start();//inicio da sessao 
session_start();//inicio da sessao ?>
<?php require_once "./header.php"; ?>
<?php require_once "./menu.php"; ?>
<hgroup class="pagina">
<h3>Enterprise >> Cursos & Treinamentos</h3>
<h1><i class="fas fa-user-graduate"></i> &nbsp;&nbsp;Cursos & Treinamentos</h1>
</hgroup>
<main class="servicos container bg-white">
    <?php require_once './_model/classaluno.php';
	require_once './_model/UrlDb.php';
        $url = new UrlBD();
		$dsn = $url->getDsn();
        $username = $url->getUsername();
        $passwd = $url->getPasswd();
    try {$conexao= new \PDO($dsn, $username, $passwd);} catch (\PDOException $ex) {
        die('Não foi possível estabelecer conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());}
    if(isset($_SESSION['emails'])){    
    $aluno = new aluno($conexao);$resultado = $aluno->find($_SESSION['ids']);$aluno->setId($resultado['idaluno']);$aluno->setNome($resultado['nomealuno']);}
    if(isset($_SESSION['emails'])){
    $usuario = explode(" ", $aluno->getNome());
    //echo "<h5 id=usuario>Usuário Logado=> $usuario[0] </h5>";
	} ?>
    
    
    <article class="servico bg-white radius">
    <a href="excelavancado.php"><img src="_imagens/excel_2013.png" 
        alt="Curso de Excel Avançado" align="middle" /></a>
    <div class="inner">
        <a href="excelavancado.php">Curso de Excel Avançado!!!</a>
        <h4><b>O Melhor curso do Mercado</b></h4>
        <p>Invista no seu Futuro. Faça Agora Seu Curso de <i>Excel Avançado.</i>
            Não Perca mais Tempo!!!</p>
    </div>
    </article>
    
    <article class="servico bg-white radius">
         <a href="combo.php"><img src="_imagens/PowerBi.png" 
        alt="Curso de Excel Básico" align="middle" /></a>
    <div class="inner">
        <a href="combo.php">Curso de Power BI</a>
        <h4><b>Iniciar na ferramenta de BI(business intelligence)</b></h4>
        <p>Curso de Power BI iniciar na ferramenta que está  alta no mercado de trabalho!!!</p>
    </div>
    </article>

     <article class="servico bg-white radius">
         <a href="excelbasico.php"><img src="_imagens/excellogo.jpg" 
        alt="Curso de Excel Básico" align="middle" /></a>
    <div class="inner">
        <a href="excelbasico.php">Curso de Excel Básico!!!</a>
        <h4><b>Para você que está começando no Excel</b></h4>
        <p>Curso Básico tudo que você precisa para iniciar no mercado de trabalho!!!</p>
    </div>
    </article>
    
    <article class="servico bg-white radius">
      <a href="combo.php"><img src="_imagens/super.png" 
        alt="Curso de Excel Combo" align="middle" /></a>
    <div class="inner">
        <a href="combo.php">Super Curso de Excel Avançado!!!</a>
        <h4><b>Super Mega Combo de Excel Básico + Avançado 2 em 1!!!</b></h4>
        <p>Pague curso e faça 2 cursos completos com super desconto!!!</p>
    </div>
    </article>
    
    <article class="servico bg-white radius">
        <a href="manter.php"><img src="_imagens/manter.png" 
        alt="COMO MANTER-SE IMPORTANTE NO MERCADO DE TRABALHO" align="middle" /></a>
    <div class="inner">
        <a href="manter.php">MERCADO DE TRABALHO</a>
        <h4><b></b></h4>
        <p>COMO MANTER-SE IMPORTANTE NO MERCADO DE TRABALHO</p>
    </div>
    </article>
    
    <article class="servico bg-white radius">
        <a href="treinamentos.php"><img src="_imagens/treinamentos.png" 
        alt="Treinamentos" align="middle" /></a>
    <div class="inner">
        <a href="treinamentos.php">Treinamentos</a>
        <h4><b></b></h4>
        <p>Conheça nossos treinamentos leve para sua empresa ou facudade.</p>
    </div>
    </article>
    
    <article class="servico bg-white radius">
        <a href="workshop.php"><img src="_imagens/workshop.png" 
        alt="Workshop" align="middle" /></a>
    <div class="inner">
        <a href="treinamentos.php">Workshop!!!</a>
        <h4><b>Workshop Consultoria de Gestão</b></h4>
        <p>Treinamentos de Gestão ferramentas de Qualidade: PDCA, 5W2H, PARETO e 6SIGMA</p>
    </div>
    </article>
    
    <article class="servico bg-white radius">
        <a href="lider360.php"><img src="_imagens/lider_360.png" 
        alt="Líder 360" align="middle" /></a>
    <div class="inner">
        <a href="treinamentos.php">Líder 360</a>
        <h4><b>Gestão da inovação</b></h4>
        <p>Gestão inovadora somos a diferença, para sua empresa!!!</p>
    </div>
    </article>
   
    <article class="servico bg-white radius">
        <a href="relacoes.php"><img src="_imagens/relacoes_interpessoais.png" 
        alt="Relações Interpessoais" align="middle" /></a>
    <div class="inner">
        <a href="treinamentos.php">Treinamentos de Gente</a>
        <h4><b>Relações Interpessoais</b></h4>
        <p>Qualifique o seu time, traga sua equipe para um gestão inovadora!!!</p>
    </div>
    </article>
</main>
<?php require_once "./footer.php"; ?>


