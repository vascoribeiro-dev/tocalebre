
<?php
   include("DAL/GalleryDAL.php");
   $OrderAjax = BasicWorks::ParameterHelper('o',false,'GETorPOST');

   $title = 'Galeria';

   if($OrderAjax){
      switch($OrderAjax){
         case 'changelang':
            $langid = BasicWorks::ParameterHelper('langid',false,'POST');
            $arrayAbout =  GalleryDAL::SelectGallery($langid);
             $AboutJSON=json_encode($arrayAbout);
            echo $AboutJSON;
            exit;
         break;
         case 'updateimagehead':
            $imagemName = BasicWorks::ParameterHelper('imagemName',false,'POST');
            $arrayGallery =  GalleryDAL::SelectGallery(1);
            if(Update::MoveFileTo($imagemName,PATHIMAGE)){
               GalleryDAL::UpdateImage($imagemName,"image_head");
               if($arrayGallery){
                  Update::DeleteFile($arrayGallery[0]["image_head"],PATHIMAGE);
               }
            }
            exit;
         break;
         case 'updatetext':
            $langid = BasicWorks::ParameterHelper('langid',false,'POST');
            $text = BasicWorks::ParameterHelper('textName',false,'POST');
            GalleryDAL::UpdateText($text,$langid,'description');
            exit;
         break;
         case 'update':
            $nameImagem = Update::UpdateTMP($_FILES['file']);
            echo $nameImagem;
            exit;
         break;
      }
   }

   $arrayGallery =  GalleryDAL::SelectGallery(1);

   $arrayHTML['IMAGEHEAD'] =  PATHIMAGE.$arrayGallery[0]["image_head"];
   $arrayHTML['DESCSHORT'] = $arrayGallery[0]["description"];



   $body =  BasicWorks::CreateTemplate('modules/gallery/template/gallery.tpl',$arrayHTML);


?>
