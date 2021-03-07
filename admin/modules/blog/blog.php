
<?php
   include("DAL/BlogDAL.php");
   include("class/Blog.php");
   $OrderAjax = BasicWorks::ParameterHelper('o',false,'GETorPOST');
   $CLASSBLOG = BasicWorks::ParameterHelper('CLASSBLOG',false,'SESSION');
   $langId = BasicWorks::ParameterHelper('langId',1,'POST');

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
           
            if(Update::MoveFileTo($GetImage,PATHIMAGE)){
    
                $newImage = str_replace("imagesTMP/", "", $GetImage);
                echo  PATHIMAGE.$newImage;
                $blogid = BlogDAL::InsertBlog($newImage);
                foreach($arrayLang as $key => $value){
                    BlogDAL::InsertBlogLang($arrayLang[$key]['title'],$arrayLang[$key]['text'],$blogid,$key);
                }
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

   $title = 'Criar Novo Item para Blog';

   $arrayHTML['TITLEBLOG'] = '';
   $arrayHTML['DESCSHORT'] = '';

    if($CLASSBLOG){
        $blogItem =  unserialize($CLASSBLOG);
        $arrayLang = $blogItem -> GetLang();
        $arrayHTML['TITLEBLOG'] = $arrayLang[$langId]['title'];
        $arrayHTML['DESCSHORT'] = $arrayLang[$langId]['text'];
        $GetImage = $blogItem -> GetImage();
        $arrayHTML['IMAGEHEAD'] =  $GetImage;
        //$arrayHTML['BLOGID'] = $BLOGID;
    }else{
        $blogItem = new blogItem(-1);
        $_SESSION['CLASSBLOG'] = serialize($blogItem);
        $arrayHTML['TITLEBLOG'] =  "";
        $arrayHTML['DESCSHORT'] = "";
        $arrayHTML['IMAGEHEAD'] =  "";
        $arrayHTML['BLOGID'] = -1;
   }

   $body =  BasicWorks::CreateTemplate('modules/blog/template/blog.tpl',$arrayHTML);
?>
