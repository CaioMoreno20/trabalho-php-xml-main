<?php

    //Recebe dados do formulário
    $nomeUsuario = $_GET['nomeUsuario'];
    $dataUsuario = strtotime($_GET['dataUsuario']);
    $dataUsuario = date('m/d', $dataUsuario);

    //Interpreta o XML e transforma em um objeto
    $signos = simplexml_load_file('SignosXML.xml');

    //Array para armazenar os dados do signo do usuário
    $signoUsuario = [];

    //Itera os elementos que contém no XML
    foreach($signos->signo as $signo) {

        $compararDatas = compararDatas($signo->dataInicio, $signo->dataFim, $dataUsuario);

        if($compararDatas) { 
          $signoUsuario = [
            'nome' => $signo->signoNome,
            'descricao' => $signo->descricao,
            'dataInicio' => $signo->dataInicio,
            'dataFim' => $signo->dataFim,
            'imagem' => getImagemSigno($signo->signoNome),
          ];
        }

      }    

    //Função responsável por comparar a data de nascimento do usuário com as datas de INÍCIO E FINAL de cada signo
    function compararDatas(string $dataInicio, string $dataFim, string $dataUsuario): bool
    {
      $dataUsuario = strtotime($dataUsuario);
      $dataInicio = converterDataSigno($dataInicio);
      $dataFim    = converterDataSigno($dataFim);

      //Variáveis que armazenam o boolean da comparação entre duas datas
      $condInicio = $dataUsuario >= $dataInicio;
      $condFinal = $dataUsuario <= $dataFim;

      $retorno = false;

      //Como o Capricórnio é o único signo que a data de início é maior que a data final, é necessário uma operação lógica específica só para ele 
      if($dataInicio > $dataFim) {
        $retorno = $condInicio || $condFinal;
      } else {
        //Essa condicional é a padrão que funciona para todos os outros signos
        $retorno = $condInicio && $condFinal;
      }
            
      return $retorno;
    }

    // Função que recebe uma data no formato de string com "d/m" e converte para "m/d" retornando um int de strtotime
    function converterDataSigno(string $date): int
    {
      $exDate = explode('/', $date);
      $invertDate = $exDate[1] . '/' . $exDate[0];
      return strtotime($invertDate);
    } 

    // Função responsável por retornar a URL da imagem de cada signo
    function getImagemSigno(string $nomeSigno): string 
    {
      $nome = iconv('UTF-8', 'ASCII//TRANSLIT', $nomeSigno);
      $nome = strtolower($nome);
      $urlImage = "https://d15m0zxbu4pm77.cloudfront.net/icones/estudos/signos/{$nome}/medio_{$nome}.png";
      return $urlImage;
    }    

    //Inclui o arquivo responsável por informar ao usuário o seu signo
    include 'mostrar-signo.php';