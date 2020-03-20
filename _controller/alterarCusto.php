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
    require_once '../_model/classcustos.php';
	//conexao
    try {
        $conexao = new \PDO($dsn, $username, $passwd);//cria conexão com banco de dadosX 
    } catch (\PDOException $ex) {
        die('Não foi possível estabelecer '
        . 'conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());
    }
    $custos = new Custos($conexao);
    $custos->setIdcusto($_REQUEST['tCusto']);
    $custos->setIdcurso($_REQUEST['tCurso']);
    $custos->setProduto($_REQUEST['tProd']);
    $qtd = $_REQUEST['tQtd'];
    $custos->setQtd($qtd);
    $custos->setUn($_REQUEST['tUn']);
    $valorPreco = $_REQUEST['tPr'];
    $valorPreco = str_replace(",",".",$valorPreco);
    $custos->setValor($valorPreco);
    $valorTT = $_REQUEST['tTt'];
    $valorTT = $valorTT = $valorPreco*$qtd;
    $custos->setTotal($valorTT);
    if ($exect){
        $custos->alterar();
    }
    header("Location: ../custos.php");exit;
?>