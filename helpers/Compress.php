<?php

class Compress{

    public static function unzipFile($fileZip, $targetDir){
        $zip = new ZipArchive;
          
        // Zip File Name
        if ($zip->open($fileZip) === TRUE) {
          
            // Unzip Path
            $zip->extractTo($targeetDir);
            $zip->close();
            return true;
        } else {
            return false;
        }
    }// https://www.geeksforgeeks.org/how-to-unzip-a-file-using-php/

    // Compactar pasta recursivamente
    function zipFolder($source, $destination){
        if (!extension_loaded('zip') || !file_exists($source)) {
            return false;
        }

        $zip = new ZipArchive();
        if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
            return false;
        }

        $source = str_replace('\\', '/', realpath($source));

        if (is_dir($source) === true){
            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

          foreach ($files as $file){
                $file = str_replace('\\', '/', $file);

                // Ignore "." and ".." folders
                if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
                    continue;

                $file = realpath($file);
                if (is_dir($file) === true){					
                    $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                }else if (is_file($file) === true){
                    $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                }
            }
        }
        else if (is_file($source) === true)
        {
            $zip->addFromString(basename($source), file_get_contents($source));
        }

        return $zip->close();
	    // Crédito: http://stackoverflow.com/questions/1334613/how-to-recursively-zip-a-directory-in-php
    }
}
