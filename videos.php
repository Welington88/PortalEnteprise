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
<!--<h2>por Welington Marquezini</h2>
<h3 class="direita">Atualizado em 01/Maio/2014</h3>-->
<?php require_once './_model/classaluno.php';
    try {$conexao= new \PDO($dsn, $username, $passwd);} catch (\PDOException $ex) {
        die('Não foi possível estabelecer conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());}
    $aluno = new aluno($conexao);$resultado = $aluno->find($_SESSION['ids']);$aluno->setId($resultado['idaluno']);$aluno->setNome($resultado['nomealuno']);
    if(isset($_SESSION['emails'])){
        $usuario = explode(" ", $aluno->getNome());
        //echo "<h5 id=usuario>Usuário Logado=> $usuario[0] </h5>";
		} 
   ?>
   <p><b><a href="consulta.php">Voltar</a></b></p>
</hgroup>

<div class="texto">  
				<h2>Vídeos de Treinamentos</h2>
                <?php $statuspgto = $inscricao->getStatuspgto();
                    if ($statuspgto == "PAGO" || $statuspgto == "GRATUITO"){//if ($statuspgto != ""){
                        switch ($inscricao->getIdcurso()){
                            case 1: //case 1 curso de excel avançado 2016
                                break;
                            case 2://case curso for Excel Básico 2016
                                    break;
                             case 3: //case 3 curso de excel avançado 2016
								break;
							case 5://case Combo curso for Básico + Excel Avançado
									
                                    echo '<h1><em><u>Área do Aluno</u></em></h1>'
                                    . '<h2>Vídeo Com Explicação sobre o Exercícios</h2>'
                                    . '';
									
									echo '<h2>Vídeo Revisão 03</h2>'
                                    . '<iframe width="560" height="315" src="https://www.youtube.com/embed/hfT3OJ2j4Zo" frameborder="0"'
									. 'allowfullscreen></iframe>';
									
									echo '<h2>Vídeo Revisão 04</h2>'
                                    . '<iframe width="560" height="315" src="https://www.youtube.com/embed/pheyjoOX_L4" frameborder="0"'
									. 'allowfullscreen></iframe>';
                                    //aqui termina
                        }
                    }
                    else{
                    echo "<b>CAIXA ECONÔNICA FEDERAL</b><br/>"
                     . "<b>AGÊNCIA:</b> <i>0608</i><br/>"
                     . "<b>CONTA CORRENTE:</b> <i>001 00022759-9</i><br/>"
                    . "<i>WELINGTON MARQUEZINI VALVERDE DA SILVA</i><br/>";} ?>
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