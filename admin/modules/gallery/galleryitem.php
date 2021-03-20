
<?php
   include("DAL/GalleryDAL.php");
   include("class/GalleryItem.php");
   $OrderAjax = BasicWorks::ParameterHelper('o',false,'GETorPOST');
   $CLASSGALLERY = BasicWorks::ParameterHelper('CLASSGALLERY',false,'SESSION');
   $langId = BasicWorks::ParameterHelper('langId',1,'POST');
   $galleryid = BasicWorks::ParameterHelper('v',false,'GET');

   if($OrderAjax){
      switch($OrderAjax){
         case 'insert':
            $galleryItem = unserialize($CLASSGALLERY);
            $arrayLang = $galleryItem -> GetLang();
            $galleryItemid = GalleryDAL::InsertGalleryItem();

            foreach($arrayLang as $key => $value){
               GalleryDAL::InsertGalleryItemLang($arrayLang[$key]['title'],$arrayLang[$key]['text'],$galleryItemid,$key);
            }

            exit;
         break; 
         case 'update':
               $galleryItem = unserialize($CLASSGALLERY);
               $arrayLang = $galleryItem -> GetLang();
               $galleryItemid  = $galleryItem -> GetID();
               foreach($arrayLang as $key => $value){
                  GalleryDAL::UpdateGalleryItemLang($arrayLang[$key]['title'],$arrayLang[$key]['text'],$galleryItemid,$key);
               }
            exit;
         break; 
         case 'updateimage':
     
            exit;
         break; 
         case 'updateclass':
            $title = BasicWorks::ParameterHelper('title',false,'POST');
            $text = BasicWorks::ParameterHelper('text',false,'POST');

            $galleryItem = unserialize($CLASSGALLERY);
            $arrayLang = $galleryItem -> GetLang();
            $arrayLang[$langId]['title'] = $title;
            $arrayLang[$langId]['text'] = $text;
            
            $galleryItem -> PutLang($arrayLang);
            $_SESSION['CLASSGALLERY'] = serialize($galleryItem);
            exit;
         break;
         case 'changelang':
            $galleryItem = unserialize($CLASSGALLERY);
            $arrayLang = $galleryItem -> GetLang();
            $arrayGetLang['title'] = $arrayLang[$langId]['title'];
            $arrayGetLang['text'] = $arrayLang[$langId]['text'];
            $getLangJSON = json_encode($arrayGetLang);
            echo $getLangJSON;
            exit;
         break;
         case 'update':
            $nameImagem = Update::UpdateTMP($_FILES['file']);
            echo $nameImagem;
            exit;
         break;
      }
   }


   $arrayHTML['TITLEGALLARY'] = '';
   $arrayHTML['DESCSHORT'] = '';

   if($galleryid){ 
         $rowsGalleryItem = GalleryDAL::GetBlogOneorAll($galleryid);
         for($i=0; $i < count($rowsGalleryItem); $i++){
            $GalleryItemLang[$rowsGalleryItem[$i]['id_sys_lang']]['text'] = $rowsGalleryItem[$i]['text'];
            $GalleryItemLang[$rowsGalleryItem[$i]['id_sys_lang']]['title'] = $rowsGalleryItem[$i]['title'];
         }

         $galleryItem = new GalleryItem($galleryid,$GalleryItemLang);
         $_SESSION['CLASSGALLERY'] = serialize($galleryItem);
         $arrayLang = $galleryItem -> GetLang();
         $arrayHTML['TITLEGALLARY'] = $arrayLang[$langId]['title'];
         $arrayHTML['DESCSHORT'] = $arrayLang[$langId]['text'];
         $arrayHTML['GALLERYID'] = $galleryItem -> GetID();
         $title = 'Editar '.$arrayLang[$langId]['title'];
      }else{
         $galleryItem = new GalleryItem(-1);
         $_SESSION['CLASSGALLERY'] = serialize($galleryItem);
         $arrayHTML['TITLEGALLARY'] =  "";
         $arrayHTML['DESCSHORT'] = "";
         $arrayHTML['GALLERYID'] = -1;
         $title = 'Criar Item para Galeria';
      }



   $body =  BasicWorks::CreateTemplate('modules/gallery/template/galleryitem.tpl',$arrayHTML);
?>
