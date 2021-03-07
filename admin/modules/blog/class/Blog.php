<?php
class BlogItem {

    public $BlogItemLang = array(
        "1" => array(
                "text" => "",
                "title" => ""
        ),
        "2" => array(
            "text" => "",
            "title" => ""
         )
    );
    public $BlogItemImagem = '';
    public $BlogItemID;
    function __construct($id,$lang=false,$imagem=false) {
        $this->BlogItemID = $id;
        if($lang)
            $this->BlogItemLang = $lang;
        if($imagem)
            $this->BlogItemImagem = $imagem;
    }


    public function GetLang(){
        return $this->BlogItemLang;
    }

    public function GetImage(){
        return $this->BlogItemImagem;
    }

    function GetID(){
        return $this->BlogItemID;
    }

    function PutLang($lang){
        $this->BlogItemLang = $lang;
    }

    function PutImage($image){
        $this->BlogItemImagem = $image;
    }

    function PutID($id){
       $this->BlogItemID = $id;
    }
  
}

?>