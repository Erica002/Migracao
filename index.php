<!DOCTYPE html>
<html lang = "pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Teste</title>
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
        
            //laço para percorrer o vetor com os dados das licitacoes
        foreach ($resultado->licitacoes as $licitacao) {
            //exibe as informacoes que são armazenadas no vetor datas
            //var_dump($licitacao->datas);
            foreach ($licitacao->datas->Propostas as $data) {
                foreach ($licitacao->datas->Sessao as $datasessao) {
                    //insere na tabela licitação, no postgres, os dados contidos no arquivo JSON
                    $result = pg_query($conn, "INSERT INTO licitacao (orgao, titulo, estado, cidade, objeto, dataproposta, datasessao) VALUES ('$licitacao->orgao_clean', '$licitacao->titulo', '$licitacao->estado', '$licitacao->cidade', '$licitacao->objeto', '$data->data', '$datasessao->data')");
                }

            }
            
        }

        
        ?> 
    </body>
</html>
