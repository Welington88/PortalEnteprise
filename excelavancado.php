<?php session_start();//inicio da sessao ?>
<?php require_once "./header.php"; ?>
<?php require_once "./menu.php"; ?>
<?php  
    if(isset($_REQUEST['curso'])){
        unset($_SESSION['curso']);
        $_SESSION['curso'] = $_REQUEST['curso'];
        header("Location: inscricao.php?curso='".$_REQUEST['curso'].
                "'&inscrever=true");exit;
    }
?>
<hgroup class="pagina">
<h3>Enterprise >> Cursos >> Excel Avançado</h3>
<h1>Curso Excel Avançado<br/>
    <a href="cursos.php" ><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Voltar</a></h1>
<?php require_once './_model/classaluno.php';
	require_once './_model/UrlDb.php';
        $url = new UrlBD();
		$dsn = $url->getDsn();
        $username = $url->getUsername();
        $passwd = $url->getPasswd();
    try {$conexao= new \PDO($dsn, $username, $passwd);} catch (\PDOException $ex) {
        die('Não foi possível estabelecer conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());}
    if (isset($_SESSION['emails'])){
        $aluno = new aluno($conexao);$resultado = $aluno->find($_SESSION['ids']);
        $aluno->setId($resultado['idaluno']);$aluno->setNome($resultado['nomealuno']);}
    if(isset($_SESSION['emails'])){
    $usuario = explode(" ", $aluno->getNome());
    //echo "<h5 id=usuario>Usuário Logado=> $usuario[0] </h5>";
	} ?>
</hgroup>
<figure id="iconeCurso">    
    <img src="_imagens/excel_2013.png" alt="Excel Avançado" align="top" />
</figure>
<div class="texto">
    <h2><i class="fas fa-file-excel"></i> &nbsp;&nbsp;Excel Avançado</h2>
    <font size="1" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Obs.: Compatível também com as versão 2007, 2010, 2013, 2016, 2019 e Office365</font>
<h2>Utilização</h2>
<p>O <b><i>Excel</i></b> é o software mais utilizado e conhecido no mundo. É um editor de planilhas que auxilia em qualquer tarefa no seu dia a dia, pois é uma ferramenta com grande suporte para cálculos e construções de gráficos, com o implemento de <i>VB(Visual Basic)</i>. Por Virtude desse fato, empresas vem procurando profissionais capacitados e com o domínio dessa ferramenta. Assim, você estará preparado para atuar em qualquer segmento no mercado de trabalho.</p>
<p>Hoje, o <b><i>Excel</i></b> é um dos software mais utilizados em todos os setores no mundo corporativo, seja para situações mais simples, como elaboração de planilhas para controle de estoque, até para atividades mais complexas, como o gerenciamento de projetos e muito mais. </p>

<h2>Microsoft <b><i>Excel</i></b> | <b><i>Excel</i></b> Avançado | <b><i>Excel</i></b> VBA</h2>

<p>Ao todo serão <em>15 capítulos</em>, apresentados durante as aulas presenciais do curso:<br/><br/>
 Utilizando de uma metodologia com aulas práticas e dinâmicas, você aprenderá a utilizar o <b><i>Excel</i></b> de forma completa tirando suas dúvidas e praticando em sala de aula, como exemplo, planilhas profissionais nos moldes utilizadas em grandes empresas. E essa será com certeza um diferencial em sua carreira, o que lhe abrirá portas na busca por um novo posicionamento no mercado de trabalho ou/e crescimento e sucesso profissional.
</p>

<h2>Mercado de Trabalho</h2>
<p>
Dominar o <b><i>Excel</i></b> é essencial, independente do segmento de atuação. Área Administrativa, Engenharia, Tecnologia de Informação, Recursos Humanos, Contábil e etc. Todas exigem o conhecimento de <b><i>Excel</i></b>, com isso, gera um diferencial na busca por melhores oportunidades de trabalho.
</p>

<p>
Segundo os principais Recrutadores e Agências de RH, o <b><i>Excel</i></b> é exigido em praticamente todos os cargos de destaque e liderança. Em processos de exames de seleção ou testes de conhecimentos é praticamente obrigatório o domínio do <b><i>Excel</i></b>. Com o nosso curso você dominará e se tornará destaque no mercado de trabalho. 
</p>
<p>
Quer conquistar as habilidades necessárias para dominar o <b><i>Excel</i></b> e ter a oportunidade de aplicar estes conhecimentos? Nós Temos o curso para você!
</p>
<h2>Programa
    e Metodologia <b><i>Excel</i></b> - Avançado</h2>
<ul>
        <h4>Conteúdo Programático do Curso de Excel Avançado</h4>
        <li>Obter dados externos</li>
        <ul >Introdução ao recurso de obter dados externos 
            <li>Obter dados externos de um arquivo de texto , csv entre outros</li>
            <li>Atualizar a conexão e Visualizar as conexões existentes</li>
            <li>Obter dados externos do Access e sql</li>
            <li>A tabela do Excel como banco de dados</li>
            <li>Como localizar registros duplicados e excluir registros duplicados</li>
            <li>Como acrescentar uma linha de totais na tabela</li>
            <li>Funções SUBTOTAL e de Banco de Dados(Acrescentando e Removendo Subtotais</li>
        </ul>
        <li>Funções de Texto</li>
        <ul>
            <li>NÚM.CARACT</li>
            <li>LOCALIZAR</li>
            <li>ESQUERDA</li>
            <li>EXT.TEXTO</li>
            <li>ARRUMAR</li>
            <li>DIREITA</li>
            <li>CONCATENAR</li>
        </ul>

        <li>Tabela Dinâmica</li>
        <ul>
            <li>O que é Tabela Dinâmica?</li>
            <li>Criando o relatório de tabela dinâmica</li>
            <li>Navegando em nossa tabela dinâmica</li>
            <li>Alterando o layout da tabela dinâmica</li>
            <li>Mostrando o gráfico dinâmico a partir de uma tabela dinâmica</li>
            <li>Inserindo e alterando informações</li>
            <li>Usando mais de um campo como linha e arrumando os subtotais</li>
            <li>Agrupando dados de uma tabela dinâmica</li>
        </ul>
        <li>Segurança dos dados e Validação de Dados</li>
        <ul>
            <li>Protegendo seus dados e Protegendo a pasta de trabalho</li>
            <li>Colocando e Retirando a senha</li>
            <li>Protegendo a estrutura da pasta de trabalho</li>
            <li>Protegendo as células da planilha</li>
            <li>Validação de Dados: Conhecendo a validação de dados</li>
            <li>Conhecendo a guia mensagem de entrada e alerta de erro</li>
        </ul>
        
        <li>Funções Matemáticas, Estatísticas, Lógicas e Datas</li> 
        <ul>
            <li>SOMASE - SOMASES </li>
            <li>CONT.SE - CONT.SES - CONT.NÚM - CONT.VALORES - CONTAR.VAZIO</li>        
            <li>ÉERRO - ÉERROS - SEERRO</li>
            <li>AGORA - HOJE - ANO -MÊS - DIA - DATA.VALOR - DATAM - DIA.DA.SEMANA - DIAS360 - DIATRABALHO - DIATRABALHOTOTAL - FIMMÊS - FRAÇÃOANO - HORA</li>
            <li>SE - E - OU</li> 
        </ul>
        <li>Função de Pesquisa e Referência</li>
        <ul>
            <li>CORRESP</li>
            <li>DESLOC</li>
            <li>ÍNDICE</li>
            <li>PROCV - PROCH</li>
            <li>INDIRETO</li>
        </ul>
        <li>Auditoria de Fórmulas</li>
        <ul>
            <li>Rastreando células precedentes e dependentes</li>
            <li>Utilizando a Auditoria de Fórmulas durante a digitação</li>
            <li>Rastreando Erros - Tipos de erros - Erros(###, #DIV/0!, #N/D, #NOME?, #NULO!,#NUM!, #REF!, #VALOR! e Referência Circular</li>
            <li>Avaliando Fórmulas - A Janela de Inspeção - Modo Auditória de Fórmulas</li>
        </ul>
        <li>Análise de Dados e Simulações</li>
        <ul>
            <li>Atingir Meta - O que é o recurso Atingir Meta - Utilizando o recurso Atingir Meta</li>
            <li>A aproximação de resultados</li>
            <li>Solver - Análise da aproximação de resultados - Múltiplas Soluções </li>
        </ul>
        <li> VBA e Macros</li>
        <ul>
            <li>O que é Macro?</li>
            <li>Principais benefícios da utilização das macros</li>
            <li>Relação entre Macros e o VBA</li>
            <li>Segurança na utilização de macros</li>
            <li>Criando a sua primeira macro</li>
            <li>Como salvar pastas de trabalho que possuem macros</li>
            <li>Diferenças entre macros com Referências Absolutas e Relativas</li>
            <li>Gravando uma macro com referências relativas</li>
            <li>Macros e a janela VBE (Visual Basic Editor)</li>
            <li>Utilidade real das macros</li>
        </ul>
    </ul>
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
    //incio do banco de dados
    $idcurso = 3;
    
    if (isset($_SESSION['ids'])){$idaluno = trim(strip_tags($_SESSION['ids'])); 
    //incio do banco de dados
    require_once './_model/classinscricao.php';
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
    $resultado = $inscricao->find($idaluno,$idcurso);
    $consultaid = $resultado['idaluno'];
    $inscricao->find($consultaid,$idcurso);
    $numinscricao = $resultado['idinscricao'];
    $statuspgto = $resultado['statuspgto'];
    $inscricao->setStatuspgto($statuspgto);
    $chave = $resultado['chave'];
    $inscricao->setChave($chave);
    }
    if(isset($_SESSION['curso'])){
    $vagas = $resultadoCurso['vagas'];
    
    //header("Location: consulta.php");exit;   
    // fim de bando de dados*/
    if (isset($_SESSION['ids'])){}else{$numinscricao=0;}
    if($numinscricao<1&&$vagas>0){
        echo "<span id='inscricao'><a href='excelavancado.php?curso=" . $idcurso ."'>"
        . "Faça sua Inscrição aqui!!!</a></span>";
    }else {
        echo "<span id='inscricao'><a href='consulta.php?curso=" . $idcurso ."'>"
        . "Consulte sua Inscrição aqui!!!</a></span>";
    }} else { //se não tiver logado
        require_once './_model/classcursos.php';
    try {
        $conexaoCurso = new \PDO($dsn, $username, $passwd);//cria conexão com banco de dadosX 
    } catch (\PDOException $ex) {
        die('Não foi possível estabelecer '
        . 'conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());
    }
    $curso = new Cursos($conexaoCurso);
    $id = $idcurso;
    $resultadoCurso = $curso->find($id);
    $curso->setNomeCurso($resultadoCurso['nomecurso']);
    $curso->setDescricao($resultadoCurso['descricao']);
    $curso->setInstrutor($resultadoCurso['instrutor']);
    $curso->setPrevisao($resultadoCurso['previsao']);
    $curso->setCarga($resultadoCurso['carga']);
    $curso->setTotaula($resultadoCurso['totaulas']);
    $curso->setValor($resultadoCurso['valor']);
    $curso->setVagas($resultadoCurso['vagas']);
    $vagas = $curso->getVagas();
    if($vagas>0){
        echo "<span id='inscricao'><a href='excelavancado.php?curso=". $idcurso ."'>"
        . "Faça sua Inscrição!!!</a></span>";
    }//fim de serro 
    }
?>
<p><b><i>Enterprise&copy;</i></b> o melhor para você, sua equipe e sua empresa.</p>
</div>
<?php require_once "./footer.php"; ?>