<?php

class Cript
{
    //Funcao para encriptar uma determinada string
    public static function encriptar($txt){
        $count = 0;
        $resposta = ''; 
        while($count < strlen($txt)){
		    $texto = substr($txt, $count, 1);
		    /*
		    $resposta = $resposta.chr(ord($texto)+15);
		    */
		    $texto = ord($texto);
		    if(strlen($texto)<3){
		     $texto = '0'.$texto;
		    }
		    $resposta = $resposta.$texto;
            $count++;
        }
        return($resposta);
    }

    //Funcao para desencriptar uma determinada string
    public static function desencriptar($txt){
        $count = 0;
        $resposta = ''; 
        while($count < strlen($txt)){
		    $texto = substr($txt, $count, 3);
		    /*
		    $resposta = $resposta.chr(ord($texto)-15);
		    */
		    $resposta = $resposta.chr($texto);
            $count = $count+3;
        }
        return($resposta);
    }

    public static function generatePassword()
    {
        $length = 10;
        $symbols = ['!', '#', '=', '@', '+', '('];
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $charactersLength = strlen($characters);

        $randomString = '';

        // Generate the random alphanumeric string
        for ($i = 0; $i < $length; ++$i) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        // Make space for symbols by "cutting" the string
        $randomString = substr($randomString, 0, strlen($randomString) - count($symbols));

        foreach ($symbols as $key) {
            // Insert each symbol at random position
            $randomString = substr_replace($randomString, $key, random_int(1, strlen($randomString) - 1), 0);
        }

        return $randomString;
    }
}
