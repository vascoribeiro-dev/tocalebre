<?php
class BlogDAL {
    public static function SelectBlog($id_lang,$id_blog = false,$namesearch = false,$datatableslength = false){
        $sqlExec = "SELECT a.id,a.date, a.`image`  ,al.`text`  ,al.`title`, a.`status`    FROM `tl_blogs` a
        inner join  `tl_blog_lang` al on   a.`id` = al.`id_tl_blog`
        WHERE a.status in ('ACTIVE','SUSPENDED') and al.`id_sys_lang` =  ".$id_lang." ".($id_blog ? " and a.id = ".$id_blog  : "")
        ." ".($namesearch ? " and al.`title` like '%".$namesearch."%'  " : "")
        ." ".($datatableslength ? " LIMIT ".$datatableslength." OFFSET 0 " : "");
        
        return DataBase::ExecuteQuery($sqlExec);
    }

    public static function UpdateStatusBlog($idblog,$status){
        $sqlExec = "UPDATE `tl_blogs`  SET `status` = '".$status."'  WHERE `id` = ".$idblog.";";
        DataBase::ExecuteQuery($sqlExec,"Update");
        $sqlExec = "UPDATE `tl_blog_lang`  SET `status` = '".$status."'  WHERE `id_tl_blog` = ".$idblog.";";
        return DataBase::ExecuteQuery($sqlExec,"Update");
    }

    public static function GetBlogOneorAll($id_blog = false){
        $sqlExec = "SELECT a.id,a.date, a.`image`  ,al.`text`  ,al.`title`, a.`status`, al.`id_sys_lang`   FROM `tl_blogs` a
        inner join  `tl_blog_lang` al on   a.`id` = al.`id_tl_blog`
        ".($id_blog ? " WHERE  a.id = ".$id_blog  : "");
        return DataBase::ExecuteQuery($sqlExec);
    }
    public static function InsertBlogLang($title,$text,$idblog,$idlang){
        $sqlExec = "INSERT `tl_blog_lang` (`id_tl_blog`,`id_sys_lang`,`text`,`title`) VALUES (".$idblog.",".$idlang.",'".$text."','".$title."');";
        return DataBase::ExecuteQuery($sqlExec,"Insert");
    }
    public static function InsertBlog($image){
        $sqlExec = "INSERT `tl_blogs` (`image`,`date`) VALUES ('".$image."','".CURRENTDATETIME."');";
        return DataBase::ExecuteQuery($sqlExec,"Insert");
    }
    public static function UpdateBlogLang($title,$text,$idblog,$idlang){
        $sqlExec = "UPDATE `tl_blog_lang`  SET `text` = '".$text."' , `title` = '".$title."' WHERE `id_tl_blog` = ".$idblog."  and `id_sys_lang` = ".$idlang." ";
        return DataBase::ExecuteQuery($sqlExec,"Update");
    }
    public static function UpdateBlog($image,$idblog){
        $sqlExec = "UPDATE `tl_blogs`  SET `image` = '".$image."' , `date` = '".CURRENTDATETIME."' WHERE `id` = ".$idblog;
        return DataBase::ExecuteQuery($sqlExec,"Update");
    }
}

?>