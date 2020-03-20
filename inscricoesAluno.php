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
}else{
    header("Location: login.php?acesso='negado'");exit;
}
if(isset($_SESSION['cadastro'])){
    unset($_SESSION['cadastro']);
    header("location: usuario.php?pricadastro=true");exit;
}
?>
<?php require_once "./header.php"; ?>
<?php require_once "./menu.php"; ?>
<?php     
    //incio do banco de dados
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
    $idaluno = $_SESSION['ids'];
    $resultado = $inscricao->inscrAluno($idaluno);
?>
<hgroup class="pagina">
<h3>Enterprise >> Login >> Usuário >> Consulta Inscrições</h3>
<h1><i class="fas fa-id-badge"></i> &nbsp;&nbsp;Consulta Inscrições<br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<a href="usuario.php"><i class="fas fa-arrow-circle-left"></i>
    &nbsp;&nbsp;Voltar</a></h1>
</hgroup>
<?php if(!isset($_REQUEST['alterar'])):?>
<div class="texto">
    <table id="tabelaInsc"><tr>
            <td><b>Nº de Inscrição</b></td><td><b>Nome Curso</b></td><td><b>Área do Aluno</b></td></tr>
    <?php        
        foreach ($resultado as $aluno){
        echo "<tr><td><b>" .$aluno['idinscricao']."</b></td>"
               . "<td>".$aluno['descricao']   ."</td>"
               . "<td><b><a href='consulta.php?curso=".$aluno['idcurso']
               ."'> Acessar Inscrição <i>(Área do Aluno)</i>  </a></b></td></tr>";
        }
    ?>
    </table>
</div>
<?php endif;?>
<?php require_once "./footer.php"; ?>