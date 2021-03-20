<?php

Class Update{
    
    public static function UpdateTMP($fileUpload)
    {
        $extension =  explode('.', $fileUpload['name']);
        $extension = end($extension);    
        $name = rand(100000000,999999999).'.'.$extension;

        $location = 'imagesTMP/'.$name;
        move_uploaded_file($fileUpload['tmp_name'], $location);
    
        return $location;
    }

    public static function MoveFileTo($pathTMP,$to)
    { 
        $file = str_replace("imagesTMP/", "", $pathTMP);
        $locationDestiny = $to.$file;
        $locationOrigin = $pathTMP;
        if(file_exists($locationOrigin)){
            if(rename($locationOrigin,$locationDestiny)){
                Update::DeleteFile($locationOrigin);
                return $locationDestiny;
            }
        }
       
        return false;
    }

    public static function DeleteFile($pathFile)
    {
        if(file_exists($pathFile)){
            unlink($pathFile);
            return true;
        }   
       
        return false;
    }

}
?>
