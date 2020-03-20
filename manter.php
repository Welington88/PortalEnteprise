<?php session_start();//inicio da sessao ?>
<?php require_once "./header.php"; ?>
<?php require_once "./menu.php"; ?>
<?php  
    if(isset($_REQUEST['curso'])){
        unset($_SESSION['curso']);
        $_SESSION['curso'] = $_REQUEST['curso'];
        header("Location: inscricao.php?curso='".$_REQUEST['curso'].
                "'&inscrever=true");exit;
    }
?>
<hgroup class="pagina">
<h3>Enterprise >> Cursos & Treinamentos>> Manter</h3>
<h1>MERCADO DE TRABALHO</h1>
<?php require_once './_model/classaluno.php';
	require_once './_model/UrlDb.php';
        $url = new UrlBD();
		$dsn = $url->getDsn();
        $username = $url->getUsername();
        $passwd = $url->getPasswd();
    try {$conexao= new \PDO($dsn, $username, $passwd);} catch (\PDOException $ex) {
        die('Não foi possível estabelecer conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());}
    if (isset($_SESSION['emails'])){
        $aluno = new aluno($conexao);$resultado = $aluno->find($_SESSION['ids']);
        $aluno->setId($resultado['idaluno']);$aluno->setNome($resultado['nomealuno']);}
    if(isset($_SESSION['emails'])){
    $usuario = explode(" ", $aluno->getNome());
    //echo "<h5 id=usuario>Usuário Logado=> $usuario[0] </h5>";
	} ?>
</hgroup>
<figure id="iconeCurso">    
    <img src="_imagens/manter.png" 
         alt="COMO MANTER-SE IMPORTANTE NO MERCADO DE TRABALHO" align="top"/>
</figure>
<div class="texto">
    <h2>COMO MANTER-SE IMPORTANTE NO MERCADO DE TRABALHO </h2>
    
    <p>Manter-se competitivo e atualizado é, hoje em dia, muito mais do que um 
        diferencial para profissionais de quaisquer áreas. Esse cuidado passou 
        a ser, na verdade, imprescindível para a sobrevivência no mercado. 
        Afinal de contas, como o mundo dos negócios está cada vez mais acirrado 
        e competitivo, não é mais possível simplesmente se acomodar na posição 
   que ocupa atualmente ou se conformar em ficar fora do mercado de trabalho.</p>
    <h2>Descrição</h2>
    <p>Sendo assim, existe um termo muito utilizado no meio executivo, chamado 
    <i>“empregabilidade”</i>, que representa uma característica fundamental para 
    distinguir as pessoas que terão destaque profissional e que possivelmente 
    venham a ocupar os melhores cargos e conquistar as melhores oportunidades.</p>
<p>As pessoas empregáveis são aquelas que buscam enriquecer seu conhecimento e 
    estão sempre atualizadas. Além disso, são os modelos de funcionários que as 
    grandes empresas buscam, afinal, o meio corporativo procura por aqueles que 
    possam oferecer mais do que o próprio serviço exige, pessoas que venham a 
    agregar valores, que consigam fazer a diferença e 
    <i><b>MANTER-SE IMPORTANTE NO MERCADO DE TRABALHO.</b></i></p>
<p><h4>Venha participar do nosso minicurso!!!</h4></p>
<h2>Carga Horária:</h2>
<ul>
    <li><h4> 4 horas</h4></li>
</ul>
<h2>Conteúdo programático:</h2>
<ul class="pri">
    <li>autoconhecimento</li>
    <li>markenting pessoal</li>
    <li>empregabilidade</li>
    <li>técnicas para elaboração do currículo</li>
    <li>dicas de como se comportar em uma entrevista de emprego</li>
    <li>perfil do profissional de sucesso</li>
</ul>
<h2>Investimento:</h2> 
<p><span class="valor"><b> R$ 30,00</b> </span>
    Com direito a certificado.</p>
<?php if(isset($_SESSION['curso'])){
    require_once './_model/classcursos.php';
    try {
        $conexaoCurso = new \PDO($dsn, $username, $passwd);//cria conexão com banco de dadosX 
    } catch (\PDOException $ex) {
        die('Não foi possível estabelecer '
        . 'conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());
    }
    $curso = new Cursos($conexaoCurso);
    $id = $_SESSION['curso'];
    $resultadoCurso = $curso->find($id);
    $curso->setNomeCurso($resultadoCurso['nomecurso']);
    $curso->setDescricao($resultadoCurso['descricao']);
    $curso->setInstrutor($resultadoCurso['instrutor']);
    $curso->setPrevisao($resultadoCurso['previsao']);
    $curso->setCarga($resultadoCurso['carga']);
    $curso->setTotaula($resultadoCurso['totaulas']);
    $curso->setValor($resultadoCurso['valor']);
    $curso->setVagas($resultadoCurso['vagas']);
    }
    //incio do banco de dados
    $idcurso = 4;
    
    if (isset($_SESSION['ids'])){$idaluno = trim(strip_tags($_SESSION['ids'])); 
    //incio do banco de dados
    require_once './_model/classinscricao.php';
    try {
        $conexaoInscricao= new \PDO($dsn, $username, $passwd);//cria conexão com banco de dadosX 
    } catch (\PDOException $ex) {
        die('Não foi possível estabelecer '
        . 'conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());
    }
    $inscricao = new Inscricao($conexaoInscricao);
    //$resultado = $aluno->find($_REQUEST['id']);
    $inscricao->setIdcurso($idcurso);
    $inscricao->setIdaluno($idaluno);
    $resultado = $inscricao->find($idaluno,$idcurso);
    $consultaid = $resultado['idaluno'];
    $inscricao->find($consultaid,$idcurso);
    $numinscricao = $resultado['idinscricao'];
    $statuspgto = $resultado['statuspgto'];
    $inscricao->setStatuspgto($statuspgto);
    $chave = $resultado['chave'];
    $inscricao->setChave($chave);
    }
    if(isset($_SESSION['curso'])){
    $vagas = $resultadoCurso['vagas'];
    
    //header("Location: consulta.php");exit;   
    // fim de bando de dados*/
    if (isset($_SESSION['ids'])){}else{$numinscricao=0;}
    if($numinscricao<1&&$vagas>0){
        echo "<span id='inscricao'><a href='excelavancado.php?curso=" . $idcurso ."'>"
        . "Faça sua Inscrição aqui!!!</a></span>";
    }else {
        echo "<span id='inscricao'><a href='consulta.php?curso=" . $idcurso ."'>"
        . "Consulte sua Inscrição aqui!!!</a></span>";
    }} else { //se não tiver logado
        require_once './_model/classcursos.php';
    try {
        $conexaoCurso = new \PDO($dsn, $username, $passwd);//cria conexão com banco de dadosX 
    } catch (\PDOException $ex) {
        die('Não foi possível estabelecer '
        . 'conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());
    }
    $curso = new Cursos($conexaoCurso);
    $id = $idcurso;
    $resultadoCurso = $curso->find($id);
    $curso->setNomeCurso($resultadoCurso['nomecurso']);
    $curso->setDescricao($resultadoCurso['descricao']);
    $curso->setInstrutor($resultadoCurso['instrutor']);
    $curso->setPrevisao($resultadoCurso['previsao']);
    $curso->setCarga($resultadoCurso['carga']);
    $curso->setTotaula($resultadoCurso['totaulas']);
    $curso->setValor($resultadoCurso['valor']);
    $curso->setVagas($resultadoCurso['vagas']);
    $vagas = $curso->getVagas();
    if($vagas>0){
        echo "<span id='inscricao'><a href='excelavancado.php?curso=". $idcurso ."'>"
        . "Faça sua Inscrição aqui!!!</a></span>";
    }//fim de serro 
    }
?>
<p><b><i>Enterprise&copy;</i></b> o melhor para você, sua equipe e sua empresa.</p>
</div>
<?php require_once "./footer.php"; ?>