<?php
class GalleryDAL {
    public static function UpdateImage($image,$field){
        $sqlExec = "update tl_gallery set  ".$field." = '".$image."' where `id` = 1 ";
        return DataBase::ExecuteQuery($sqlExec);
    }

    public static function UpdateText($text,$id_lang,$field){
        $sqlExec = "update tl_gallery_lang set  ".$field." = '".$text."' where `id_tl_gallery` = 1 and  `id_sys_lang` = ".$id_lang;
        return DataBase::ExecuteQuery($sqlExec);
    }

    public static function SelectContact($id_lang){
        $sqlExec = "SELECT a.`image_head`  ,al.`description`  FROM `tl_gallery` a
        inner join  `tl_gallery_lang` al on   a.`id` = al.`id_tl_gallery`
        WHERE al.`id_sys_lang` = ".$id_lang." and a.`id` = 1 ";
        return DataBase::ExecuteQuery($sqlExec);
    }
    public static function CreateGallery(){
        $sqlExec = "INSERT INTO `tl_gallery_item` (`status`) values ('INACTIVE'); ";
        $id_gallery_item = DataBase::ExecuteQuery($sqlExec,'Insert');
        $sqlExec = "INSERT INTO `tl_gallery_item_lang` (`id_sys_lang`,`id_tl_gallery_item`,`status`) values (1,".$id_gallery_item.",'INACTIVE'); INSERT INTO `tl_gallery_item_lang` (`id_sys_lang`,`id_tl_gallery_item`,`status`) values (2,".$id_gallery_item.",'INACTIVE'); ";
        DataBase::ExecuteQuery($sqlExec,'Insert');
        return $id_gallery_item;
        
    }
}

?>