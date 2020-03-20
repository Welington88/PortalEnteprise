<?php session_start();//inicio da sessao ?>
<?php if(isset($_SESSION['emails'])){
    
}else {
    header("Location: ../login.php?acesso='logar'");exit;
} 
?>
<?php require_once '../_model/classaluno.php';
	require_once '../_model/UrlDb.php';
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
    if(isset($_SESSION['emails'])){
        $usuario = explode(" ", $aluno->getNome());
        echo "<h5 id=usuario>Usuário Logado=> $usuario[0] </h5>";} 
   ?>
    <?php if(isset($_SESSION['curso'])){
    require_once '../_model/classcursos.php';
    try {
        $conexaoCurso = new \PDO($dsn, $username, $passwd);//cria conexão com banco de dadosX 
    } catch (\PDOException $ex) {
        die('Não foi possível estabelecer '
        . 'conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());
    }
    $curso = new Cursos($conexaoCurso);
    $idc = $_SESSION['curso'];
    $resultadoCurso = $curso->find($idc);
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
    require_once '../_model/classaluno.php';
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
    }
    //incio do banco de dados
    if(isset($_REQUEST['curso'])){
        $idcurso = trim(strip_tags($_REQUEST['curso']));
    }else{
    $idcurso = trim(strip_tags($_SESSION['curso']));}
    $idaluno = trim(strip_tags($_SESSION['ids']));
    $statuspgto = "PENDENTE";
    $chave = $idcurso ."_".$idaluno;
    //incio do banco de dados
    require_once '../_model/classinscricao.php';
    try {
        $conexaoInscricao= new \PDO($dsn, $username, $passwd);//cria conexão com banco de dadosX 
    } catch (\PDOException $ex) {
        die('Não foi possível estabelecer '
        . 'conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());
    }
    $inscricao = new Inscricao($conexaoInscricao);
    //$resultado = $aluno->find($_REQUEST['id']);
    $inscricao->setIdcurso($idcurso);
    $inscricao->setIdaluno($idaluno);
    $inscricao->setStatuspgto($statuspgto);
    $inscricao->setChave($chave);
    $resultinscr = $inscricao->find($idaluno,$idcurso);
    $consultaid = $resultinscr['idaluno'];
    $consultachave = $resultinscr['chave'];
    if ($chave == $consultachave){
        header("location: ../consulta.php?ninscricao=false");exit;
    }
    $vagas = $curso->getVagas();
    if($vagas>0 and $chave !=$consultachave){
        $inscricao->inserir();
        $vagas--;
        $curso->setVagas($vagas);
        $curso->getVagas();
        echo $vagas. " " . $idcurso;
        $curso->numvagas($idcurso,$vagas);
        echo $nome = $aluno->getNome()."<br/>";
        echo $email = $aluno->getEmail()."<br/>";
        echo $curso = $curso->getNomeCurso();
        $conteudo = "Inscrição Realizada com Sucesso Portal Enterprise\n\n";
        $conteudo.= "Curso.:" . $curso ."\n";
        $conteudo.= "Aluno.: ". $nome ."\n";
        $conteudo.= "Login.: ". $email ."\n";
        $to = $email . ";welington_marquezini88@live.com;cintia@damataleo.com.br";
        $assunto = "Inscrição Portal Enterprise " . $curso;
        $mensagem = $conteudo;
        $header = "header: from:welington_marquezini88@live.com";
        mail($email,$assunto,$mensagem); 
        mail($email,$assunto,$mensagem,$header);
	@mail($email,$assunto,$mensagem,$header);
        //@mail($to,$assunto,$mensagem,$header);//@ faz ignorar o email caso de erro
        mail($to,$assunto,$mensagem,$header);
        header("location: login.php?cadastro='ok'");
       //header("Refresh: 5, usuario.php");
    }
    header("Location: ../consulta.php?inscricao=true");exit;   
    // fim de bando de dados*/
    ?>    