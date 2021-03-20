
<?php
   include("DAL/GalleryDAL.php");
   include("class/GalleryList.php");
   $OrderAjax = BasicWorks::ParameterHelper('o',false,'POST');


   $title = 'Lista Galeria';

   if($OrderAjax){
   
      switch($OrderAjax){
         case 'search':

         break;
         case 'delete':
            $idgalleryitem = BasicWorks::ParameterHelper('idgalleryitem',false,'POST');
            GalleryDAL::UpdateStatusGalleryItem($idgalleryitem,'DESATIVE');

         break;
         case 'statusChange':
            $idgalleryitem = BasicWorks::ParameterHelper('idgalleryitem',false,'POST');
            $statusgalleryitem = BasicWorks::ParameterHelper('statusgalleryitem',false,'POST');
            $statusgalleryitem = ($statusgalleryitem == 'ACTIVE' ? 'SUSPENDED' : 'ACTIVE');
         
            GalleryDAL::UpdateStatusGalleryItem($idgalleryitem, $statusgalleryitem);
         break;
      }

      $namesearch = BasicWorks::ParameterHelper('namesearch',false,'POST');
      $datatableslength = BasicWorks::ParameterHelper('datatableslength',false,'POST');
      $rowsBlog =  GalleryDAL::SelectGalleryItem(1,false,$namesearch,$datatableslength);
      $lines =  GalleryList::CreateTableGallery($rowsBlog);
      echo $lines ;
     exit;
   }

   $rowsGallery =  GalleryDAL::SelectGalleryItem(1);
   $table =  GalleryList::CreateTableGallery($rowsGallery);
   $arrayHTML['TABLE'] = $table ;
   $body =  BasicWorks::CreateTemplate('modules/gallery/template/gallerylist.tpl',$arrayHTML);
?>
