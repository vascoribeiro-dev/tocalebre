
<?php
   include("DAL/GalleryDAL.php");
   $OrderAjax = BasicWorks::ParameterHelper('o',false,'POST');

   $title = 'Criar Item para Galeria';

   if($OrderAjax){
      switch($OrderAjax){
         case 'changelang':
      
            exit;
         break;

      }
   }


   $body =  BasicWorks::CreateTemplate('modules/gallery/template/galleryitem.tpl',$arrayHTML);


?>
