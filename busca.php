<?php
    error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Atividade de migração</title>
    <meta content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
        name="viewport">

    <link href="css/index.css" rel="stylesheet" type="text/css">
</head>

<body>
    <main class="container">
        <h1 class="title">Consumindo API NADIC COM PHP</h1>
        <form class="form" action="resultado.php" target="blank" method="POST">
            <div class="row">
                <div>
                    <h1>Insira a data a ser buscada:</h1>
                    <input type="date" name="dataproposta" class="form___data" <?php echo date('Y-m-d'); ?>>
                    <span class="form___requirement">* Selecione ou insira um  a data.</span>
                </div>
            </div>
            <div class="row has-alignCenter">
                <button class="form__button" type="submit" value="submit" name="submit">Buscar</button>
            </div>
        </form>
    </main>
</body>

</html>
