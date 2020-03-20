<?php 
    ob_start();//inicio da sessao 
    session_start();//inicio da sessao 
    if(isset($_SESSION['emails'])){    
    }else {
        header("Location: login.php?acesso='logar'");exit;
    } 
    if(isset($_REQUEST['curso']) && isset($_REQUEST['aluno']) && isset($_REQUEST['inscricao']) ){
        $_SESSION['curso'] = $_REQUEST['curso'];
        $_SESSION['alunoup'] = $_REQUEST['aluno'];
        $_SESSION['inscricao'] = $_REQUEST['inscricao'];
        if (isset($_REQUEST['nome'])) {
            $_SESSION['nomeArq'] = $_REQUEST['nome'];
        }  else {
            $_SESSION['nomeArq'] = $_SESSION['nome'];
        }
        
        
        header("Location: upload.php");exit;
    }
    
    //consulta
    require_once './_model/classarquivos.php';
    //conexao
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
    try {
        $conexaoArq = new \PDO($dsn, $username, $passwd);//cria conexão com banco de dadosX 
    } catch (\PDOException $ex) {
        die('Não foi possível estabelecer '
        . 'conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());
    }
    $arquivo = new Arquivos($conexaoArq);
    $arquivo->setIdaluno($_SESSION['alunoup']);
    $arquivo->setIdcurso($_SESSION['curso']);
    $arquivo->setInscricao($_SESSION['inscricao']);
    if ($exect){
        $resultadoArquivos = $arquivo->listaTodosArquivos();
    }  else {
        $resultadoArquivos = $arquivo->listaArquivosAluno();
    }
    
?>
<?php require_once "./header.php"; ?>
<?php require_once "./menu.php"; ?>
<hgroup class="pagina">
    <h3>Enterprise >> Cursos & Treinamentos>> Área do Aluno >> UpLoad</h3><br/>
    <h1 class="center"> <i class="fas fa-upload"></i> <b><i>UpLoad</i> de Arquivos</b></h1>
<?php require_once './_model/classaluno.php';
	  require_once './_model/UrlDb.php';
        $url = new UrlBD();
	$dsn = $url->getDsn();
        $username = $url->getUsername();
        $passwd = $url->getPasswd();
    try {$conexao= new \PDO($dsn, $username, $passwd);} catch (\PDOException $ex) {
        die('Não foi possível estabelecer conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());}
    $aluno = new aluno($conexao);$resultado = $aluno->find($_SESSION['ids']);$aluno->setId($resultado['idaluno']);$aluno->setNome($resultado['nomealuno']);
    if(isset($_SESSION['emails'])){
        $usuario = explode(" ", $aluno->getNome());
        //echo "<h5 id=usuario>Usuário Logado=> $usuario[0] </h5>";
		} 
   ?>
   <p><b><a href="consulta.php">Voltar</a></b></p>
</hgroup>
<div class="texto">
    <?php if(isset($_REQUEST['upload'])):?>
        <?php  echo "<h2>Arquivo foi Enviado com Sucesso!!!</h2>";
          header("Refresh: 10, upload.php"); ?>
    <?php elseif(isset($_REQUEST['nupload'])):?>
        <?php  echo "<h2>Não foi possivel enviar o Arquivo!!!</h2>";
          header("Refresh: 10, upload.php"); ?>
    <?php elseif(isset($_REQUEST['down'])&& $exect):?>
        <form action="_download/upload.php" method="post" enctype="multipart/form-data">
        <h2>Enviar Arquivo: <input type="file" name="arquivo" size="20" /></h2>
        <!--<input type="image" name="tEnviar" src="_imagens/botao-enviar.png"/>-->
        <h2><input name="tEnviar" type="submit" class="enviar radius" value="Enviar"/><i class="fas fa-arrow-circle-right"></i></h2>
        </form>
    <?php elseif(isset($_REQUEST['lista'])):?>
    <h2>Lista de Arquivos</h2>
    <a href="upload.php">Voltar</a>
    <form method="POST" class="formmenu" name="formList" action="upload.php?lista=true" >
    <?php //paginacao na tabela php
        $intervalo = 7; 
        $tt = count($resultadoArquivos);
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
    <table id="tabelaspec">
           <thead>
               <tr>
                   <td>Excluir || Consulta</td>
                   <td>Arquivo do Aluno</td>
                   <!--<td>Nome Aluno</td>-->
                   <td>Tipo de Arquivo</td>
                   <td>Data</td>
                   
               </tr>
           </thead>
           <tbody>
               <?php
                foreach ($resultadoArquivos as $key => $valor){
                    if ($key>=$inicio && $key<=$fim) {
                        //linha
                        //var_dump($key);
                        echo "<tr>";
                        foreach ($valor as $key2 => $linha){
                            //células
                            //var_dump($key2);
                            if($key2=='idarq'){ //preciso criar o link
                                date_default_timezone_set('America/Sao_Paulo');
                                $dataHoje = date('Y-m-d H:i:s'); //hora e data de hoje
                                $data1 = new DateTime($valor['data_envio']); //date time data 1
                                $data2 = new DateTime($dataHoje);//date time data 2
                                $intervalo = $data1->diff($data2); //diferença de datas
                                //date("d/m/Y",  strtotime($data_hora[0]." + 7 days")); somar dias
                                if(($intervalo->d)<1 || $exect) {
                                    echo "<td><a href='_controller/excluirArquivo.php?id=" 
                                        . $linha."'>Excluir</a></td>";
                                }else{
                                    echo "<td><a href='_upload/". $valor['arquivo'] ."'>Baixar</a></td>";
                                }
                            
                            }elseif ($key2=='data_envio') {
                                $data_hora = explode(" ", $linha);//divide um texto em matriz
                                echo "<td>". date("d/m/y" ,strtotime($data_hora[0])) //formatar datas
                                    .  " " . date("H:i:s",  strtotime($data_hora[1]."- 3 hours"))  ."</td>";
                            }elseif ($key2=='arquivo') {
                                echo "<td><a href='_upload/" . $linha. "'>" . $linha. "</a></td>";
                            }elseif($key2<>'nomealuno') {
                                echo "<td>" . $linha. "</td>";
                            }
                        }
                        echo "</tr>";
                    }
            }
               ?>
           </tbody>
       </table>
    <?php elseif(isset($_REQUEST['raluno']) && isset($_REQUEST['rcurso'])  && isset($_REQUEST['idinscricao']) ):?>
    <?php else: ?>
    <form action="_controller/incluirArquivo.php" method="post" enctype="multipart/form-data">
        <article class="servico bg-white radius">
        <div class="inner">
        <h4 class="center">Informações:</h4>
        <ul class="formmenu consulta">
        <li><a href="consulta.php"><?php echo "Inscrição Nº: <span class='valor'>". $_SESSION['inscricao'] ."</span>"; ?></a></li>
        <li><b>Nome:</b> <?php echo $_SESSION['nomeArq']; ?></li><br/><br/><br/><br/>
        </ul>
        <input type="radio" name="tipo" id="Prova" value="Prova" checked="checked" />
        <label for="Prova" >Prova</label><br/>
        <input type="radio" name="tipo" id="Trabalho" value="Trabalho"/>
        <label for="Trabalho">Trabalho ou Exercícios</label><br/>
        <?php
            if ($exect) {
                echo '<input type="radio" name="tipo" id="Comprovante Pagamento" value="Comprovante Pagamento"/>
                            <label for="Comprovante Pagamento">Comprovantes</label><br/>';
                echo '<input type="radio" name="tipo" id="Certificado" value="Certificado"/>
                            <label for="Certificado">Certificados</label>';
            }
         ?>
        
        </div>
        </article>
        <?php $contar = $arquivo->contarArquivos($_SESSION['alunoup']);
                if ($contar[0]['count(*)']>0 || $exect) {
                        echo '<h2><a href="upload.php?lista=true">Lista de Arquivos</a></h2>';
                } 
                if ($exect) {
                    echo "<a href='root.php?inscricoes=" . $_SESSION['curso'] . "'>Inserir Novos Arquivos</a>";
                }
        ;?>
        
        <h2>Enviar Arquivo: <input type="file" name="arquivo" size="20" /></h2>
        <!--<input type="image" name="tEnviar" src="_imagens/botao-enviar.png"/>-->
        <h2><input name="tEnviar" type="submit" class="enviar radius" value="Enviar"/><i class="fas fa-arrow-circle-right"></i></h2>
        </form>
    <?php endif; ?>
</div>
<?php require_once "./footer.php"; ?>