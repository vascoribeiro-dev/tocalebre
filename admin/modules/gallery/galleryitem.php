
<?php
   include("DAL/GalleryDAL.php");
   include("class/GalleryItem.php");
   $OrderAjax = BasicWorks::ParameterHelper('o',false,'POST');
   $galleryId = BasicWorks::ParameterHelper('v',false,'GET');

   if($OrderAjax){
      switch($OrderAjax){
         case 'changelang':
      
            exit;
         break;

      }
   }

   $title = 'Criar Item para Galeria';

   $arrayHTML['TITLEGALLARY'] = '';
   $arrayHTML['DESCSHORT'] = '';

   if($galleryId){
      $galleryItem = new GalleryItem($galleryId);
      $arrayHTML['TITLEGALLARY'] = $arrayLang[1]['text'];
      $arrayHTML['DESCSHORT'] = $arrayLang[1]['title'];
      $arrayHTML['GALLERYID'] = $galleryId;
   }else{
      $galleryItem = new GalleryItem(-1);
      $_SESSION['CLASSGALLERY'] = $galleryItem;
      $arrayHTML['GALLERYID'] = -1;
   }

   $body =  BasicWorks::CreateTemplate('modules/gallery/template/galleryitem.tpl',$arrayHTML);
?>
