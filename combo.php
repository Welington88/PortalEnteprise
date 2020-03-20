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
<h3>Enterprise >> Cursos >> Super Curso Excel Básico + Avançado + Power BI</h3>
<h1><i class="fas fa-file-excel"></i>Excel Básico + Avançado + Power BI<br/>
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
    <img src="_imagens/super.png" alt="Excel Avançado"/>
</figure>
<figure id="iconeCurso">
    <img src="_imagens/PowerBi.png" alt="Power BI"/>
</figure>
<div class="texto">
    <font size="1" >Obs.: Compatível também com as versão 2007, 2010, 2013 e Office365</font>
   		
<!--<span id='inscricao'><a href='#nome'><br/><br/>Obs.: Específicamente para esse curso todos alunos devem levar o notebook.</a></span> <br/>-->
    <h2>Descrição - Para você que deseja a experiência completa!</h2>
    <p>O <b><i>Excel</i></b> é o software mais utilizado e conhecido no mundo. É um editor de planilhas que auxilia em qualquer tarefa no seu dia a dia, pois é uma ferramenta com grande suporte para cálculos e construções de gráficos, com o implemento de <i>VB(Visual Basic)</i>. Por Virtude desse fato, empresas vem procurando profissionais capacitados e com o domínio dessa ferramenta. Assim, você estará preparado para atuar em qualquer segmento no mercado de trabalho.</p>

    <h2>Utilização</h2>
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
<h2>Microsoft <b><i>Excel</i></b> | <b><i>Excel</i></b> Básico | <b><i>Excel</i></b> VBA</h2>

<h2>Objetivo Power BI</h2>
<p>Objetivo do Curso de Business Intelligence usando o Microsoft Power BI:
Obtenha mais informações sobre seus dados, seja armazenado em seu computador ou na nuvem. 
Saiba como se conectar e mesclar dados com o Microsoft Power BI, o poderoso software de análise e visualização de dados. 
Neste curso, você aprenderá a conectar várias fontes de dados, pesquisar e transformar os dados com consultas simples. 
Aprenda também como criar relacionamentos entre fontes de dados, mesclar dados e criar e compartilhar relatórios.</p>


<h2>O que é o Power BI?</h2>
<p>O Power BI é um serviço de análise de negócios baseado em nuvem que fornece uma exibição única de seus dados de negócios mais críticos. 
Monitore a integridade de seus negócios usando um painel ativo, crie relatórios interativos completos com o Power BI Desktop e acesse seus 
dados em qualquer lugar com aplicativos Power BI para Celulares nativos. É fácil, rápido e gratuito.</p>
<p>Power BI Desktop é um mashup de dados com recursos avançados e uma ferramenta de criação de relatórios. 
Combine os dados de bancos de dados diferentes, arquivos e serviços Web com ferramentas visuais que ajudam a 
compreender e corrigir automaticamente problemas na qualidade dos dados e de formatação.</p>
<h2>Programa
    e Metodologia <b><i>Excel</i></b> - Avançado & Power BI</h2>
        <h3>Conteúdo Programático do Curso de Excel Avançado</h3>
    <ol>
        <li>Obter dados externos</li>
        <ul >Introdução ao recurso de obter dados externos 
            <li>Obter dados externos de um arquivo de texto , csv entre outros</li>
            <li>Obter dados externos do Access e sql</li>
            <li>Como localizar registros duplicados e excluir registros duplicados</li>
            <li>Funções SUBTOTAL e de Banco de Dados(Acrescentando e Removendo Subtotais</li>
        </ul>
        <li>Funções de Texto</li>
        <ul>
            <li>NÚM.CARACT - LOCALIZAR - ESQUERDA - EXT.TEXTO - ARRUMAR - DIREITA - CONCATENAR</li>
        </ul>
        <li>Tabela Dinâmica</li>
        <ul>
            <li>O que é Tabela Dinâmica?</li>
            <li>Criando o relatório de tabela dinâmica</li>
            <li>Mostrando o gráfico dinâmico a partir de uma tabela dinâmica</li>
            <li>Inserindo e alterando informações com subtotais agrupando dados de uma tabela dinâmica</li>
        </ul>
        <li>Segurança dos dados e Validação de Dados</li>
        <ul>
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
            <li>CORRESP - DESLOC - ÍNDICE</li>
            <li>PROCV - PROCH - INDIRETO</li>
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
            <li>O que é Macro? Principais benefícios da utilização das macros</li>
            <li>Relação entre Macros e o VBA</li>
            <li>Diferenças entre macros com Referências Absolutas e Relativas</li>
            <li>Gravando uma macro com referências relativas</li>
            <li>Macros e a janela VBE (Visual Basic Editor)</li>
            <li>Utilidade real das macros</li>
        </ul>
        <li> Power BI</li>
        <ul>
            <li>Introdução à business intelligence </li>
            <li>Introdução à data analysis (Power Query) </li>
            <li>Ferramentas da Microsoft para self-service BI</li>
            <li>Criando Power BI dashboard</li>
            <li>Conectando-se aos dados do Power BI</li>
            <li>Criar um painel do Power BI</li>
            <li>Desenvolva relatórios com medidas usando o aplicativo Power BI Desktop.</li>
        </ul>
    </ol>
    <em>Valor Curso Básico = R$ 200,00 <br/>Valor do Curso Avançado = R$ 300,00<br/>Valor do Curso Power BI = R$ 260,00<br/> Total R$760,00 Valor com Combo (Básico + Avançado + Power BI) = R$ 380,00(Economia de 50% = -R$380,00 )</em>
    <br/>
    
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
    $idcurso = 7;
    
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
        . "Faça sua Inscrição !!!</a></span>";
    }//fim de serro 
    }
?>
<p><b><i>Enterprise&copy;</i></b> o melhor para você, sua equipe e sua empresa.</p>
</div>
<?php require_once "./footer.php"; ?>
<amp-auto-ads type="adsense"
              data-ad-client="ca-pub-9832861056899887">
</amp-auto-ads>