<?php
    //incio do banco de dados
    $email = trim(strip_tags($_REQUEST['tEmail']));
    $senha1 = strip_tags($_REQUEST['tCSenha']);
    $senha2 = strip_tags($_REQUEST['tCSenha2']);
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
    if ($senha1==$senha2 && (!empty($email)) && (!empty($senha1)) 
            && (!empty($senha2))&& ($aluno->contarEmail($email)>0)) {
        $aluno->resetarSenhaEmail($email,$senha1);
        echo "<br/> id " . $email;
        echo "<br/> senha" . $senha1;
        echo "<br/>entrou no senha";
        header("Location: ../lembrar.php?mostrar=true");exit;   
    }else{
       header("location: ../lembrar.php?negado='true'");
    }
    // fim de bando de dados*/
?>