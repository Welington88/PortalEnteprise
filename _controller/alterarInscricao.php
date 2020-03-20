<?php
    ob_start();//inicio da sessao 
    session_start();//inicio da sessao 
    if((isset($_SESSION['emails'])) && isset($_SESSION['senhas'])){//se não exitir
        if(isset($_SESSION['redirecionar'])){
            switch ($_SESSION['redirecionar']){
            case 1:    
                unset($_SESSION['redirecionar']);
                header("location: ../inscricao.php");exit;
                break;
        }}
		//Root
		require_once '../_model/UrlDb.php';
			$url = new UrlBD();
			$dsn = $url->getDsn();
			$username = $url->getUsername();
			$passwd = $url->getPasswd();
			$exect = false;
			$w = $url->getRoot();
			foreach ($w as $e){
				if($e == $_SESSION['emails']){
					$exect = true;
				}
			}
		if(!$exect){
			header("Location: ../usuario.php?acesso='negado'");exit;
		}
		//Root
    }else{
        header("Location: ../login.php?acesso='negado'");exit;
    }
    //incio do banco de dados
    require_once '../_model/classinscricao.php';
	//conexao
    try {
        $conexao= new \PDO($dsn, $username, $passwd);//cria conexão com banco de dadosX 
    } catch (\PDOException $ex) {
        die('Não foi possível estabelecer '
        . 'conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());
    }
    $inscricao = new Inscricao($conexao);
    $inscricao->setInscricao($_REQUEST['tInscricao']);
    $inscricao->setStatuspgto($_REQUEST['tPg']);
    $inscricao->setIdcurso($_REQUEST['curso']);
    $desc = $_REQUEST['tDesconto'];
    $desc = str_replace(",",".",$desc);
    $desc /= 100;
    $desc = 1-$desc;
    $inscricao->setDesconto($desc);
    if($exect){
        $inscricao->alterar();
    }
    header("Location: ../root.php?listacursoinscricao=true");exit;
?>