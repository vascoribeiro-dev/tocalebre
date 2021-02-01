
<?php
   include("DAL/AboutDAL.php");
   $OrderAjax = BasicWorks::ParameterHelper('o',false,'POST');

   $title = 'Sobre';

   if($OrderAjax){
      switch($OrderAjax){
         case 'changelang':
            $langid = BasicWorks::ParameterHelper('langid',false,'POST');
            $arrayAbout =  AboutDAL::SelectAbout($langid);
             $AboutJSON=json_encode($arrayAbout);
            echo $AboutJSON;
            exit;
         break;
         case 'updateimagehead':
            $imageHead = BasicWorks::ParameterHelper('imagemName',false,'POST');
            AboutDAL::UpdateImage($imageHead,"image_head");
            exit;
         break;
         case 'updateimage1':
            $imageHead = BasicWorks::ParameterHelper('imagemName',false,'POST');
            AboutDAL::UpdateImage($imageHead,"image_1");
            exit;
         break;
         case 'updateimage2':
            $imageHead = BasicWorks::ParameterHelper('imagemName',false,'POST');
            AboutDAL::UpdateImage($imageHead,"image_2");
            exit;
         break;
         case 'updateimage3':
            $imageHead = BasicWorks::ParameterHelper('imagemName',false,'POST');
            AboutDAL::UpdateImage($imageHead,"image_3");
            exit;
         break;
         case 'updatetext':
            $langid = BasicWorks::ParameterHelper('langid',false,'POST');
            $text = BasicWorks::ParameterHelper('textName',false,'POST');
            AboutDAL::UpdateText($text,$langid,'description_short');
            exit;
         break;
         case 'updatetextlong':
            $langid = BasicWorks::ParameterHelper('langid',false,'POST');
            $text = BasicWorks::ParameterHelper('textName',false,'POST');
            AboutDAL::UpdateText($text,$langid,'description_long');
            exit;
         break;
      }
   }

   $arrayAbout =  AboutDAL::SelectAbout(1);

   $arrayHTML['IMAGEHEAD'] =  $arrayAbout[0]["image_head"];
   $arrayHTML['IMAGEM1'] = $arrayAbout[0]["image_1"] ;
   $arrayHTML['IMAGEM2'] = $arrayAbout[0]["image_2"] ;
   $arrayHTML['IMAGEM3'] = $arrayAbout[0]["image_3"] ;
   $arrayHTML['DESCSHORT'] = $arrayAbout[0]["description_short"];
   $arrayHTML['DESCLONG'] = $arrayAbout[0]["description_long"];
   $body =  BasicWorks::CreateTemplate('modules/about/template/about.tpl',$arrayHTML);


?>
