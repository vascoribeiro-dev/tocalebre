
<?php
   include("DAL/ContactDAL.php");
   $OrderAjax = BasicWorks::ParameterHelper('o',false,'GETorPOST');

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
            $arrayContact = ContactDAL::SelectContact(1);
            if(Update::MoveFileTo($imageHead,PATHIMAGE)){
               $file = str_replace("imagesTMP/", "", $imageHead);
               $locationDestiny = PATHIMAGE.$file;
               ContactDAL::UpdateImage($locationDestiny,"image_head");
               if($arrayContact){
                  Update::DeleteFile($arrayContact[0]["image_head"],PATHIMAGE);
               }
            }
            exit;
         break;
         case 'updateimage1':
            $imageBody = BasicWorks::ParameterHelper('imagemName',false,'POST');
            ContactDAL::UpdateImage($imageBody,"image_body");
            if(Update::MoveFileTo($imageBody,PATHIMAGE)){
               $file = str_replace("imagesTMP/", "", $imageBody);
               $locationDestiny = PATHIMAGE.$file;
               ContactDAL::UpdateImage($locationDestiny,"image_body");
               if($arrayContact){
                  Update::DeleteFile($arrayContact[0]["image_body"],PATHIMAGE);
               }
            }
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
         case 'update':
            $nameImagem = Update::UpdateTMP($_FILES['file']);
            echo $nameImagem;
            exit;
         break;
      }
   }

   $arrayContact =  ContactDAL::SelectContact(1);

   $arrayHTML['IMAGEHEAD'] =  $arrayContact[0]["image_head"];
   $arrayHTML['IMAGEM1'] = $arrayContact[0]["image_body"] ;
   $arrayHTML['DESCSHORT'] = $arrayContact[0]["description_short"];
   $arrayHTML['DESCLONG'] = $arrayContact[0]["description_long"];


   $body =  BasicWorks::CreateTemplate('modules/contact/template/contact.tpl',$arrayHTML);


?>
