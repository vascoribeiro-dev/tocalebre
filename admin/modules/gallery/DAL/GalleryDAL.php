<?php
class GalleryDAL {
    public static function SelectGalleryItem($id_lang,$idGalleryItem = false,$namesearch = false,$datatableslength = false){
        $sqlExec = "SELECT a.id,al.`text`,al.`title`, a.`status`
        FROM `tl_gallery_items` a
        inner join  `tl_gallery_item_lang` al on   a.`id` = al.`id_tl_gallery_item`
        WHERE a.status in ('ACTIVE','SUSPENDED') and al.`id_sys_lang` =  ".$id_lang." ".($idGalleryItem ? " and a.id = ".$idGalleryItem  : "")
        ." ".($namesearch ? " and al.`title` like '%".$namesearch."%'  " : "")
        ." ".($datatableslength ? " LIMIT ".$datatableslength." OFFSET 0 " : "");
        return DataBase::ExecuteQuery($sqlExec);
    }

    

    public static function GetAllGalleryImage($idGalleryItem){
        $sqlExec = "SELECT * FROM `tl_gallery_item_images` where  `id_tl_gallery_item` = ".$idGalleryItem; 
        return DataBase::ExecuteQuery($sqlExec);
    }

    public static function GetGalleryOneorAll($idGalleryItem = false){
        $sqlExec = "SELECT a.id,al.`text`,al.`title`, a.`status`, al.id_sys_lang
        FROM `tl_gallery_items` a
        inner join  `tl_gallery_item_lang` al on   a.`id` = al.`id_tl_gallery_item`
        ".($idGalleryItem ? " WHERE  a.id = ".$idGalleryItem  : "");
        return DataBase::ExecuteQuery($sqlExec);
    }

    public static function UpdateStatusGalleryItem($idGalleryItem,$status){
        $sqlExec = "UPDATE `tl_gallery_items`  SET `status` = '".$status."'  WHERE `id` = ".$idGalleryItem.";";
        DataBase::ExecuteQuery($sqlExec,"Update");
        $sqlExec = "UPDATE `tl_gallery_item_lang`  SET `status` = '".$status."'  WHERE `id_tl_gallery_item` = ".$idGalleryItem.";";
        return DataBase::ExecuteQuery($sqlExec,"Update");
    }

    public static function UpdateGalleryItemLang($title,$text,$idblog,$idlang){
        $sqlExec = "UPDATE `tl_gallery_item_lang`  SET `text` = '".$text."' , `title` = '".$title."' WHERE `id_tl_gallery_item` = ".$idblog."  and `id_sys_lang` = ".$idlang." ";
        return DataBase::ExecuteQuery($sqlExec,"Update");
    }

    public static function UpdateImageItem($image,$field){
        $sqlExec = "update tl_gallery set  ".$field." = '".$image."' where `id` = 1 ";
        return DataBase::ExecuteQuery($sqlExec,"Update");
    }

    public static function UpdateImage($image,$field){
        $sqlExec = "update tl_gallery set  ".$field." = '".$image."' where `id` = 1 ";
        return DataBase::ExecuteQuery($sqlExec,"Update");
    }

    public static function UpdateText($text,$id_lang,$field){
        $sqlExec = "update tl_gallery_lang set  ".$field." = '".$text."' where `id_tl_gallery` = 1 and  `id_sys_lang` = ".$id_lang;
        return DataBase::ExecuteQuery($sqlExec,"Update");
    }

    public static function SelectGallery($id_lang){
        $sqlExec = "SELECT a.`image_head`  ,al.`description`  FROM `tl_gallery` a
        inner join  `tl_gallery_lang` al on   a.`id` = al.`id_tl_gallery`
        WHERE al.`id_sys_lang` = ".$id_lang." and a.`id` = 1 ";
        return DataBase::ExecuteQuery($sqlExec);
    }

    public static function InsertGalleryItem(){
        $sqlExec = "INSERT tl_gallery_items (STATUS) VALUES ('ACTIVE')";
        return DataBase::ExecuteQuery($sqlExec,"Insert");
    }
    public static function InsertGalleryItemImageItem($image,$idGalleryItem){
        $sqlExec = "INSERT `tl_gallery_item_images` (`id_tl_gallery_item`,`image`) VALUES (".$idGalleryItem.",'".$image."');";
        return DataBase::ExecuteQuery($sqlExec,"Insert");
    }

    public static function DeleteGalleryItemImageItem($idGalleryItem){
        $sqlExec = "DELETE FROM  `tl_gallery_item_images` where `id_tl_gallery_item` = ".$idGalleryItem.";";
        return DataBase::ExecuteQuery($sqlExec,"update");
    }

    public static function InsertGalleryItemLang($title,$text,$idGalleryItem,$idlang){
        $sqlExec = "INSERT `tl_gallery_item_lang` (`id_tl_gallery_item`,`id_sys_lang`,`text`,`title`) VALUES (".$idGalleryItem.",".$idlang.",'".$text."','".$title."');";
        return DataBase::ExecuteQuery($sqlExec,"Insert");
    }
}

?>