<?php session_start();//inicio da sessao 
 if(isset($_REQUEST['curso'])){
     $_SESSION['curso'] = $_REQUEST['curso'];
 }
?>
<?php require_once "./header.php"; ?>
<?php require_once "./menu.php"; ?>
<?php 
if(isset($_REQUEST['curso'])){
            $_SESSION['curso'] = $_REQUEST['curso'];
            header("Location: consulta.php");exit;
    }
if(isset($_SESSION['emails'])){    
}else {
    header("Location: login.php?acesso='logar'");exit;
} 
?>
<?php
    //incio do banco de dados
    $idcurso = trim(strip_tags($_SESSION['curso']));
    $idaluno = trim(strip_tags($_SESSION['ids'])); 
    //incio do banco de dados
    if(isset($_SESSION['curso'])){
    if(isset($_SESSION['emails'])){
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
    //$resultado = $inscricao->find($_REQUEST['id']);
    $inscricao->setIdcurso($idcurso);
    $inscricao->setIdaluno($idaluno);
    $resultado = $inscricao->find($idaluno,$idcurso);
    $consultaid = $resultado['idaluno'];
    $inscricao->find($consultaid,$idcurso);
    $statuspgto = $resultado['statuspgto'];
    $inscricao->setStatuspgto($statuspgto);
    $inscricao->setNomeCurso($resultado['nomecurso']);
    $inscricao->setDescricao($resultado['descricao']);
    $inscricao->setInstrutor($resultado['instrutor']);
    $inscricao->setPrevisao($resultado['previsao']);
    $inscricao->setCarga($resultado['carga']);
    $inscricao->setTotaula($resultado['totaulas']);
    $inscricao->setValor($resultado['valor']); 
    //incio do banco de dados
    require_once './_model/classaluno.php';
    //$resultado = $inscricao->find($_REQUEST['id']);
    $inscricao->setId($resultado['idaluno']);
    $inscricao->setNome($resultado['nomealuno']);
    $inscricao->setCpf($resultado['cpf']);
    $inscricao->setRg($resultado['rg']);
    $inscricao->setEmail($resultado['email']);
    $inscricao->setNascimento($resultado['nascimento']);
    $inscricao->setSexo($resultado['sexo']);
    $inscricao->setEscolaridade($resultado['escolaridade']);
    $inscricao->setProfissao($resultado['profissao']);
    $inscricao->setRua($resultado['rua']);
    $inscricao->setN($resultado['n']);
    $inscricao->setComplemento($resultado['complemento']);
    $inscricao->setBairro($resultado['bairro']);
    $inscricao->setCidade($resultado['cidade']);
    $inscricao->setUf($resultado['uf']);
    $inscricao->setCep($resultado['cep']);
    $inscricao->setTel($resultado['tel']);
    $inscricao->setCel($resultado['cel']);
    $inscricao->setSenha($resultado['senha']);
    $inscricao->setDatainscricao($resultado['datainscricao']);
    $inscricao->setInscricao($resultado['idinscricao']);
    $inscricao->setDesconto($resultado['desconto']);
    $inscricao->setChave($resultado['chave']);
    }}
    
    $listaArquivo = $inscricao->listarArquivos($inscricao->getId());
?>    
<hgroup class="pagina">
    <h3>Enterprise >> Cursos & Treinamentos>> Área do Aluno</h3><br/>
    <h2>&nbsp;&nbsp;&nbsp;&nbsp;<a href="inscricoesAluno.php"><i class="fas fa-arrow-circle-left"></i>Voltar</a></h2>
    <h1 class="center"><i class="fas fa-user-graduate"></i>Área do Aluno</h1>
