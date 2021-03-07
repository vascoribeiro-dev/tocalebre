<?php
class BlogDAL {
    public static function SelectBlog($id_lang,$id_blog = false){
        $sqlExec = "SELECT a.id,a.date, a.`image`  ,al.`text`  ,al.`title`   FROM `tl_blogs` a
        inner join  `tl_blog_lang` al on   a.`id` = al.`id_tl_blog`
        WHERE al.`id_sys_lang` =  ".$id_lang." ".($id_blog ? " and a.id = ".$id_blog  : "");
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
}

?>