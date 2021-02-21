<?php

Class Update{
    
    public static function UpdateTMP($fileUpload)
    {
        $extension =  explode('.', $fileUpload['name']);
        $extension = end($extension);    
        $name = rand(100000000,999999999).'.'.$extension;

        $location = 'imagesTMP/'.$name;
        move_uploaded_file($fileUpload['tmp_name'], $location);

        return $name;
    }
    public static function MoveFileTo($file,$to)
    { 
        $locationDestiny = $to.$file;
        $locationOrigin = 'imagesTMP/'.$file;

        if(file_exists($locationOrigin)){
            rename($locationOrigin,$locationDestiny);
            return true;
        }
       
        return false;
    }

    public static function DeleteFile($file,$path)
    {
        if(file_exists($path.$file)){
            unlink($path.$file);
            echo $path.$file;
            return true;
        }   
       
        return false;
    }

}
?>