<?php require_once './_model/classaluno.php';
    try {$conexao= new \PDO($dsn, $username, $passwd);} catch (\PDOException $ex) {
        die('Não foi possível estabelecer conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());}
    $aluno = new aluno($conexao);$resultado = $aluno->find($_SESSION['ids']);$aluno->setId($resultado['idaluno']);$aluno->setNome($resultado['nomealuno']);
    if(isset($_SESSION['emails'])){
        $usuario = explode(" ", $aluno->getNome());
        //echo "<h5 id=usuario>Usuário Logado=> $usuario[0] </h5>";
        }
        date_default_timezone_set('America/Sao_Paulo');
        $dataHoraAtual = date('Y-m-d H:i');?>
</hgroup>
<div class="texto">
    <article class="servico bg-white radius">
    <div class="inner">
        <h4 class="center"><i class="fas fa-info-circle"></i> Informações do Curso:</h4>
        <ul class="formmenu consulta">
            <form method="get" class="formmenu" action="consulta.php" >
            <label for="cEst">Cursos: </label>
            <select name="curso" id="curso">
            <optgroup label="curso">
            <?php  $idaluno = $_SESSION['ids'];
                   $nCursos = $inscricao->inscrAluno($idaluno);
                 foreach ($nCursos as $keyc1 => $dados){
                     if ($dados['idcurso']==$_SESSION['curso']) {
                       $r = "selected";  
                    } else {
                        $r = "";  
                    }
                    echo "<option value='" . $dados['idcurso']
                    . "' $r >" . $dados['nomecurso'] . "</option>"; 
                }
            $matriz[count($matriz)-1]; //parei aqui
            /*foreach ($matriz as $arr) { //maior valor em uma matriz
                var_dump($arr);
                if (!isset($max) or max($arr) > $max) {
                    $max = max($arr);
            }
            }           echo "<h1>O maior valor encontrado foi " . $max . "</h1>";*/?>
            </optgroup>
            </select>
            <input name="tEnviar" type="submit" class="enviar radius" value="Buscar"/>
            <i class="fas fa-arrow-circle-right"></i>
            </form>
            <li><a href="usuario.php"><?php echo "Inscrição Nº: <span class='valor'>".$inscricao->getInscricao()."</span>"; ?></a></li>
            <li><?php if(isset($_SESSION['curso'])){ echo "Evento: <b>". $inscricao->getDescricao() ."</b>";}?></li>
            <li><?php if(isset($_SESSION['curso'])){ echo "Carga Horária: <b>" .$inscricao->getCarga()." HORAS</b>";}?></li>
            <li><?php if(isset($_SESSION['curso'])){ 
            echo "Instrutor (a): <b>". ucfirst($inscricao->getInstrutor())."</b>";}?></li>
            <li><?php if(isset($_SESSION['curso'])){ echo "Previsão de Início: <b>" .$inscricao->getPrevisao();}?></li>
        </ul>
    </div>
    </article>
    <article class="servico bg-white radius">
     <div class="inner">
       <h4 class="center"><i class="fas fa-id-card"></i>Dados do Participante:</h4>
       <ul class="formmenu consulta">
           <li>Nome:<br/> <b><?php if(isset($_SESSION['emails'])){ echo $inscricao->getNome();} ?></b></li>
           <li>CPF: <b><?php if(isset($_SESSION['emails'])){ echo $inscricao->getCpf(); } ?></b></li>
           <li>Grau de escolaridade: <b><?php if(isset($_SESSION['emails'])){ echo $inscricao->getEscolaridade();} ?></b></li>
           <li>Formação profissional: <b><?php if(isset($_SESSION['emails'])){ echo $inscricao->getProfissao();} ?></b></li>
           <li>Data de Inscrição:<b> <?php echo $inscricao->getDatainscricao(); ?> </b></li>
           <li>e-mail: <b><?php if(isset($_SESSION['emails'])){ echo $inscricao->getEmail();} ?></b></li>
        </ul>
     </div>
    </article>
    <article class="servico bg-white radius">
    <div class="inner">
    <ul class="formmenu consulta">       
        <li><?php //informações do pgto
            if($statuspgto=="PAGO" || $statuspgto =="GRATUITO"){
                echo '<h4 class="center"><i class="fas fa-file-excel"></i> Arquivos do Aluno: <i class="fas fa-file-pdf"></i></h4>';
            }else{
                echo '<h4 class="center"><i class="fab fa-cc-visa"></i> Informações Pagamento: <i class="fab fa-cc-apple-pay"></i></h4>';
            }
            ?></li>
     <br/><h4><em>&nbsp &nbsp Apostilas - Exercícios - Provas - Trabalhos</em></h4>
         <?php $statuspgto = $inscricao->getStatuspgto();
                        require_once './_model/Arquivo.php'; //matriz
                        $exect = false;
                        $matriz = new Arquivo();
                        foreach ($matriz->getArquivos() as $keycurso => $keyaluno) {
                         if ($keycurso == $_SESSION['curso']) {
                             foreach ($keyaluno as $aluno => $arquivo) {
                                 if($aluno == $_SESSION['ids']){
                                        $caminho = $arquivo;
                                        $exect = true;
                                        break;
                                 }
                             }
                         }
                        }
                    //inicio area de trabalho
                    if ($statuspgto == "PAGO" || $statuspgto == "GRATUITO"){//if ($statuspgto != ""){
                         if ($inscricao->getIdcurso()>=1 && $inscricao->getIdcurso()<=7){ // cursos área de trabalho
                                    //basico
                                    echo '<li><a href="_tutorial/apostila_excel_basico.pdf" target="_blank">Apostila Básico!</a></li>'
                                    . '<li><a href="_tutorial/_Exercicios.zip">Excercícios Básico!</a></li>';
                                    if ($inscricao->getIdcurso()>=1 && $inscricao->getIdcurso()<=7 
                                        && $inscricao->getIdcurso()<>4) { // somente o curso avançado
                                       echo  '<li><a href="_tutorial/Apostila Excel Avançado.pdf" target="_blank">Apostila <font size="1">Avançado</font></a></li>'
                                            . '<li><a href="_tutorial/_Exercicios_avancado.zip" >Excercícios <font size="1">Avançado</font></a></li>'
                                            .'<li><a href="_download/AulaPB.zip">Arquivos <font size="1">PowerBI</font></a></li>'
                                            .'<li><a href="_download/powerbi/pb.html" target="_blank">Tutorial <font size="1">PowerBI</font></a></li>'; 
                                    }
                                    if ($inscricao->getIdcurso()==7
                                        && $dataHoraAtual >= "2019-06-03 15:00"
                                        && $dataHoraAtual <= "2019-06-03 17:00") { // prova básico
                                        echo '<!--<li><a href="_tutorial/Prova Excel Basico.pdf" target="_blank" >Prova Básico!</a></li>-->';
                                    }
                                    if ($inscricao->getIdcurso()==7
                                    && $dataHoraAtual >= "2019-12-08 08:00"
                                    && $dataHoraAtual <= "2019-12-08 10:00") {
                                        echo '<!--<li><a href="https://1drv.ms/xs/s!AmX8T1kewqnUmrZQwD2Uu-WU8s0kYA?wdFormId=%7B8CCB919F%2D5A43%2D4664%2D89C6%2D97B155A9600C%7D" target="_blank">Responder Prova (1ªParte)</a></li>-->'
                                        . '<li><a href="_tutorial/Prova_Excel_Avan2019_2.zip" >Baixar Prova (2ªParte)</a></li>';
                                    }
                                    if ($dataHoraAtual >= "2019-12-08 08:00" && 
                                        $dataHoraAtual <= "2019-12-08 12:00") {//upload
                                        //falta colocar aqui if com id do curso
                                        echo '<li><a href="upload.php?curso=' . $inscricao->getIdcurso()
                                            . '&aluno=' . $inscricao->getIdaluno() . '&inscricao='
                                            . $inscricao->getInscricao() .'"><em>UPLOAD</em> Arquivos!</a></li>';
                                    }
                                    if(count($listaArquivo)>0){ //arquivos
                                        foreach ($listaArquivo as $key => $keyaluno) {
                                            foreach ($keyaluno as $tipo => $valorMatriz) {
                                                if ($tipo=="arquivo" && $keyaluno['tipo']<>"Comprovante Pagamento") {
                                                   //arquivos do aluno
                                                    echo "<li><a href='_upload/". $valorMatriz . "'>". $keyaluno['tipo'] 
                                                    . " "  . $_SESSION['nome'] . "</a></li>";
                                                }
                                            }
                                        }
                                    }
                                    if($exect){ // provas antigas
                                        echo "<li><a href='_provas/". $caminho ."'>Correção de sua prova!!!</a></li>";}
                                }else {
                                    echo "<li><b>Ainda Não Existem Matérias<br/>Postadas para seu curso!!!</b></li>";
                                }//cursos 1 a 6
                    } //pago ou gratuito
                    else{
                        echo "<li><b>Ainda Não Existem Matérias<br/>Postadas para seu curso!!!</b></li>";
                    } //fim da area de trabalho
            ?>
    </ul> 
    </div>
    </article>
    <article class="servico bg-white radius">
               <?php 
                    if($statuspgto=="PAGO" || $statuspgto=="GRATUITO"){
                        echo "<a href='#'><img id='logoCurso' src='_imagens/logo.png' "
                        . "alt='Portal Enterprise' align='middle'/></a>";
                        //ead começa aqui
                        if ($idcurso>=1 && $idcurso<=7) {
                            echo  "<br/><h4><a href='ead.php'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                            . "Vídeo Aulas Extra - EAD</a></h4>";
                        }
                        if($idcurso==7 && $dataHoraAtual >= "2019-10-27 12:00"
                        && $dataHoraAtual <= "2020-02-28 00:59"){
                            echo  "<br/><h4><a href='check.php'>&nbsp;&nbsp;&nbsp;&nbsp;"
                            . "Notas Check da Semana</a></h4>";
                        }
                    }else {
                       echo "<a href='#'><img id='pageseguro' src='_imagens/logo-pagseguro1.png' "
                        . "alt='Forma de Pagamento: Boleto à Vista & Cartão de "
                               . "Credito Pague Seguro Deposíto em Conta' align='middle'/></a>"; 
                    }
                    if(count($listaArquivo)>0){ //arquivos
                        foreach ($listaArquivo as $key => $keyaluno) {
                            foreach ($keyaluno as $tipo => $valorMatriz) {
                                if ($tipo=="arquivo" && $keyaluno['tipo']=="Comprovante Pagamento") {
                                //arquivos do aluno
                                    echo "<h4><a href='_upload/". $valorMatriz . "'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                                      . $keyaluno['tipo'] . "</a></h4>";
                                }
                            }
                        }
                    }
          ?>
        <div class="inner">
            <h4> Status Pagamento: </h4>
            <?php switch ($inscricao->getStatuspgto()) {
                        case "PAGO":
                            echo '<span class="valorpago"><b><i>'
                            . $inscricao->getStatuspgto().'</i></b></span>'; 
                            break;
                        case "PENDENTE":
                            echo '<span class="valor"><b><i>'
                            . $inscricao->getStatuspgto().'</i></b></span>'; 
                            break;
                        case "GRATUITO":
                            echo '<span class="valorgratis"><b><i>'
                            . $inscricao->getStatuspgto().'</i></b></span>'; 
                            break;
                        default:
                            echo '<span class="valor"><b><i>'
                            . $inscricao->getStatuspgto().'</i></b></span>'; 
                } 
    ?>
	<ul><li><b>Valor do Curso:<span class="valor"><?php if(isset($_SESSION['curso'])){ 
         echo " R$ ".number_format($inscricao->getValor(),2,",",".");} ?></span></b></li></ul><br/>
    <?php 
        if($inscricao->getStatuspgto() != "PAGO" && $inscricao->getStatuspgto() != "GRATUITO"){
            switch ($inscricao->getIdcurso()){
                case 7:
                    echo '<!-- INICIO DO BOTAO PAGSEGURO --><a href="javascript:void(0)" onclick="PagSeguroLightbox(';
                    echo "'45065FFEAAAA3DA5546BFF95F1778456'";
                    echo '); return false;"><img src="//assets.pagseguro.com.br/ps-integration-assets/botoes/pagamentos/205x30-pagar-laranja.gif" 
                    alt="Pague com PagSeguro - é rápido, grátis e seguro!" /></a><script type="text/javascript" 
                    src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script><!-- FIM DO BOTAO PAGSEGURO -->';
                    break;
            }
        }
    ?>
</div> 
</article>
<article class="servico bg-white radius">
    <div class="inner">
        <?php
            $p = 0; $f=0;
            $idStatus = $inscricao->getInscricao();
            $statusAulas = $inscricao->statusPresenca($idStatus);
            if (count($statusAulas)>0) {
                echo '<h4> Frequência Mínima: 70%</h4><ul>';
            }
            foreach ($statusAulas as $key => $value) {
                echo "<li>";
                echo $value['aula'] . "ª - "; 
                echo date("d/m/Y", strtotime($value['data'])) . " - ";
                echo $value['tipo'];
                if ($value['tipo']=="P") {
                    $p++;
                }elseif ($value['tipo']=="F") {
                    $f++;
                }
                echo "</li>"; 
            }
            echo "</ul>";
            if (count($statusAulas)>0) {
                $percentual = round(($p/($p+$f))*100,0);
                if ($percentual>=70) {
                    echo "<span class='valorpago'><b><i> $percentual % Aprovado Presença</i></b></span>";
                }else {
                    echo "<span class='pendente'><b><i> $percentual % Reprovado Presença</i></b></span>";
                }
            }
         ?>
    </div> 
</article>
</div>
<?php require_once "./footer.php"; ?>
<?php 
if (isset($_REQUEST['inscricao'])){
    echo '<script  type="text/javascript"  type="text/javascript">'
        . 'alert("Inscrição Realizada com Sucesso! \n'
        . 'Parabéns pela sua Escolha, você está invenstindo no seu futuro!");</script>';
}
if (isset($_REQUEST['ninscricao'])){
    echo '<script  type="text/javascript"  type="text/javascript">'
    . 'alert("Você já está inscrito nesse curso!");</script>';
}
?>