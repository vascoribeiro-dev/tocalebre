
<?php
   include("DAL/GalleryDAL.php");
   $OrderAjax = BasicWorks::ParameterHelper('o',false,'POST');

   $title = 'Galeria';

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

   $arrayAbout =  GalleryDAL::SelectContact(1);

   $arrayHTML['IMAGEHEAD'] =  $arrayAbout[0]["image_head"];
   $arrayHTML['DESCSHORT'] = $arrayAbout[0]["description"];



   $body =  BasicWorks::CreateTemplate('modules/gallery/template/gallery.tpl',$arrayHTML);


?>
