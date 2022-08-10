<?php
$conn = pg_connect("host = localhost port = 5432 dbname = dou user = postgres password = postgres");
if(!$conn) {
    echo "Ocorreu um erro.\n";
    exit;
}

$result = pg_query($conn, "select * from licitacao where dataproposta::date = '2022-02-23'");
if(!$conn) {
    echo "Ocorreu um erro.\n";
    exit;
}
while($row = pg_fetch_assoc($result)){
    echo "<br>Órgao: <br>";
    echo $row['orgao'];
    echo "<br>Título: <br>";
    echo $row['titulo'];
    echo "<br>Estado: <br>";
    echo $row['estado'];
    echo "<br>Cidade: <br> - ";
    echo $row['cidade'];
    echo "<br>Objeto: <br>";
    echo $row['objeto'];
    echo "<br>Datas: <br>";
    echo $row['dataproposta'];
    echo "<br>";
    echo $row['datasessao'];
    echo "<br>";
}
?>