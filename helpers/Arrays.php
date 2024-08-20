<?php

/**
 * Tamanho de array: count(), sizeof()
 * Elementos de array: for(), while(), foreach()
 * Ordenando: sort($array), ksort($chave) e reversa: rsort() e krsort(), aleatória: shuffle($array)
 */

class Arrays{

    // Remover elementos duplicados de array
    public static function arrayUnique($array){
        $ar=array_unique($array);
        return $ar;
    }

    // Juntando dois arrays
    public static function arrayMerge($ar1, $ar2){
        $result=array_merge($ar1,$ar2);
        return $result;
    }    

    // Busca em array
    public static function arraySearch($element, $ar){
        $result = array_search($element,$ar);
        return $result;
    }

    // Soma todos os elementos de um array
    public static function arraySum($array){
        $result = array_sum($array);
        return $result;
    }

    // Retornar o último elemento de um array
    public static function arrayLast($array){
        $result = array_pop($array);
        return $result;
    }

    // Adiciona um elemento ao final de um array
    public static function arrayAdd($array, $element){
        $result = array_push($array, $element);
        return $result;
    }

    // Retorna todos os valores de um array
    public static function arrayValues($array){
        $result = array_values($array);
        return $result;
    }

    // Retorna todas as chaves de um array
    public static function arrayKeys($array){
        $result = array_keys($array);
        return $result;
    }

    // Pegar parte/fatia de um array
    public static function arrayPart($array, $parti, $partf){
        $result = array_slice($array, $parti, $partf);
        return $result;
    }

}
/*
$a = Arrays::array("a", "b", "c", "d", "e");
$b = Arrays::arrayPart($a, 0,3);//Array ( [0] => a [1] => b [2] => c )  
print_r($b);
*/
