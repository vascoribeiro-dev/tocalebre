
<?php
   include("DAL/UserDAL.php");
   $OrderAjax = BasicWorks::ParameterHelper('o',false,'GETorPOST');
   $userid = BasicWorks::ParameterHelper('v',false,'GET');
   $arrayHTML['USERID'] = 0;
   $title = 'Criar Novo Utilizador';
   $arrayHTML['USER_NAME'] = '';
   $arrayHTML['USER_NICKNAME'] = '';
   $arrayHTML['USER_MAIL'] = '';
   $arrayHTML['USER_PASSWORD'] = '';
   $arrayHTML['AVATARPHOTO'] =  'images/user.png';

   function CreateTablePermissions($rowsPermissions)
   {
      $lines = "";
      $i = 0;
      $arrayHTML['LINES'] = '';
      foreach($rowsPermissions as $row){
         $lines .= '<tr role="row" class="jsgrid-row">
                        <td class="jsgrid-cell jsgrid-align-center"  ><input type="checkbox" id="premiss_'.$i.'"  '.($row["permission"] == 1 ? 'checked' : '').'></td>
                        <td class ="jsgrid-cell">'.$row["module"].'</td>
                        <td>'.$row["page"].'</td>
                        <td style="display:none;"> <input type="hidden" id="idpageuser_'.$i.'" value="'.$row["id_page"].'_'.$row["id"].'">  </td>
                  </tr>';
         $i++;
      }
         $arrayHTML['LINES'] = $lines ;
         $table =  BasicWorks::CreateTemplate('modules/users/template/userspermissiontable.tpl',$arrayHTML);
     return $table;
   }

   if($OrderAjax){

      $name = BasicWorks::ParameterHelper('nameuser',false,'POST');
      $password = BasicWorks::ParameterHelper('password',false,'POST');
      $userName = BasicWorks::ParameterHelper('username',false,'POST');
      $premiss = BasicWorks::ParameterHelper('premiss',false,'POST');
      $useremail = BasicWorks::ParameterHelper('useremail',false,'POST');
      $userid = BasicWorks::ParameterHelper('userId',false,'POST');
      $imagemName = BasicWorks::ParameterHelper('imagemName',false,'POST');
      $premiss = json_decode($premiss);

      switch($OrderAjax){
         case 'insert':
            if(Update::MoveFileTo($imagemName,PATHIMAGE)){
               $file = str_replace("imagesTMP/", "", $imagemName);
               $imagemName = PATHIMAGE.$file;
               $userid = UserDAL::InsertUser($name,$userName,$password,$useremail,$imagemName);
               foreach($premiss as $value){
                  $arrayPageUser = explode("_",$value[1]);
                  UserDAL::InsertUserPermissions($userid,$arrayPageUser[0],$value[0]);
               }
            }
            exit;
         break;
         case 'update':
            $values = array(
               "name" => $name,
               "username" => $userName,
               "email" => $useremail,
               "avatarphoto" => $imagemName
            );

            $arrayWhere = array(
               "id" => " = ".$userid
            );

            $arrayUser =  UserDAL::SelectUser($arrayWhere);

            if(Update::MoveFileTo($imagemName,PATHIMAGE)){
               Update::DeleteFile($arrayUser[0]["avatarphoto"],PATHIMAGE);
            }

            $file = str_replace("imagesTMP/", "", $imagemName);
            $imagemName = PATHIMAGE.$file;

            $values["avatarphoto"] = $imagemName;

            if($password){
               $password = BasicWorks::PasswordHash($password);
               $values['password'] = $password; 
            }
            UserDAL::UpdateUser($userid,$values);
            if($userid == $_SESSION['id']){
               $_SESSION['name'] = $name;
               $_SESSION['photo'] = $imagemName;
              }
            
            foreach($premiss as $value){
               $arrayPageUser = explode("_",$value[1]);
               UserDAL::UpdateUserPermissions($userid,$arrayPageUser[0],$value[0]);
            }
            exit;
         break;
         case 'updateimage':
               $nameImagem = Update::UpdateTMP($_FILES['file']);
               echo $nameImagem;
         
            exit;
         break;
      }
   }

   if($userid){
      $arrayWhere = array(
         "id" => " = ".$userid
     );
     $arrayUser =  UserDAL::SelectUser($arrayWhere);
     $title = 'Editar Registo - '.$arrayUser[0]["name"];
     $arrayHTML['USER_NAME'] =  $arrayUser[0]["name"] ;
     $arrayHTML['USER_NICKNAME'] = $arrayUser[0]["username"] ;
     $arrayHTML['USER_MAIL'] = $arrayUser[0]["email"] ;
     $arrayHTML['AVATARPHOTO'] = $arrayUser[0]["avatarphoto"];
     $arrayHTML['USERID'] = $userid;

   }

   $rowsPermissions =  UserDAL::UserPermissions($arrayHTML['USERID']);
   $table = CreateTablePermissions($rowsPermissions);
   $arrayHTML['TABLE'] = $table;
   $body =  BasicWorks::CreateTemplate('modules/users/template/user.tpl',$arrayHTML);


?>
