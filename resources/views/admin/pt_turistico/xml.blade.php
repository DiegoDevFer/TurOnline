@extends('layouts.app')
@section('content')

    <?php
//    $link = "http://www.agencia.ac.gov.br/evento/evento-cultural/feed/"; //link do arquivo xml
//    $xml = simplexml_load_file($link) -> channel; //carrega o arquivo XML e retornando um Array

    foreach($xml -> item as $item){ //faz o loop nas tag com o nome "item"
            json_encode($item);
//        echo "<strong>Autor:</strong> ".utf8_decode($item -> title)."<br />";
//        echo "<strong>Data:</strong> ".utf8_decode($item -> description)."<br />";
//        echo "<br />";
    } //fim do foreach
    ?>
@stop