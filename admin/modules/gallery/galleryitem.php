
<?php
   include("DAL/GalleryDAL.php");
   include("class/GalleryItem.php");
   $OrderAjax = BasicWorks::ParameterHelper('o',false,'GETorPOST');
   $CLASSGALLERY = BasicWorks::ParameterHelper('CLASSGALLERY',false,'SESSION');
   $langId = BasicWorks::ParameterHelper('langId',1,'POST');
   $galleryid = BasicWorks::ParameterHelper('v',false,'GET');

   if($OrderAjax){
      switch($OrderAjax){
         case 'insertgallery':
            $galleryItem = unserialize($CLASSGALLERY);
            $arrayLang = $galleryItem -> GetLang();
            $arrayImage = $galleryItem -> GetImage();
            $galleryItemid = GalleryDAL::InsertGalleryItem();

            foreach($arrayImage as $key => $value){
               GalleryDAL::InsertGalleryItemImageItem($arrayImage[$key],$galleryItemid);
            }

            foreach($arrayLang as $key => $value){
               GalleryDAL::InsertGalleryItemLang($arrayLang[$key]['title'],$arrayLang[$key]['text'],$galleryItemid,$key);
            }

            exit;
         break; 
         case 'updategallery':
               $galleryItem = unserialize($CLASSGALLERY);
               $arrayLang = $galleryItem -> GetLang();
               $galleryItemid  = $galleryItem -> GetID();
               $arrayImage = $galleryItem -> GetImage();

               GalleryDAL::DeleteGalleryItemImageItem($galleryItemid);
               foreach($arrayImage as $key => $value){
                  GalleryDAL::InsertGalleryItemImageItem($arrayImage[$key],$galleryItemid);
               }

               foreach($arrayLang as $key => $value){
                  GalleryDAL::UpdateGalleryItemLang($arrayLang[$key]['title'],$arrayLang[$key]['text'],$galleryItemid,$key);
               }
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
         case 'updateimagem':
            $nameImagem = Update::UpdateTMP($_FILES['file']);
            $galleryItem = unserialize($CLASSGALLERY);
            $galleryItem  ->PutImage($nameImagem);
            $_SESSION['CLASSGALLERY'] = serialize($galleryItem);
            echo $nameImagem;
            exit;
         break;
         case 'removeimagem':
            $nameImagem = BasicWorks::ParameterHelper('imageremove',false,'POST');
            $galleryItem = unserialize($CLASSGALLERY);
            $galleryItem ->RemoveImage($nameImagem);
            Update::DeleteFile($nameImagem);
            $_SESSION['CLASSGALLERY'] = serialize($galleryItem);

            exit;
         break;
      }
   }


   $arrayHTML['TITLEGALLARY'] = '';
   $arrayHTML['DESCSHORT'] = '';

   if($galleryid){ 
         $rowsGalleryItem = GalleryDAL::GetGalleryOneorAll($galleryid);
         for($i=0; $i < count($rowsGalleryItem); $i++){
            $GalleryItemLang[$rowsGalleryItem[$i]['id_sys_lang']]['text'] = $rowsGalleryItem[$i]['text'];
            $GalleryItemLang[$rowsGalleryItem[$i]['id_sys_lang']]['title'] = $rowsGalleryItem[$i]['title'];
         }

         $rowsGalleryItemImage = GalleryDAL::GetAllGalleryImage($galleryid);
         $hmtlGalleryItemImage  = '';
         for($i=0; $i < count($rowsGalleryItemImage); $i++){
            $GalleryItemImagem[$rowsGalleryItemImage[$i]['image']] = $rowsGalleryItemImage[$i]['image'];

            $hmtlGalleryItemImage  .=  '<div class="preview-image preview-show-'.$i.'">
            <div class="image-cancel" data-path="'.$rowsGalleryItemImage[$i]['image'].'" data-no="'.$i.'">x</div>
            <div class="image-zone"><img id="pro-img-'.$i.'" src="'.$rowsGalleryItemImage[$i]['image'].'"></div>
            </div>';
         }

         $galleryItem = new GalleryItem($galleryid,$GalleryItemLang, $GalleryItemImagem);
         $_SESSION['CLASSGALLERY'] = serialize($galleryItem);
         $arrayLang = $galleryItem -> GetLang();
         $arrayHTML['TITLEGALLARY'] = $arrayLang[$langId]['title'];
         $arrayHTML['DESCSHORT'] = $arrayLang[$langId]['text'];
         $arrayHTML['ITEMIMAGE'] = $hmtlGalleryItemImage;
         $arrayHTML['GALLERYID'] = $galleryItem -> GetID();
         $title = 'Editar '.$arrayLang[$langId]['title'];
      }else{
         $galleryItem = new GalleryItem(-1);
         $_SESSION['CLASSGALLERY'] = serialize($galleryItem);
         $arrayHTML['TITLEGALLARY'] =  "";
         $arrayHTML['DESCSHORT'] = "";
         $arrayHTML['GALLERYID'] = -1;
         $arrayHTML['ITEMIMAGE'] = "";
         $title = 'Criar Item para Galeria';
      }



   $body =  BasicWorks::CreateTemplate('modules/gallery/template/galleryitem.tpl',$arrayHTML);
?>
