<?php
$db = pg_connect("host = localhost port = 5432 dbname = dou user = postgres password = postgres");
$query = "SELECT * FROM licitacao where dataproposta::date = '$_POST[dataproposta]'";
$result = pg_query($db, $query);
//$row = pg_fetch_assoc($result);
if (isset($_POST['submit']))
{
    echo "<br><br>
        <h1>
            <font face='Times New Roman'>
                    <b>RESULTADO</b>
            </font>        
        </h1>";
    while($row = pg_fetch_assoc($result)){
        echo "<br><hr size='10' width='50%'><br>";
        echo "<b><br>Órgao: <br></b>";
        echo $row['orgao'];
        echo "<b><br>Título: <br></b>";
        echo $row['titulo'];
        echo "<b><br>Estado: <br></b>";
        echo $row['estado'];
        echo "<b><br>Cidade: <br></b> - ";
        echo $row['cidade'];
        echo "<b><br>Objeto: <br></b>";
        echo $row['objeto'];
        echo "<b><br>Datas: <br></b>";
        echo "Proposta - ";
        echo $row['dataproposta'];
        echo "<br>Sessão - ";
        echo $row['datasessao'];
        echo "<br><br>";
    }
}
else {
    if(!$db) {
        echo "Ocorreu um erro.\n";
        exit;
    }
    pg_close($db);
}

?>
