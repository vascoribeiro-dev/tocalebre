
<?php
   include("DAL/UserDAL.php");
   $OrderAjax = BasicWorks::ParameterHelper('o',false,'POST');

   function CreateTableUser($rowsUser)
   {
      $lines = "";
      $i = 1;
      $arrayHTML['LINES'] = '';
      foreach($rowsUser as $row){
         $lines .= '<tr role="row" class="odd">
                        <td>'.($i++).'</td>
                        <td style="width: 5%;">  <div style="height: 44; width: 44;"> <div  class="circleimagem" style="background-image: url('.PATHIMAGE.$row["avatarphoto"].');"></div> </div></td>
                        <td>'.$row["name"].'</td>
                        <td>'.$row["create_date"].'</td>
                        <td style="width: 5%;"><button onclick="ChangeStatusUsers('.$row["id"].',\''.$row["status"].'\')"  type="button" data-id = "'.$row["id"].'" data-status = "'.$row["status"].'" class="userstatus btn btn-block '.($row["status"] == 'ACTIVE' ? 'btn-success' : 'btn-warning').' ">'.$row["status"].'</button></td>
                        <td style="width: 5%;"><button  onclick="EditarUser('.$row["id"].')" type="button"  data-id = "'.$row["id"].'"    class="useredit btn btn-block btn-info"><i class="far fa-edit"></i></button></td>
                        <td style="width: 5%;"><button onclick="DeleteUser('.$row["id"].')" type="button" data-id = "'.$row["id"].'"  class="userdelete btn btn-block btn-danger"><i class="far fa-trash-alt"></i></button></td>
                  </tr>';
   
      }
         $arrayHTML['LINES'] = $lines ;
         $table =  BasicWorks::CreateTemplate('modules/users/template/userslisttable.tpl',$arrayHTML);
     return $table;
   }

   if($OrderAjax){
      switch($OrderAjax){
         case 'search':
            $namesearch = BasicWorks::ParameterHelper('nameuser',false,'POST');
            $datatableslength = BasicWorks::ParameterHelper('datatableslength',false,'POST');
            $arrayQuery = [];
            $arrayQuery['name'] = " like '%".$namesearch."%' ";
            $endQuerey = " LIMIT ".$datatableslength." OFFSET 0 ";
         break;
         case 'delete':
            $iduser = BasicWorks::ParameterHelper('iduser',false,'POST');
            UserDAL::DeleteUser($iduser);
            $namesearch = BasicWorks::ParameterHelper('nameuser',false,'POST');
            $datatableslength = BasicWorks::ParameterHelper('datatableslength',false,'POST');
            $arrayQuery = [];
            $arrayQuery['name'] = " like '%".$namesearch."%' ";
            $endQuerey = " LIMIT ".$datatableslength." OFFSET 0 ";
         break;
         case 'statusChange':
            $iduser = BasicWorks::ParameterHelper('iduser',false,'POST');
            $statususer = BasicWorks::ParameterHelper('statususer',false,'POST');
            $valuesUser = array(
               "status" => ($statususer == 'ACTIVE' ? 'SUSPENDED' : 'ACTIVE')
           );
            UserDAL::UpdateUser($iduser, $valuesUser);
            $namesearch = BasicWorks::ParameterHelper('nameuser',false,'POST');
            $datatableslength = BasicWorks::ParameterHelper('datatableslength',false,'POST');
            $arrayQuery = [];
            $arrayQuery['name'] = " like '%".$namesearch."%' ";
            $endQuerey = " LIMIT ".$datatableslength." OFFSET 0 ";
         break;
      }

      $rowsUser =  UserDAL::SelectUser($arrayQuery,$endQuerey);
      $lines =  CreateTableUser($rowsUser);
      echo $lines ;
     exit;
   }
   $endQuerey = " LIMIT 10 OFFSET 0 ";
   $rowsUser =  UserDAL::SelectUser(false,$endQuerey);
   $table =  CreateTableUser($rowsUser);
   $arrayHTML['TABLE'] = $table ;
   $body =  BasicWorks::CreateTemplate('modules/users/template/userslist.tpl',$arrayHTML);
   $title = 'Lista de Utilizadores';

?>
