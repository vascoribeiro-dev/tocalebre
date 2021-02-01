
<?php
   include("DAL/ContactDAL.php");
   $OrderAjax = BasicWorks::ParameterHelper('o',false,'POST');

   $title = 'Contacta-me';

   if($OrderAjax){
      switch($OrderAjax){
         case 'changelang':
            $langid = BasicWorks::ParameterHelper('langid',false,'POST');
            $arrayAbout =  ContactDAL::SelectContact($langid);
             $AboutJSON=json_encode($arrayAbout);
            echo $AboutJSON;
            exit;
         break;
         case 'updateimagehead':
            $imageHead = BasicWorks::ParameterHelper('imagemName',false,'POST');
            ContactDAL::UpdateImage($imageHead,"image_head");
            exit;
         break;
         case 'updateimage1':
            $imageHead = BasicWorks::ParameterHelper('imagemName',false,'POST');
            ContactDAL::UpdateImage($imageHead,"image_body");
            exit;
         break;
         case 'updatetext':
            $langid = BasicWorks::ParameterHelper('langid',false,'POST');
            $text = BasicWorks::ParameterHelper('textName',false,'POST');
            ContactDAL::UpdateText($text,$langid,'description_short');
            exit;
         break;
         case 'updatetextlong':
            $langid = BasicWorks::ParameterHelper('langid',false,'POST');
            $text = BasicWorks::ParameterHelper('textName',false,'POST');
            ContactDAL::UpdateText($text,$langid,'description_long');
            exit;
         break;
      }
   }

   $arrayAbout =  ContactDAL::SelectContact(1);

   $arrayHTML['IMAGEHEAD'] =  $arrayAbout[0]["image_head"];
   $arrayHTML['IMAGEM1'] = $arrayAbout[0]["image_body"] ;
   $arrayHTML['DESCSHORT'] = $arrayAbout[0]["description_short"];
   $arrayHTML['DESCLONG'] = $arrayAbout[0]["description_long"];


   $body =  BasicWorks::CreateTemplate('modules/contact/template/contact.tpl',$arrayHTML);


?>
