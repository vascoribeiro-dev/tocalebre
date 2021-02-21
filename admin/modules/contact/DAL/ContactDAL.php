<?php
class ContactDAL {

    public static function UpdateImage($image,$field){
        $sqlExec = "update tl_contact set  ".$field." = '".$image."' where `id` = 1 ";
        return DataBase::ExecuteQuery($sqlExec,"Update");
    }

    public static function UpdateText($text,$id_lang,$field){
        $sqlExec = "update tl_contact_lang set  ".$field." = '".$text."' where `id_tl_contact` = 1 and  `id_sys_lang` = ".$id_lang;
        return DataBase::ExecuteQuery($sqlExec,"Update");
    }

    public static function SelectContact($id_lang){
        $sqlExec = "SELECT a.`image_head` ,a.`image_body` ,al.`description_long` ,al.`description_short` FROM `tl_contact` a
        inner join  `tl_contact_lang` al on   a.`id` = al.`id_tl_contact`
        WHERE al.`id_sys_lang` = ".$id_lang." and a.`id` = 1 ";
        return DataBase::ExecuteQuery($sqlExec);
    }
}

?>
   
