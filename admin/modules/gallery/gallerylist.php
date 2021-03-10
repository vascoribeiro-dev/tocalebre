
<?php
   include("DAL/GalleryDAL.php");
   include("class/GalleryList.php");
   $OrderAjax = BasicWorks::ParameterHelper('o',false,'POST');

   $title = 'Galeria';

   if($OrderAjax){
      switch($OrderAjax){
         case 'changelang':

            exit;
         break;
      }
   }

   $rowsGallery = array();
   $table =  GalleryList::CreateTableGallery($rowsGallery);
   $arrayHTML['TABLE'] = $table ;
   $body =  BasicWorks::CreateTemplate('modules/gallery/template/gallerylist.tpl',$arrayHTML);
?>
