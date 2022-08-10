<!DOCTYPE html>
<html lang = "pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Consumindo API</title>
    </head>
    <body>
        <?php
       //consome a API e decodifica o arquivo JSON
        $url = "https://nadic.ifrn.edu.br/api/dou/2022-02-08/?usuario=dev_nadic";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $resultado = json_decode(curl_exec($ch));
        
        //var dump para exibir a estrutura do arquivo decodificado
        var_dump($resultado);

        //verifica se a extensão do Postgres está sendo carregada com sucesso
        echo extension_loaded('pgsql') ? 'yes':'no';

        //cria a conexão com o postgres
        $conn = pg_connect("host = localhost port = 5432 dbname = dou user = postgres password = postgres");

            //
            $resultadoproposta;
            $resultadosessao;
            //laço para percorrer o vetor com os dados das licitacoes
            foreach ($resultado->licitacoes as $licitacao) {
            
                foreach ($licitacao->datas->Propostas as $data) {
                    foreach ($licitacao->datas->Sessao as $datasessao) {
                        $resultadoproposta = $data->data;
                        $resultadosessao = $datasessao->data;
            //exibe as informacoes que são armazenadas no vetor datas
            //var_dump($licitacao->datas);
                }       
            }   
            $dataproposta = $resultadoproposta;
            $sessaodata =$resultadosessao;
            //insere na tabela licitação, no postgres, os dados contidos no arquivo JSON
            $result = pg_query($conn, "INSERT INTO licitacao (orgao, titulo, estado, cidade, objeto, dataproposta,datasessao) VALUES ('$licitacao->orgao', '$licitacao->titulo', '$licitacao->estado', '$licitacao->cidade', '$licitacao->objeto', '$dataproposta', '$sessaodata')"); 

        }        
        ?> 
    </body>
</html>
