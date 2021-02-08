<?php
class GalleryItem {

    public $GalleryItemLang = array(
        "1" => array(
                "text" => "",
                "title" => ""
        ),
        "2" => array(
            "text" => "",
            "title" => ""
         )
    );
    public $GalleryItemImagem = array();
    public $GalleryItemID;
    function __construct($id,$lang=false,$imagem=false) {
        $this->GalleryItemID = $id;
        if($lang)
            $this->GalleryItemLang = $lang;
        if($imagem)
            $this->GalleryItemImagem = $imagem;
    }


    function GetLang(){
        return $this->GalleryItemLang;
    }

    function GetImage(){
        return $this->GalleryItemImagem;
    }

    function GetID(){
        return $this->GalleryItemID;
    }

    function PutLang($lang){
        $this->GalleryItemLang = $lang;
    }

    function PutImage($image){
        $this->GalleryItemImagem = $image;
    }

    function PutID($id){
       $this->GalleryItemID = $id;
    }
  
}

?>