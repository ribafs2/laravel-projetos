<?php

class Files{

    // Checar se arquivo existe
    public static function fileExists($file){
        if(file_exists($file)){
            return true;
        }else{
            return false;
        }
    }

    // Renomear arquivo. Se newName existir será sobrescrito
    public static function fileRename($oldName, $newName){
        $result = rename($oldName, $newName);
        return $result;
    }

    // Gravar $content em $file
    public static function writeFile($file, $content){
        if(is_writable($file)){
            $fp = fopen($file, "w");
            fwrite($fp, $content); // grava a string no arquivo. Se não existir será criado
            fclose($fp);
        }else{
            return false;
        }
    }

    // Retorna o conteúdo completo de um arquivo
    public static function readFile($file){
        $fp = fopen($file, "r");
        $content = fread($fp, filesize ($file));
        fclose($fp);
        return $content;
    }

    // Retorna o conteúdo completo de um arquivo para a string $content
    public static function readFile2($file){
        $fp = fopen($file, "r");
        $content = file_get_contents($file, true);
        fclose($fp);
        return $content;
    }

    // Retorna o conteúdo de uma linha de um arquivo
    public static function readFileLine($file, $lineNumber){
        $lines = file($file);
        foreach($lines as $key=>$line){
            if($key == $lineNumber){
                return $line;
            }
        }
    }

    // Ler conteúdo de arquivo caractere a caractere
    public static function readChar($file){
        $char='';
        $fp = fopen($file, "r");
        while (!feof($fp)){
            $char .= fgetc($fp);
        } 
        fclose($fp);
        return $char."<br><br>";
    }

    public static function fileCountLines($file){
        $line_count = count (file ($file));
        return $line_count;
    }

    // Ler de forma inversa (Do final para o começo) um arquivo, linha a linha
    public static function readInverseFile($file){
        $f_contents = array_reverse (file ($file));
        return $f_contents;
    }

    // Ler aleatoriamente uma linha de arquivo (usado no pensamento do dia)
    public static function readRandomFile($file){
        $f_contents = file ($file);
        srand ((double)microtime()*1000000);
        $rand_line = $f_contents[ rand (0, (count ($f_contents) - 1)) ];
        return $rand_line;
    }

    // Excluir um arquivo
    public static function deleteFile($file){
        $ret = unlink ($file);
        if ($ret){
	        return true;
        }else{
	        return false;
        }
    }

    // Copiar arquivos. Entrar com path full (/var/www/html/src.php) para $src e $dest ou relativo ('../src.php')
    public static function copyFile($src, $dest){
        if (copy ($src, $dest)){
	        return true;
        }else{
            return false;
        }
    }

    // Checar se arquivo pode ser lido
    public static function isFileReadable($file){
        if (is_readable($file)) {
            return true;
        }else{
	        return false;
        }
    }

    // Checar se arquivo tem permissão de escrita
    public static function isFileWritable($file){
        if(is_writable($file)){
            return true;
        }else{
            return false;
        }
    }

    // Copiar uma pasta com todos os arquivos e subpastas recursivamente
    // Crédito - https://stackoverflow.com/questions/2050859/copy-entire-contents-of-a-directory-to-another-using-php#2050909
    public static function folderCopy($src,$dst) { 
        $dir = opendir($src); 
        mkdir($dst); 
        while(false !== ( $file = readdir($dir)) ) { 
            if (( $file != '.' ) && ( $file != '..' )) { 
                if ( is_dir($src . '/' . $file) ) { 
                    recurse_copy($src . '/' . $file,$dst . '/' . $file); 
                } else { 
                    copy($src . '/' . $file,$dst . '/' . $file); 
                } 
            } 
        } 
        closedir($dir); 
    } 
    // Caso a pasta de destino não exista será criada. copyDir('/pasta1', '/pastaCopiada');

    // Excluir um arquivo. Entrar com path full (/var/www/html/src.php) ou relativo ('../src.php')
    public static function fileDelete($file){
        $result = unlink($file);
        return $result;
    }

    // Criar um novo diretório. Entrar com path full (/var/www/html/dir1) ou relativo ('../dir1')
    public static function fileDir($dir){
        $result = mkdir($dir);
        return $result;
    }

    // retornar o arquivo atual
    public static function currentFile(){
        $result = basename(__FILE__);
        return $result;
    }

    // retornar o diretório atual
    public static function currentDir(){
        $result = basename(__DIR__);
        return $result;
    }

    // retornar primeira linha de arquivo
    public static function firstLine($file){
        $file_lines = file($file);
        return $file_lines[0];
    }

	// Retorna o tamanho de um diretórior ecursivamente
	function dirSize(string $directory) {
		$size = 0;
		foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) as $file){
		    $size+=$file->getSize();
		}
		if($size<1024){
			$size=$size." Bytes";
		}elseif(($size<1048576)&&($size>1023)){
			$size=round($size/1024, 1)." KB";
		}elseif(($size<1073741824)&&($size>1048575)){
			$size=round($size/1048576, 1)." MB";
		}else{
			$size=round($size/1073741824, 1)." GB";
		}

		return $size;
		// https://stackoverflow.com/questions/478121/how-to-get-directory-size-in-php
	} 
	// print dirSize('joomla');

    //Funcao para retornar a extensao de um arquivo
    public static function show_extension($file){
     if(is_file($file)){
       $fileInfo = pathinfo($file);
       $extension=$fileInfo["extension"];
     } else {
       $extension="";   
     }
     return $extension;
    }

    // Verificar se arquivo pode ser alterado/writable
    public static function isWritable($file){
        if (is_writable($file)) {
            return true;
        } else {
            return false;
        }
    }

    // Verificar se arquivo pode ser lido/readable
    public static function isReadable($file){
        if (is_executadable($file)) {
            return true;
        } else {
            return false;
        }
    }

    // Verificar se arquivo é executável/executable
    public static function isExecutable($file){
        if (is_readable($file)) {
            return true;
        } else {
            return false;
        }
    }

    public static function fileCheck($file){
        $functions = [
	        'is_readable',
	        'is_writable',
	        'is_executable'
        ];

        foreach ($functions as $type) {
	        return $type;
        }   
    }
}

/*
    $ret=Files::fileExists(app_path('te.txt'));
    print $ret;
*/
