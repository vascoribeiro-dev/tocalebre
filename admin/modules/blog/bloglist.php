
<?php
   include("DAL/BlogDAL.php");
   include("class/BlogList.php");
   $OrderAjax = BasicWorks::ParameterHelper('o',false,'POST');

   $title = 'Blog Lista';

   if($OrderAjax){
      switch($OrderAjax){
         case 'search':
            $namesearch = BasicWorks::ParameterHelper('nameuser',false,'POST');
            $datatableslength = BasicWorks::ParameterHelper('datatableslength',false,'POST');
         break;
         case 'delete':
            $idblog = BasicWorks::ParameterHelper('idblog',false,'POST');
            BlogDAL::UpdateStatusBlog($idblog,'DESATIVE');
            $namesearch = BasicWorks::ParameterHelper('nameblog',false,'POST');
            $datatableslength = BasicWorks::ParameterHelper('datatableslength',false,'POST');
         break;
         case 'statusChange':
            $idblog = BasicWorks::ParameterHelper('idblog',false,'POST');
            $statusblog = BasicWorks::ParameterHelper('statusblog',false,'POST');
         
             $statusblog = ($statusblog == 'ACTIVE' ? 'SUSPENDED' : 'ACTIVE');
         
            BlogDAL::UpdateStatusBlog($idblog, $statusblog);
            $namesearch = BasicWorks::ParameterHelper('nameuser',false,'POST');
            $datatableslength = BasicWorks::ParameterHelper('datatableslength',false,'POST');
         break;
      }

      $rowsBlog =  BlogDAL::SelectBlog(1,false,$namesearch,$datatableslength);
      $lines =  BlogList::CreateTableBlog($rowsBlog);
      echo $lines ;
     exit;
   }
   
   $rowsBlog = BlogDAL::SelectBlog(1);
   $table =  BlogList::CreateTableBlog($rowsBlog);
   $arrayHTML['TABLE'] = $table ;
   $body =  BasicWorks::CreateTemplate('modules/blog/template/bloglist.tpl',$arrayHTML);


?>
