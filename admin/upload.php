<?php
if($_FILES['file']['name'] != '' ){
    $extension =  explode('.', $_FILES['file']['name']);
    $extension = end($extension);    
    $name = rand(100000000,999999999).'.'.$extension;

    $location = 'images/'.$name;
    move_uploaded_file($_FILES['file']['tmp_name'], $location);

    echo $location;
}

?>