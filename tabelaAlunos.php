<?php 
ob_start();//inicio da sessao 
session_start();//inicio da sessao 
if((isset($_SESSION['emails'])) && isset($_SESSION['senhas'])){//se não exitir
    if(isset($_SESSION['redirecionar'])){
        switch ($_SESSION['redirecionar']){
        case 1:    
            unset($_SESSION['redirecionar']);
            header("location: inscricao.php");exit;
            break;
    }}
    	//Root
		require_once './_model/UrlDb.php';
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
			header("Location: usuario.php?acesso='negado'");exit;
		}
		//Root
}else{
    header("Location: login.php?acesso='negado'");exit;
}
?>
<?php
    require_once './_model/classaluno.php';
	//conexão
    try {
        $conexaoCurso = new \PDO($dsn, $username, $passwd);//cria conexão com banco de dadosX 
    } catch (\PDOException $ex) {
        die('Não foi possível estabelecer '
        . 'conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());
    }
    $aluno = new Aluno($conexaoCurso);
    $resultado = $aluno->listar();
?>
<?php require_once "./header.php"; ?>
<div class="texto">
<table id='tabelaroot' ><tr><td><b>Nome do Curso</b></td><td><b>CPF</b></td>
        <td><b>E-mail</b></td><td><b>Tel.</b></td><td><b>Cel.</b></td><td><b>Senha</b></td><td><b>Excluir</b></td></tr>
        <?php        
           foreach ($resultado as $a){
                echo '<tr><td class="ce"><a href="alterarCadastro.php?id=' . $a['idaluno'] 
                        . '">'. $a['nomealuno'] . '</a></td>';
                echo '<td>'. $a['cpf'] . '</td>';
                echo '<td class="ce">'. $a['email'] . '</td>';
                echo '<td>'. $a['tel'] . '</td>';
                echo '<td>'. $a['cel'] . '</td>';
                echo '<td><b><a href="resetSenha.php?id='. $a['idaluno'] . '">Resetar Senha</a></b></td>';
                echo '<td><b><a href="_controller/deletarAluno.php?id='. $a['idaluno'] . '"> Excluir Aluno</a></b></td></tr>';
            }
        ?>
    </table>
</div>