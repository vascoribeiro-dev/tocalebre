<?php
class UserDAL {
      
    public static function InsertUser($name,$userName,$password,$email,$imagemName){
        $session = BasicWorks::ParameterHelper('id',false,'SESSION');
        $password = BasicWorks::PasswordHash($password);
        $values = array(
            "name" => $name,
            "username" => $userName,
            "password" => $password,
            "email" => $email,
            "avatarphoto" => $imagemName,
            "status" => "ACTIVE",
            "user_creater_id" => $session
        );

        return DataQuery::InsertValues('sys_users',$values);
    }

    public static function SelectUser($arrayWhere = false,$endQuerey = false){
        return DataQuery::SelectValues('sys_users',$arrayWhere,$endQuerey,true,true);
    }

    public static function DeleteUser($idusers){
        return DataQuery::DeleteValues('sys_users',$idusers);
    }
    public static function UpdateUser($ids,$valuesUser){
        return DataQuery::UpdateValues('sys_users',$ids,$valuesUser);
    }

    public static function UserPermissions($id = 0){
        $sqlExec = "SELECT COALESCE(up.id , 0) as id, p.id as id_page, p.name as page, m.name as module,  COALESCE(up.permission , 0) as permission  FROM `sys_pages` p 
        inner join sys_rel_pages_modules pm on pm.id_page = p.id
        inner join sys_modules m on pm.id_module = m.id
        left join sys_rel_users_pages up on up.id_page = p.id and up.id_user = ".$id;
        return DataBase::ExecuteQuery($sqlExec,'Update');
    }

    public static function InsertUserPermissions($idUser,$idPage,$permission){
        $sqlExec = "insert into sys_rel_users_pages (id_user,id_page,permission) values (".$idUser.",".$idPage.",".($permission ? 1 : 0).")";
        return DataBase::ExecuteQuery($sqlExec,'Insert');
    }
    public static function UpdateUserPermissions($idUser,$idPage,$permission){
        $sqlExec = "update sys_rel_users_pages set permission = ".($permission ? 1 : 0)." where id_user = ".$idUser." and id_page = ".$idPage;
        return DataBase::ExecuteQuery($sqlExec,'Update');
    }


}

?>