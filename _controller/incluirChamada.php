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

    require_once '../_model/classchamada.php';
    //conexão
	try {
        $conexaoCurso = new \PDO($dsn, $username, $passwd);//cria conexão com banco de dadosX 
    } catch (\PDOException $ex) {
        die('Não foi possível estabelecer '
        . 'conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());
    }
    $chamada = new Chamada($conexaoCurso);
    $qtd = $_REQUEST['qtd'];
    $curso = $_REQUEST['curso'];
    $aula = $_REQUEST['aula'];
    $data = date("Y-m-d");
    for ($i=0; $i < $qtd; $i++) { 
        $inscricao = $_REQUEST['inscr' . $i];
        $id = $_REQUEST['id' . $i];
        $tipo = $_REQUEST['status' . $i];
        $chamada->setInscricao($aula . $inscricao);
        $chamada->setAula($aula);
        $chamada->setTipo($tipo);
        $chamada->setDia($data);
        if ($exect){
            $n = $chamada->find($aula . $inscricao);
            $alt_ou_incl = $n[0]['Inscricao'];
            if ($alt_ou_incl==0) {
                $chamada->inserir();
                echo "inserir"; 
            }else {
                $chamada->alterar();
            }
            
        }
    }
    header("Location: ../chamada.php?listachamada=true");exit;
?>