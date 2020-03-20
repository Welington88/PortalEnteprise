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
<?php require_once "./menu.php"; ?>
<hgroup class="pagina">
<h3>Enterprise >> Login >> Usuário >> Root >> Lista de Alunos Cadastrados</h3>
<h1>Intranet Lista de Alunos Cadastro</h1>
   <h5><a href="usuario.php" >Lougout(Sair da Intranet)</a></h5>
<div class="texto">
    <!--<h5 class="direita"><a href="login.php" >
        <?php if(isset($_SESSION['emails'])){
            echo "Usuário Logado => " . $_SESSION['nome']."<br/><br/><br/><br/>";} 
        ?> </a> </h5>
<h1><b>Lista Todos os Alunos Cadastrados:</b></h1><br/><br/><br/>
<iframe src="tabelaAlunos.php" name="janela" id="frame-spec"></iframe>-->
<h5><a href="root.php" ><i class="fas fa-arrow-circle-left"></i>Voltar</a></h5>
<form method="POST" class="formmenu" name="formList" action="listaAlunos.php" >
<?php //paginacao na tabela php
     $intervalo = 10; 
     $tt = count($resultado);
     $valor = $tt/$intervalo;
     $fracionar = ceil ($valor);
     if (isset($_REQUEST['opcao'])) {
        $opcao = ($_REQUEST['opcao']-1);
     } else {
        $opcao = 0;// colocar request aqui
     }
     
     
     $inicio = $opcao * $intervalo;
     $fim = $inicio + $intervalo;
     /*echo "Qtd Francionar " . $fracionar . " Total "  . $tt;
     echo "<br/>Inicio " . $inicio . " Fim " . $fim;*/
     for ($i=0; $i < $fracionar ; $i++) { 
         $w = $i+1;
         echo " <input name='opcao' type='submit' class='enviar radius' value='$w' /> ";
     }
?>
</form>
<table id='tabelaspec' ><tr><td><b>Nome do Curso</b></td><td><b>CPF</b></td>
    <!--<td><b>E-mail</b></td><td><b>Tel.</b></td>--><td><b>Cel.</b></td><td><b>Senha</b></td><td><b>Excluir</b></td></tr>
        <?php         
           foreach ($resultado as $key => $a){
                if($key>=$inicio && $key<=$fim){//paginação
                    echo '<tr><td ><a href="alterarCadastro.php?id=' . $a['idaluno'] . '">'. $a['nomealuno'] . '</a></td>';
                    echo '<td>'. $a['cpf'] . '</td>';
                    //echo '<td >'. $a['email'] . '</td>';
                    //echo '<td>'. $a['tel'] . '</td>';
                    echo '<td>'. $a['cel'] . '</td>';
                    echo '<td><b><a href="_controller/resetSenha.php?id='. $a['idaluno'] . '">Resetar Senha</a></b></td>';
                    echo '<td><b><a href="_controller/deletarAluno.php?id='. $a['idaluno'] . '"> Excluir Aluno</a></b></td></tr>';
                }
            }
        ?>
</table>
</div>
</hgroup>
</header>
<?php require_once "./footer.php"; ?>