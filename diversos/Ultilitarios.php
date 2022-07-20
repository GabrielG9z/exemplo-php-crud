<?php
namespace CrudDiversos;
abstract class Ultilitarios {
    public static function trataMoeda(float $valor):string {
        return "R$".number_format($valor, 2, ",", ".");
    }

    public static function teste(array $dados) {
        echo"<pre>";
        var_dump($dados);
        echo"</pre>";
        }
    }
