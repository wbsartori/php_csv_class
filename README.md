<h1 align="center">
    <a href="https://github.com/wbsartori/php_csv_class">🔗 Classe Simples para Gerar Arquivo CSV</a>
</h1>

### Obejtivo
<p >
    Criar uma classe com método simples que irá gerar um arquivo .CSV e copia-lo para uma pasta estipulada.
</p>    

### Features
    [X] Criado Classe Principal para geraçãodo arquivo.
    [X] Criado Método para copiar o arquivo para o destino e remover do local onde é criado. 

### Melhorias
    [X] Ajustar o parâmetro nome_arquivo para receber um valor diferente do padrão que é nom_arquivo_mes_ano.
    
### Classe Util.php

```php
DEFINE('BASE_ROOT', __DIR__);

class Util
{

    private $header = array();

    public function getArquivoGerado($origem, $arquivo, $destino)
    {
        if($origem.'/'.$arquivo){
            copy($origem.'/'.$arquivo, $destino.'/'.$arquivo);
            unlink($origem.'/'.$arquivo);
            echo 'O Arquivo: '.$arquivo.' Foi gerado com sucesso e copiado para:' .str_replace('/','\\',$destino.$arquivo);
        }else{
            echo 'Não foi possível copiar o arquivo para pasta de destino'.'</br>'.'Pasta Atual:' .$origem.'</br>'.'Pasta Destino:' .$destino;
        }
    }

    public function GerarCsv($nome_arquivo_data = null, $nome_arquivo = null,$caminho_arquivo, $header, $items, $separador){

        /**
         * Gerar o nome do arquivo com ano e mes por padrão
         * Caso deseje utulizar um nome personalizado use o parametro $nome_arquivo(AINDA NAO IMPLEMENTADO)
         */
        $data_ano = date('Y');
        $data_mes = date('m');
        $nome_arquivo_data = $nome_arquivo_data.'_'.$data_mes.'_'.$data_ano .'.csv';

        /**
         * Caminho do arquivo
         */
        $caminho_arquivo = BASE_ROOT . '\\'.$caminho_arquivo;
        $converte_barras = str_replace('/','\\',$caminho_arquivo);
        
        /**
         * Grava o cabeçalho do arquivo
         */
        if(file_exists($converte_barras)){
            $arquivo_aberto = fopen($nome_arquivo_data, 'w');
            $quebra = chr(13).chr(10);
            fwrite($arquivo_aberto, implode(';',$header).$quebra);

            foreach ($items as $item){
                fputcsv($arquivo_aberto, $item, $separador);
            }

            fclose($arquivo_aberto);

            if(file_exists($nome_arquivo_data)){
               $this->getArquivoGerado(BASE_ROOT , $nome_arquivo_data,BASE_ROOT . '/temp/csv/');
            }
        }

    }
}
```
    
### Arquivo index.php

```php
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
