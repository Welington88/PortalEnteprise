<?php 
ob_start();//inicio da sessao 
session_start();//inicio da sessao 
if((isset($_SESSION['emails'])) && isset($_SESSION['senhas'])){//se não exitir
    if(isset($_SESSION['redirecionar'])){
        switch ($_SESSION['redirecionar']){ //se for completa cadastro volte para inscrição
        case 0:    
            unset($_SESSION['redirecionar']);
            $_SESSION['redirecionar'] = 1;
            break;
    }}
}else{
    header("Location: ../login.php?acesso='negado'");exit;
}
?>
<?php
    //incio do banco de dados
    $email1 = trim(strip_tags($_REQUEST['tMail']));
    $email2 = trim(strip_tags($_REQUEST['tCMail2']));
    if((!isset($_REQUEST['root'])) && isset($_REQUEST['tCSenha']) 
            && isset($_REQUEST['tCSenha2'])){
        $senha1 = strip_tags($_REQUEST['tCSenha']);
        $senha2 = strip_tags($_REQUEST['tCSenha2']);
    }  else {
        $senha1 = "";
        $senha2 = "";
    }
    //incio do banco de dados
    require_once '../_model/classaluno.php';
    require_once '../_model/UrlDb.php';
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
    $aluno = new aluno($conexao);
    //$resultado = $aluno->find($_REQUEST['id']);
    if(isset($_REQUEST['root'])){
        $resultado = $aluno->find($_REQUEST['tId']);
        echo $id = $_REQUEST['tId'];
    }else {
        $resultado = $aluno->find($_SESSION['ids']);
        echo $id = $_SESSION['ids'];
    }
    echo $nome = ucwords(strtolower(trim(strip_tags($_REQUEST['tNome']))));
    echo $cpf = trim(strip_tags($_REQUEST['tCPF']));
    echo $rg = strtoupper(trim(strip_tags($_REQUEST['tRG'])));
    echo $mail = strtolower(trim(strip_tags($_REQUEST['tMail'])));
    echo $nascimento = trim(strip_tags($_REQUEST['tNasc']));
    /*$data = $nascimento;
    $vetor = explode("/", $data);
    $dia = $vetor[0];
    $mes = $vetor[1];
    $ano = $vetor[2];
    $data = $ano."-".$mes ."-".$dia;*/
    echo $sexo = trim(strip_tags($_REQUEST['tSexo']));
    echo $escolaridade = ucwords(strtolower(trim(strip_tags($_REQUEST['tEsc']))));
    echo $profissao = ucwords(strtolower(trim(strip_tags($_REQUEST['tProf']))));
    echo $rua = ucwords(strtolower(trim(strip_tags($_REQUEST['tRua']))));
    echo $n = strtoupper(trim(strip_tags($_REQUEST['tNum'])));
    echo $complemento = ucwords(strtolower(trim(strip_tags($_REQUEST['tComp']))));
    echo $bairro = ucwords(strtolower(trim(strip_tags($_REQUEST['tBairro']))));
    echo $cidade = ucwords(strtolower(trim(strip_tags($_REQUEST['tCid']))));
    echo $uf = strtoupper(trim(strip_tags($_REQUEST['tEst'])));
    echo $cep = ucwords(strtolower(trim(strip_tags($_REQUEST['tCep']))));
    echo $tel =  trim(strip_tags($_REQUEST['tTel']));
    echo $cel = trim(strip_tags($_REQUEST['tCel']));
    if((!isset($_REQUEST['root'])) && isset($_REQUEST['tCSenha'])){
        echo $senha = trim(trim(strip_tags($_REQUEST['tCSenha']))); 
    }  else {
        $senha = "";
    }
    $aluno->setId($id);
    $aluno->setNome($nome);
    $aluno->setCpf($aluno->arrumarCPF($cpf));
    $aluno->setRg($rg);
    $aluno->setEmail($mail);
    $aluno->setNascimento($nascimento);
    $aluno->setSexo($sexo);
    $aluno->setEscolaridade($escolaridade);
    $aluno->setProfissao($profissao);
    $aluno->setRua($rua);
    $aluno->setN($n);
    $aluno->setComplemento($complemento);
    $aluno->setBairro($bairro);
    $aluno->setCidade($cidade);
    $aluno->setUf($uf);
    $aluno->setCep($cep);
    $aluno->setTel($tel);
    $aluno->setCel($cel);
    if((!isset($_REQUEST['root'])) && (!empty($senha)) && (!empty($senha2))){ //se for root alterando
        echo "setar a senha";
        $aluno->setSenha(password_hash($senha, PASSWORD_DEFAULT));
    }	
    
    //Root
    require_once '../_model/UrlDb.php';
    $exect = false;
    $w = $url->getRoot();
    foreach ($w as $e){
            if($e == $_SESSION['emails']){
                    $exect = true;
            }
    }
    //Root
                
   if ($exect && isset($_REQUEST['root'])){
        $aluno->alterarRoot();
        header("Location: ../listaAlunos.php");exit;
    } elseif($senha1==$senha2 && 
       $email1==$email2 && (!empty($cpf)) && (empty($senha1)) && (empty($senha2))
           && (!empty($email1)) && (!empty($email2))){
        echo $_SESSION['ids'];
        echo $_SESSION['emails'];
        echo "<br/>entrou";
        $aluno->alterar();
        header("Location: ../usuario.php?alterado=true");exit;   
    } elseif ($senha1==$senha2 && $email1==$email2 
       && (!empty($senha1)) && (!empty($senha2))) {
        $aluno->alterarSenha();
        echo "<br/> id " . $aluno->getId();
        echo "<br/> senha" . $aluno->getSenha();
        echo "<br/>entrou no senha";
        header("Location: ../usuario.php?alterarSenha=true");exit;   
    }else{
       header("location: ../login.php?nlogin='true'");
    }
    // fim de bando de dados*/
?>