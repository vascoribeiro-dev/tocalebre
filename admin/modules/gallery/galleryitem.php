
<?php
   include("DAL/GalleryDAL.php");
   include("class/GalleryItem.php");
   $OrderAjax = BasicWorks::ParameterHelper('o',false,'GETorPOST');
   $CLASSGALLERY = BasicWorks::ParameterHelper('CLASSGALLERY',false,'SESSION');
   $langId = BasicWorks::ParameterHelper('langId',1,'POST');

   if($OrderAjax){
      switch($OrderAjax){
         case 'updateimage':
     
            exit;
         break; 
         case 'updateclass':
            $title = BasicWorks::ParameterHelper('title',false,'POST');
            $text = BasicWorks::ParameterHelper('text',false,'POST');

            $galleryItem = unserialize($CLASSGALLERY);
            $arrayLang = $galleryItem -> GetLang();
            $arrayLang[$langId]['title'] = $title;
            $arrayLang[$langId]['text'] = $text;
            
            $galleryItem -> PutLang($arrayLang);
            $_SESSION['CLASSGALLERY'] = serialize($galleryItem);
            exit;
         break;
         case 'changelang':
            $galleryItem = unserialize($CLASSGALLERY);
            $arrayLang = $galleryItem -> GetLang();
            $arrayGetLang['title'] = $arrayLang[$langId]['title'];
            $arrayGetLang['text'] = $arrayLang[$langId]['text'];
            $getLangJSON = json_encode($arrayGetLang);
            echo $getLangJSON;
            exit;
         break;
         case 'update':
            $nameImagem = Update::UpdateTMP($_FILES['file']);
            echo $nameImagem;
            exit;
         break;
      }
   }

   $title = 'Criar Item para Galeria';

   $arrayHTML['TITLEGALLARY'] = '';
   $arrayHTML['DESCSHORT'] = '';

   if($CLASSGALLERY){
    $galleryItem =  unserialize($CLASSGALLERY);
       $arrayLang = $galleryItem -> GetLang();
      $arrayHTML['TITLEGALLARY'] = $arrayLang[$langId]['title'];
      $arrayHTML['DESCSHORT'] = $arrayLang[$langId]['text'];
    //$arrayHTML['GALLERYID'] = $galleryId;
   }else{
      $galleryItem = new GalleryItem(-1);
      $_SESSION['CLASSGALLERY'] = serialize($galleryItem);
      $arrayHTML['TITLEGALLARY'] =  "";
      $arrayHTML['DESCSHORT'] = "";
      $arrayHTML['GALLERYID'] = -1;
   }

   $body =  BasicWorks::CreateTemplate('modules/gallery/template/galleryitem.tpl',$arrayHTML);
?>
