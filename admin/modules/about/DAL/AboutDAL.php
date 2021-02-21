<?php
class AboutDAL {
    public static function UpdateImage($image,$field){
        $sqlExec = "update tl_about set  ".$field." = '".$image."' where `id` = 1 ";
        return DataBase::ExecuteQuery($sqlExec,"Update");
    }

    public static function UpdateText($text,$id_lang,$field){
        $sqlExec = "update tl_about_lang set  ".$field." = '".$text."' where `id_tl_about` = 1 and  `id_sys_lang` = ".$id_lang;
        return DataBase::ExecuteQuery($sqlExec,"Update");
    }

    public static function SelectAbout($id_lang){
        $sqlExec = "SELECT a.`image_head` ,a.`image_1` ,a.`image_2`, a.`image_3` ,al.`description_long` ,al.`description_short` FROM `tl_about` a
        inner join  `tl_about_lang` al on   a.`id` = al.`id_tl_about`
        WHERE al.`id_sys_lang` = ".$id_lang." and a.`id` = 1 ";
        return DataBase::ExecuteQuery($sqlExec);
    }
}

?>