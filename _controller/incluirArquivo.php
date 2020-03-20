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
	//Root
    }else{
        header("Location: ../login.php?acesso='negado'");exit;
    }
    require_once '../_model/classarquivos.php';
    //conexao
    try {
        $conexao = new \PDO($dsn, $username, $passwd);//cria conexão com banco de dadosX 
    } catch (\PDOException $ex) {
        die('Não foi possível estabelecer '
        . 'conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());
    }
    
    if (isset($_FILES['arquivo'])){
        $pos = strpos($_FILES['arquivo']['name'],".") - strlen($_FILES['arquivo']['name']);
        $extensao = substr($_FILES['arquivo']['name'], $pos);
        $novo_nome = $_SESSION['nomeArq'] . "_" . $_REQUEST['tipo'] . "_" .time().$extensao;
        $diretorio = "../_upload/";
        move_uploaded_file($_FILES['arquivo']['tmp_name'],$diretorio.$novo_nome);
    }
    $arquivo = new Arquivos($conexao);
    $arquivo->setArquivo($novo_nome);
    $data = date("d/m/Y");
    $arquivo->setData($data);
    $arquivo->setIdaluno($_SESSION['alunoup']);
    $arquivo->setIdcurso($_SESSION['curso']);
    $arquivo->setInscricao($_SESSION['inscricao']);
    $arquivo->setTipo($_REQUEST['tipo']);
    //var_dump($arquivo);
    
    $arquivo->inserir();
    header("Location: ../upload.php?upload=true");exit;
