<?php
require ('Util.php');

//Instancia a classe
$csv = new Util();

//Passa o valor com o nome do arquivo
$nome_arquivo = 'teste';

//Passa o caminho da pasta de destino do arquivo
$caminho_arquivo = 'temp/csv';

//Array com o cabeçalho do arquivo
$header = array('NOME','SOBRENOME');

//Array que servirá para adicionar os items do arquivo
$items = array(
            array('Nome1', 'Sobrenome1'),
            array('Nome2', 'Sobrenome2'),
            array('Nome3', 'Sobrenome3')
);

$csv->GerarCsv($nome_arquivo,$caminho_arquivo,'',$header,$items,';');

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GerarCSV</title>
</head>
<body>

<h1>Downlaod de Arquivo CSV</h1>
<hr>

</body>
</html>
