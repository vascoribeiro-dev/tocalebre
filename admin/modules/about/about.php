
<?php
   include("DAL/AboutDAL.php");
   $OrderAjax = BasicWorks::ParameterHelper('o',false,'GETorPOST');

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
            $arrayAbout =  AboutDAL::SelectAbout(1);
            if(Update::MoveFileTo($imageHead,PATHIMAGE)){
               AboutDAL::UpdateImage($imageHead,"image_head");
               if($arrayAbout){
                  Update::DeleteFile($arrayAbout[0]["image_head"],PATHIMAGE);
               }
            }
            exit;
         break;
         case 'updateimage1':
            $image1 = BasicWorks::ParameterHelper('imagemName',false,'POST');
            $arrayAbout =  AboutDAL::SelectAbout(1);
            if(Update::MoveFileTo($image1,PATHIMAGE)){
               AboutDAL::UpdateImage($image1,"image_1");
               if($arrayAbout){
                  Update::DeleteFile($arrayAbout[0]["image_1"],PATHIMAGE);
               }
            }
            exit;
         break;
         case 'updateimage2':
            
            $image2 = BasicWorks::ParameterHelper('imagemName',false,'POST');
            $arrayAbout =  AboutDAL::SelectAbout(1);
            if(Update::MoveFileTo($image2,PATHIMAGE)){
               AboutDAL::UpdateImage($image2,"image_2");
               if($arrayAbout){
                  Update::DeleteFile($arrayAbout[0]["image_2"],PATHIMAGE);
               }
            }
            exit;
         break;
         case 'updateimage3':
            $image3 = BasicWorks::ParameterHelper('imagemName',false,'POST');
            $arrayAbout =  AboutDAL::SelectAbout(1);
            if(Update::MoveFileTo($image3,PATHIMAGE)){
               AboutDAL::UpdateImage($image3,"image_3");
               if($arrayAbout){
                  Update::DeleteFile($arrayAbout[0]["image_3"],PATHIMAGE);
               }
            }
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
         case 'update':
            $nameImagem = Update::UpdateTMP($_FILES['file']);
            echo $nameImagem;
            exit;
         break;
      }
   }

   $arrayAbout =  AboutDAL::SelectAbout(1);

   $arrayHTML['IMAGEHEAD'] =  PATHIMAGE.$arrayAbout[0]["image_head"];
   $arrayHTML['IMAGEM1'] = PATHIMAGE.$arrayAbout[0]["image_1"] ;
   $arrayHTML['IMAGEM2'] = PATHIMAGE.$arrayAbout[0]["image_2"] ;
   $arrayHTML['IMAGEM3'] = PATHIMAGE.$arrayAbout[0]["image_3"] ;
   $arrayHTML['DESCSHORT'] = $arrayAbout[0]["description_short"];
   $arrayHTML['DESCLONG'] = $arrayAbout[0]["description_long"];
   $body =  BasicWorks::CreateTemplate('modules/about/template/about.tpl',$arrayHTML);


?>
