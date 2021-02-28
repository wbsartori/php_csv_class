<?php
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