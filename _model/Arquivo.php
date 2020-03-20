<?php
class Arquivo{
    //$curso->Código->Arquivo
    private $arquivos = array(
            1=>array(1=>"welington.xlsx"),
            2 => array(47=>"Deborah.xlsx",
                54=>"DIEGO SARAIVA.xlsx",
                34=>"Diogo Pereira Goncalves.xlsx",
                46=>"Hebert Silva Ribeiro.xlsx",
                52=>"Italo Vicente Prova.xlsx",
                50=>"Jhonatas Antenor da Silva PROVA Novo.xlsx",
                35=>"Taciana.xlsx",
                43=>"Rodolfo Lopes Dutra prova.xlsx",
                25=>"RONDINELE.xlsx",
                44=>"Andreza.xlsx",
                40=>"Charles Washington de Souza.xlsx",
                49=>"ligia prova.xlsx",
                57=>"Luciano Neto de Mello.xlsx",
                56=>"Bruna Pires Dos Santos.xlsx",
                28=>"Moyses.xlsx",
                51=>"BRUNO DE OLIVEIRA EUGENIO PROVA.xlsx",
                38=>"Cleria.xlsx",
                10=>"Daniel Folha.xlsx",
                31=>"jurandy_ferreira.xlsx",
                41=>"Magna.xlsx",
                53=>"andrewerneck.xlsx",
                1=>"welington.xlsx"),
            3=>array(98=>'crislane 1990.xlsx',
                129=>'Huanna Souza.xlsx',
                42=>'Larissa Paixão.xlsx',
                97=>'Patricia.xlsx',
                56=>'Prova Bruna xlxs.xlsx',
                117=>'Prova Débora.xlsx',
                112=>'Prova Douglas.xlsx',
                113=>'Prova Jonathas.xlsx',
                122=>'Prova Júlio.xlsx',
                111=>'Prova Lucy Aparecida da Rosa Germano Guerson.xlsx',
                106=>'Prova Mônica Castro.xlsx',
                127=>'Prova Nayara Marinato.xlsx',
                118=>'Prova shalom.xlsx',
                115=>'Prova_Michael.xlsx',
                101=>'Provashirley.xlsx',
                1=>'welington.xlsx'),
            4=>array(166=>"Alan_Martins_Bastos.xlsx",
                146=>"AMANDA CAMPOS.xlsx",
                162=>"Artur_Alves.xlsx",
                142=>"Camila Moraes de Oliveira.xlsx",
                11=>"debora.xlsx",
                175=>"Denilson Ramos.xlsx",
                137=>"Denise.xlsx.xlsx",
                170=>"Edna Borges.xlsx",
                173=>"EDUARDO MONTORSE Prova.xlsx",
                87=>"Emerson Fernandes Lacerda.xlsx",
                128=>"Gisele dos santos porto.xlsx",
                148=>"ISABELA_GOUVÊA_MACHADO.xlsx",
                140=>"Jessica.xlsx",
                144=>"Kleiny Fernandes Pinto.xlsx",
                155=>"LAUREN_LAMOIA.xlsx",
                143=>"Leonardo_Regis.xlsx",
                156=>"Luana Cuco Ferreira.xlsx",
                133=>"LuannyLacerda.xlsx",
                176=>"Lucas-Certo.xlsx",
                139=>"LUCIMAR ALMEIDA.xlsx",
                163=>"Matheus Carvalho Almeida.xlsx",
                152=>"Michele.xlsx",
                168=>"Paulo henrique_oliveira.xlsx",
                154=>"Pedro Gil Cardoso Gonçalves.xlsx",
                164=>"Rafaela Lourenço.xlsx",
                147=>"RAMON.xlsx",
                159=>"Raquel Fontoura Da Silva De Menezes.xlsx",
                160=>"Renata Madeira Lacerda Rodrigues.xlsx",
                151=>"TAIS GONÇALVES.xlsx",
                171=>"Thiago Sabino.xlsx",
                174=>"Carliane Aleixo.xlsx",
                145=>"Michelle Silva Excel.xlsx",
                167=>"Camila Miranda.xlsx",
                1=>"welington.xlsx"),
            5=>array(72=>"Ana Caroline Camilo.xlsx",
                94=>"Ana Paula da Fonseca Botelho.xlsx",
                73=>"ANGELICA - prova avançado.xlsx",
                92=>"Argeu - Avançado.xlsx",
                81=>"Danilo_Martins.xlsx",
                82=>"DouglasCarminateRocha.xlsx",
                75=>"Gabriela - Avançado.xlsx",
                74=>"Kíssila - Avançado.xlsx",
                88=>"Lara - Avançado.xlsx",
                89=>"Marcelly - Excel Avançado.xlsx",
                69=>"PC.xlsx",
                79=>"Ricartt montan 4.xlsx",
                83=>"Rodrigo Pimentel.xlsx",
                70=>"Mário - Avançado.xlsx",
                93=>"Samuel.xlsx",
                76=>"Daiane.xlsx",
                67=>"Lucas-Certo.xlsx",
                84=>"Glauquer - Avançado.xlsx",
                90=>"Wolney - Avançado.xlsx",
                1=>"welington.xlsx",
                95=>"Edson Avançado.xlsx")
               );
    
    public function __construct() {

    }    
    public function getArquivos() {
        return $this->arquivos;
    }
              
    /*matriz com variável
     * foreach ($matriz as $keycurso => $keyaluno) {
        if ($keycurso == 4) {
            echo "Curso: " . $keycurso . " <br/>";
            foreach ($keyaluno as $aluno => $arquivo) {
                if($aluno == 1){
                    echo "Aluno: " .  $aluno . " <br/>";
                    echo "Prova: " . $arquivo . "<br/>";
                }
            }
        }
    }*/
    //matriz inteira
    /*foreach ($matriz as $keycurso => $keyaluno) {
        echo "Curso: " . $keycurso . " <br/>";
        foreach ($keyaluno as $aluno => $arquivo) {
            echo "Aluno: " .  $aluno . " <br/>";
            echo "Prova: " . $arquivo . "<br/>";
        }
    }*/
    //var_dump($arquivos); imprimir todo array
}
?>

