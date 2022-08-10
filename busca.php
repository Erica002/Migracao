<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Atividade de migração</title>
    <meta content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
        name="viewport">

    <link href="css/busca.css" rel="stylesheet" type="text/css">
</head>

<body>
    <main class="container">
        <h1 class="title">Consumindo API NADIC COM PHP</h1>
        <form class="form" action="busca.php" method="POST">
            <div class="row">
                <div>
                    <h1>Insira a data a ser buscada:</h1>
                    <input type="date" name="dataproposta" class="form___data" <?php echo date('Y-m-d'); ?>>
                    <span class="form___requirement">* Selecione o período desejado.</span>
                </div>
            </div>
            <div class="row has-alignCenter">
                <button class="form__button" type="submit" value="submit" name="submit">Buscar</button>
            </div>
        </form>
    </main>
</body>

</html>

<?php
$db = pg_connect("host = localhost port = 5432 dbname = dou user = postgres password = postgres");
$query = "SELECT * FROM licitacao where dataproposta::date = '$_POST[dataproposta]'";
$result = pg_query($db, $query);
//$row = pg_fetch_assoc($result);
if (isset($_POST['submit']))
{
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
}
else {
    if(!$db) {
        echo "Ocorreu um erro.\n";
        exit;
    }
    pg_close($db);
}
?>