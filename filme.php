<?php session_start();//inicio da sessao 
 if(isset($_REQUEST['curso'])){
     $_SESSION['curso'] = $_REQUEST['curso'];
 }
?>
<?php require_once "./header.php"; ?>
<?php require_once "./menu.php"; ?>
<?php 
if(isset($_REQUEST['curso'])){
            $_SESSION['curso'] = $_REQUEST['curso'];
            header("Location: consulta.php");exit;
    }
if(isset($_SESSION['emails'])){    
}else {
    header("Location: login.php?acesso='logar'");exit;
} 
?>
<?php
    //incio do banco de dados
    $idcurso = trim(strip_tags($_SESSION['curso']));
    $idaluno = trim(strip_tags($_SESSION['ids'])); 
    //incio do banco de dados
    if(isset($_SESSION['curso'])){
    if(isset($_SESSION['emails'])){
    require_once './_model/classinscricao.php';
    require_once './_model/UrlDb.php';
        $url = new UrlBD();
		$dsn = $url->getDsn();
        $username = $url->getUsername();
        $passwd = $url->getPasswd();
    try {
        $conexao= new \PDO($dsn, $username, $passwd);//cria conexão com banco de dadosX 
    } catch (\PDOException $ex) {
        die('Não foi possível estabelecer '
        . 'conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());
    }
    $inscricao = new Inscricao($conexao);
    //$resultado = $inscricao->find($_REQUEST['id']);
    $inscricao->setIdcurso($idcurso);
    $inscricao->setIdaluno($idaluno);
    $resultado = $inscricao->find($idaluno,$idcurso);
    $consultaid = $resultado['idaluno'];
    $inscricao->find($consultaid,$idcurso);
    $statuspgto = $resultado['statuspgto'];
    $inscricao->setStatuspgto($statuspgto);
    $inscricao->setNomeCurso($resultado['nomecurso']);
    $inscricao->setDescricao($resultado['descricao']);
    $inscricao->setInstrutor($resultado['instrutor']);
    $inscricao->setPrevisao($resultado['previsao']);
    $inscricao->setCarga($resultado['carga']);
    $inscricao->setTotaula($resultado['totaulas']);
    $inscricao->setValor($resultado['valor']); 
    //incio do banco de dados
    require_once './_model/classaluno.php';
    //$resultado = $inscricao->find($_REQUEST['id']);
    $inscricao->setId($resultado['idaluno']);
    $inscricao->setNome($resultado['nomealuno']);
    $inscricao->setCpf($resultado['cpf']);
    $inscricao->setRg($resultado['rg']);
    $inscricao->setEmail($resultado['email']);
    $inscricao->setNascimento($resultado['nascimento']);
    $inscricao->setSexo($resultado['sexo']);
    $inscricao->setEscolaridade($resultado['escolaridade']);
    $inscricao->setProfissao($resultado['profissao']);
    $inscricao->setRua($resultado['rua']);
    $inscricao->setN($resultado['n']);
    $inscricao->setComplemento($resultado['complemento']);
    $inscricao->setBairro($resultado['bairro']);
    $inscricao->setCidade($resultado['cidade']);
    $inscricao->setUf($resultado['uf']);
    $inscricao->setCep($resultado['cep']);
    $inscricao->setTel($resultado['tel']);
    $inscricao->setCel($resultado['cel']);
    $inscricao->setSenha($resultado['senha']);
    $inscricao->setDatainscricao($resultado['datainscricao']);
    $inscricao->setInscricao($resultado['idinscricao']);
    $inscricao->setDesconto($resultado['desconto']);
    $inscricao->setChave($resultado['chave']);
    }}
?>    
<hgroup class="pagina">
    <h3>Enterprise >> Cursos & Treinamentos>> Vídeos</h3><br/>
    <h1 class="center"><i>Vídeos do Treinamento.</i></h1>
<?php require_once './_model/classaluno.php';
    try {$conexao= new \PDO($dsn, $username, $passwd);} catch (\PDOException $ex) {
        die('Não foi possível estabelecer conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());}
    $aluno = new aluno($conexao);$resultado = $aluno->find($_SESSION['ids']);$aluno->setId($resultado['idaluno']);$aluno->setNome($resultado['nomealuno']);
    if(isset($_SESSION['emails'])){
        $usuario = explode(" ", $aluno->getNome());
        //echo "<h5 id=usuario>Usuário Logado=> $usuario[0] </h5>";
		} 
   ?>
</hgroup>
<p><b><a href="ead.php">Voltar</a></b></p>
<div class="texto">  
	<h2>Vídeos de Treinamentos - EAD</h2>
	<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
<?php
	echo '<h1><em><u>Área do Aluno - EAD</u></em></h1>';
	echo '<h2>EAD Filme: Pirates of Silicon Valley (Piratas da Informática ou Piratas do Vale do Silício)</h2>'
	   . '<iframe src="https://onedrive.live.com/embed?cid=D4A9C21E594FFC65&resid=D4A9C21E594FFC65%21549349&authkey=AIzJ2zn0gO4Z7nY" width="320" height="320" frameborder="0" scrolling="no" allowfullscreen></iframe>';
?>
</div>
<?php require_once "./footer.php"; ?>
<?php 
if (isset($_REQUEST['inscricao'])){
    echo '<script  type="text/javascript"  type="text/javascript">'
        . 'alert("Inscrição Realizada com Sucesso! \n'
        . 'Parabéns pela sua Escolha, você está invenstindo no seu futuro!");</script>';
}
if (isset($_REQUEST['ninscricao'])){
    echo '<script  type="text/javascript"  type="text/javascript">'
    . 'alert("Você já está inscrito nesse curso!");</script>';
}
?>