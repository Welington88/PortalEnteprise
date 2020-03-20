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
			if($w[0] == $_SESSION['emails']){
				$exect = true;
			} 
			if(!$exect){ 
				header("Location: ../usuario.php?acesso='negado'");exit;
			}
		//Root
    }else{
        header("Location: ../login.php?acesso='negado'");exit;
    }

    require_once '../_model/classcursos.php';
    try {
        $conexaoCurso = new \PDO($dsn, $username, $passwd);//cria conexão com banco de dadosX 
    } catch (\PDOException $ex) {
        die('Não foi possível estabelecer '
        . 'conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());
    }
    $curso = new Cursos($conexaoCurso);
    if($exect){
        $curso->deletar($_REQUEST['id']);
    }
    header("Location: ../root.php?listacurso=true");exit;
?>

