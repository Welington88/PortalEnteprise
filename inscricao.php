<?php session_start();//inicio da sessao ?>
<?php require_once "./header.php"; ?>
<?php require_once "./menu.php"; ?>
<?php if(isset($_SESSION['emails'])){
    
}else {
    $_SESSION['redirecionar'] = 1;
    header("Location: login.php?acesso='logar'&excel='voltar'");exit;
} 
?>
<hgroup class="pagina">
    <h3>Enterprise >> Cursos & Treinamentos>> Inscrição</h3><br/>
    <h1><i class="fas fa-laptop-code"></i>&nbsp;&nbsp;Ficha de Inscrição<br/><br/>
  &nbsp;&nbsp; &nbsp;&nbsp;<a href="usuario.php"><i class="fas fa-arrow-circle-left"></i>Voltar</a></h1>
<?php require_once './_model/classaluno.php';
        require_once './_model/UrlDb.php';
        $url = new UrlBD();
        $dsn = $url->getDsn();
        $username = $url->getUsername();
        $passwd = $url->getPasswd();

    try {$conexao= new \PDO($dsn, $username, $passwd);} catch (\PDOException $ex) {
        die('Não foi possível estabelecer conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());}
    $aluno = new aluno($conexao);
    $resultado = $aluno->find($_SESSION['ids']);
    $aluno->setId($resultado['idaluno']);
    $aluno->setNome($resultado['nomealuno']);
   ?>
</hgroup>
<div class="texto">
    <?php if(isset($_SESSION['curso'])){
    require_once './_model/classcursos.php';
    try {
        $conexaoCurso = new \PDO($dsn, $username, $passwd);//cria conexão com banco de dadosX 
    } catch (\PDOException $ex) {
        die('Não foi possível estabelecer '
        . 'conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());
    }
    $curso = new Cursos($conexaoCurso);
    $id = $_SESSION['curso'];
    $resultadoCurso = $curso->find($id);
    $curso->setNomeCurso($resultadoCurso['nomecurso']);
    $curso->setDescricao($resultadoCurso['descricao']);
    $curso->setInstrutor($resultadoCurso['instrutor']);
    $curso->setPrevisao($resultadoCurso['previsao']);
    $curso->setCarga($resultadoCurso['carga']);
    $curso->setTotaula($resultadoCurso['totaulas']);
    $curso->setValor($resultadoCurso['valor']);
    $curso->setVagas($resultadoCurso['vagas']);
    }
    if(isset($_SESSION['emails'])){
        //incio do banco de dados
    require_once './_model/classaluno.php';
    try {
        $conexao= new \PDO($dsn, $username, $passwd);//cria conexão com banco de dadosX 
    } catch (\PDOException $ex) {
        die('Não foi possível estabelecer '
        . 'conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());
    }
    $aluno = new aluno($conexao);
    //$resultado = $aluno->find($_REQUEST['id']);
    $resultado = $aluno->find($_SESSION['ids']);
    $aluno->setId($resultado['idaluno']);
    $aluno->setNome($resultado['nomealuno']);
    $aluno->setCpf($resultado['cpf']);
    $aluno->setRg($resultado['rg']);
    $aluno->setEmail($resultado['email']);
    $aluno->setNascimento($resultado['nascimento']);
    $aluno->setSexo($resultado['sexo']);
    $aluno->setEscolaridade($resultado['escolaridade']);
    $aluno->setProfissao($resultado['profissao']);
    $aluno->setRua($resultado['rua']);
    $aluno->setN($resultado['n']);
    $aluno->setComplemento($resultado['complemento']);
    $aluno->setBairro($resultado['bairro']);
    $aluno->setCidade($resultado['cidade']);
    $aluno->setUf($resultado['uf']);
    $aluno->setCep($resultado['cep']);
    $aluno->setTel($resultado['tel']);
    $aluno->setCel($resultado['cel']);
    $aluno->setSenha($resultado['senha']);
    
    $nome = utf8_encode($resultado['nomealuno']);
    $cpf = $resultado['cpf'];
    $rg = $resultado['rg'];
    $mail = $resultado['email'];
    $nascimento = $resultado['nascimento'];
    $sexo = $resultado['sexo'];
    $escolaridade = $resultado['escolaridade'];
    $profissao = $resultado['profissao'];
    $rua = $resultado['rua'];
    $n = $resultado['n'];
    $complemento = $resultado['complemento'];
    $bairro = $resultado['bairro'];
    $cidade = $resultado['cidade'];
    $uf = $resultado['uf'];
    $cep = $resultado['cep'];
    $tel =  $resultado['tel'];
    $cel = $resultado['cel'];
    $senha = $resultado['senha'];
    }
    ?>
    <table  id="tabelaspec">
        <tr>
            <td> <?php if(isset($_SESSION['curso'])){ echo "Evento: <b>". $curso->getDescricao() ."</b>";}?> </td>
            <td> <?php if(isset($_SESSION['curso'])){ echo "Carga Horária: <b>" .$curso->getCarga()." HORAS</b>";}?></td>
        </tr>
        <tr>
            <td> <?php if(isset($_SESSION['curso'])){ 
                echo "Instrutor (a): <b>". ucfirst($curso->getInstrutor())."</b>";}?> </td>
            <td> <?php if(isset($_SESSION['curso'])){ echo "Previsão de Início: <b>" .$curso->getPrevisao();}?></td>
        </tr>
    </table>
    <h1 class="center">Confirme Seus Dados</h1>
    <table id="tabelaspec">
        <tr>
            <td colspan="3">Razão Social/Nome: <b><?php if(isset($_SESSION['emails'])){ echo $aluno->getNome();} ?></b></td>
        </tr>
        <tr>
            <td colspan="3">CNPJ/CPF: <b><?php if(isset($_SESSION['emails'])){ echo $aluno->getCpf();} ?></b></td>
        </tr>
        <tr>
            <td>Endereço: <b><?php if(isset($_SESSION['emails'])){ echo $aluno->getRua();} ?></b> </td>
            <td>Nº: <b><?php if(isset($_SESSION['emails'])){ echo $aluno->getN();} ?></b></td>
            <td>Comple: <b><?php if(isset($_SESSION['emails'])){ echo $aluno->getComplemento();} ?></b></td>
        </tr>
        <tr>
            <td>Bairro: <b><?php if(isset($_SESSION['emails'])){ echo $aluno->getBairro();} ?></b> </td>
            <td colspan="2">Cidade: <b><?php if(isset($_SESSION['emails'])){ echo $aluno->getCidade();} ?></b> </td>
        </tr>
        <tr>
            <td>CEP: <b><?php if(isset($_SESSION['emails'])){ echo $aluno->getCep();} ?></b> </td>
            <td colspan="2">Estado: <b><?php if(isset($_SESSION['emails'])){ echo $aluno->getUf();} ?></b> </td>
        </tr>  
        <tr>
            <td>Telefone: <b><?php if(isset($_SESSION['emails'])){ echo $aluno->getTel();} ?></b> </td>
            <td colspan="2">Celular: <b><?php if(isset($_SESSION['emails'])){ echo $aluno->getCel();} ?></b> </td>
        </tr>
        <tr>
            <td>E-mail: <b><?php if(isset($_SESSION['emails'])){ echo $aluno->getEmail();} ?></b></td>
            <td colspan="2">Cargo: <b><?php if(isset($_SESSION['emails'])){ echo $aluno->getProfissao();} ?></b></td>
        </tr>
    </table>
    
    <form id="formInscricao" name="formInscr" method="post" action="inscricao.php" 
          onsubmit="return validaInscricao()" >
    <p> <font size='2'>
        <label for="cValidar"><input type="checkbox" name="tValidar" id="cValidar" 
                                                    value="inscrever" />
           <?php if(isset($_REQUEST['inscrever'])){}else {echo "<span id='avisoInscricao'>";} ?> 
                Estou ciente e quero me inscrever no <i><b>Curso 
                <?php if(isset($_SESSION['curso'])){ 
                    echo utf8_encode(utf8_decode($curso->getNomeCurso())).
                    ", com o total de ". $curso->getTotaula() . " aulas presenciais" .
					", Carga Horária de " . $curso->getCarga() . " Horas " .
                    ", Data de início no <b>" . $curso->getPrevisao()."</b>".
					" no Valor de <b>R$ ". number_format($curso->getValor(),2,",",".")."</b>";}?>
                    </b></i> <?php if (isset($_REQUEST['inscrever'])){}else {echo "</span>";} ?> .</label></font> </p>
    <p>
	<!--<button name="tEnviar" type="submit" class="enviar radius" onsubmit="validarInscricao()">Enviar<i class="fas fa-arrow-circle-right"></i></button>--> 
	<input name="tEnviar" type="submit" class="enviar radius" value="Enviar"/>
	</p>
    </form>
    <br/>
</div>
<?php require_once "./footer.php"; ?>
<?php 
if(isset($_REQUEST['tValidar'])){
    if($nome != "" && $cpf != "" && $rg != "" && $mail != "" && $profissao != ""
       && $rua != "" && $bairro != "" && $cidade != "" && $cep != ""){
       header("Location: _controller/carrinho.php?curso=".$_SESSION['curso']);exit;} 
    else {
       $_SESSION['redirecionar'] = 0;
       header("Location: usuario.php?alterar=true&completarcadastro=true");exit;     
    }
}else if(isset ($_REQUEST['curso'])){}else{
   echo '<script  type="text/javascript" >'
    . 'alert("Falta preencher o termo de contrato!\n'
    . 'Favor verificar campo em vermelho termo de contrato!");</script>';
}
?>