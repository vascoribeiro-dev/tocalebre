
<?php
   include("DAL/GalleryDAL.php");
   $OrderAjax = BasicWorks::ParameterHelper('o',false,'POST');

   $title = 'Criar Item para Galeria';

   if($OrderAjax){
      switch($OrderAjax){
         case 'changelang':
            $langid = BasicWorks::ParameterHelper('langid',false,'POST');
            $arrayAbout =  GalleryDAL::SelectContact($langid);
             $AboutJSON=json_encode($arrayAbout);
            echo $AboutJSON;
            exit;
         break;
         case 'updateimagehead':
            $imageHead = BasicWorks::ParameterHelper('imagemName',false,'POST');
            GalleryDAL::UpdateImage($imageHead,"image_head");
            exit;
         break;
         case 'updatetext':
            $langid = BasicWorks::ParameterHelper('langid',false,'POST');
            $text = BasicWorks::ParameterHelper('textName',false,'POST');
            GalleryDAL::UpdateText($text,$langid,'description');
            exit;
         break;
      }
   }


   $body =  BasicWorks::CreateTemplate('modules/gallery/template/galleryitem.tpl',$arrayHTML);


?>
