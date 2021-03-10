
<?php
   include("DAL/BlogDAL.php");
   include("class/Blog.php");
   $OrderAjax = BasicWorks::ParameterHelper('o',false,'GETorPOST');
   $CLASSBLOG = BasicWorks::ParameterHelper('CLASSBLOG',false,'SESSION');
   $langId = BasicWorks::ParameterHelper('langId',1,'POST');
   $blogid = BasicWorks::ParameterHelper('v',false,'GET');

   if($OrderAjax){
      switch($OrderAjax){
         case 'insert':
            $blogItem = unserialize($CLASSBLOG);
            $arrayLang = $blogItem -> GetLang();
            $GetImage = $blogItem -> GetImage();
            if(Update::MoveFileTo($GetImage,PATHIMAGE,'')){
                $newImage = str_replace("imagesTMP/", "", $GetImage);
                $blogid = BlogDAL::InsertBlog(PATHIMAGE.$newImage);
                foreach($arrayLang as $key => $value){
                    BlogDAL::InsertBlogLang($arrayLang[$key]['title'],$arrayLang[$key]['text'],$blogid,$key);
                }
             }
            exit;
         break; 
         case 'update':
               $blogItem = unserialize($CLASSBLOG);
               $arrayLang = $blogItem -> GetLang();
               $GetImage = $blogItem -> GetImage();
               $blogid  = $blogItem -> GetID();
           
               //Update::MoveFileTo($GetImage,PATHIMAGE);
               $newImage = str_replace("imagesTMP/", "", $GetImage);
               $newImage = str_replace(PATHIMAGE, "", $newImage);
               BlogDAL::UpdateBlog(PATHIMAGE.$newImage,$blogid);
               foreach($arrayLang as $key => $value){
                  echo  $arrayLang[$key]['title'];
                  BlogDAL::UpdateBlogLang($arrayLang[$key]['title'],$arrayLang[$key]['text'],$blogid,$key);
               }
            exit;
         break; 
         case 'updateclass':
            $title = BasicWorks::ParameterHelper('title',false,'POST');
            $text = BasicWorks::ParameterHelper('text',false,'POST');
            $blogItem = unserialize($CLASSBLOG);
            $arrayLang = $blogItem -> GetLang();
            $arrayLang[$langId]['title'] = $title;
            $arrayLang[$langId]['text'] = $text;
            $blogItem -> PutLang($arrayLang);
            $_SESSION['CLASSBLOG'] = serialize($blogItem);
            exit;
         break;
         case 'changelang':
            $blogItem = unserialize($CLASSBLOG);
            $arrayLang = $blogItem -> GetLang();
            $arrayGetLang['title'] = $arrayLang[$langId]['title'];
            $arrayGetLang['text'] = $arrayLang[$langId]['text'];
            $getLangJSON = json_encode($arrayGetLang);
            echo $getLangJSON;
            exit;
         break;
         case 'updateimage':
            $blogItem = unserialize($CLASSBLOG);
            $GetImage = $blogItem -> GetImage();
            Update::DeleteFile($GetImage);
            $GetImage = Update::UpdateTMP($_FILES['file'],$GetImage);
            $blogItem -> PutImage($GetImage);
            $_SESSION['CLASSBLOG'] = serialize($blogItem);
            exit;
         break;
      }
   }

   if($blogid){ 
         $rowsBlog = BlogDAL::GetBlogOneorAll($blogid);
         for($i=0; $i < count($rowsBlog); $i++){
            $BlogItemLang[$rowsBlog[$i]['id_sys_lang']]['text'] = $rowsBlog[$i]['text'];
            $BlogItemLang[$rowsBlog[$i]['id_sys_lang']]['title'] = $rowsBlog[$i]['title'];
         }
         $blogItem = new blogItem($rowsBlog[0]['id'],$BlogItemLang,$rowsBlog[0]['image']);
         $_SESSION['CLASSBLOG'] = serialize($blogItem);
         $arrayLang = $blogItem -> GetLang();
         $arrayHTML['TITLEBLOG'] = $arrayLang[$langId]['title'];
         $arrayHTML['DESCSHORT'] = $arrayLang[$langId]['text'];
         $arrayHTML['IMAGEHEAD'] = $blogItem -> GetImage();
         $arrayHTML['BLOGID'] = $blogItem -> GetID();
         $title = 'Editar '.$arrayLang[$langId]['title'];
   }else{
         $blogItem = new blogItem(-1);
         $_SESSION['CLASSBLOG'] = serialize($blogItem);
         $arrayHTML['TITLEBLOG'] =  "";
         $arrayHTML['DESCSHORT'] = "";
         $arrayHTML['IMAGEHEAD'] =  "";
         $arrayHTML['BLOGID'] = -1;
         $title = 'Criar Novo Item para Blog';
   }

   $body =  BasicWorks::CreateTemplate('modules/blog/template/blog.tpl',$arrayHTML);
?>
