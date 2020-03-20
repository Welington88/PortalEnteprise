<?php
    session_start();
    unset($_SESSION['logado']);
    unset($_SESSION['nome']);
    unset($_SESSION['emails']);
    unset($_SESSION['senhas']);
    unset($_SESSION['curso']);
    unset($_SESSION['ids']);
    unset($_SESSION['redirecionar']);
    unset($_SESSION['inscricao']);
    unset($_SESSION['alunoup']);
    unset($_SESSION['nomeArq']);
    
    if(isset($_REQUEST['inserir'])){
        header("location: ../cadastro.php?inserir='nao'");exit;
    }
    header("location: ../login.php");
?>

