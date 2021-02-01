<?php
class DataQuery {
    public static function InsertValues($table,$values){
        $fields = "";
        $fieldsValues = "";

        foreach($values as $key=>$value){
            $fields .= $key.","; 
            $fieldsValues .= "'".$value."',"; 
        }

        $fields = substr($fields, 0, -1);
        $fieldsValues = substr($fieldsValues, 0, -1);
        $sqlExec = "INSERT INTO ".$table." (".$fields.") VALUES (".$fieldsValues.");";
        return DataBase::ExecuteQuery($sqlExec,'Insert');
    }

    public static function DeleteValues($table,$values){
        $sqlExec = "update ".$table." set status = 'INACTIVE' where id in (".$values.")";
        return DataBase::ExecuteQuery($sqlExec,'Update');
    }

    public static function SelectValues($table,$values=false,$endQuerey=false,$ativeValue =false,$supendedValue=false){
        $fieldsWhere = "where status in (".($ativeValue ? "'ACTIVE' ": "''").",".($supendedValue ? "'SUSPENDED'" : "''").") ";
        if($values){
            foreach($values as $key=>$value){
                $fieldsWhere .= " and ".$key." ".$value; 
            }
        }
        if($endQuerey){
            $fieldsWhere .=  $endQuerey;
        }
        $sqlExec = "SELECT * FROM ".$table." ".$fieldsWhere;
        return DataBase::ExecuteQuery($sqlExec,'Select');
    }

    public static function UpdateValues($table,$ids,$values){
        $fieldsWhere = "";
        if($values){
            foreach($values as $key=>$value){
                $fieldsWhere .= $key." = '".$value."',"; 
            }
        }
        $fieldsWhere = substr($fieldsWhere, 0, -1);
        $sqlExec = "update ".$table." set ".$fieldsWhere." where id = ".$ids." ";
        return DataBase::ExecuteQuery($sqlExec,'Update');
    }
}
?>