<?php
class DataBase
{
  public static function DBConnect()
  {

    // Create connection
   $conn = new mysqli('127.0.0.1', 'root', '', 'portfolio');
   //  $conn = new mysqli('sql110.epizy.com','epiz_27768206','py8f902i4jOyv1','epiz_27768206_VRSYSTEM'); 
  
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
  }

  public static function ExecuteQuery($sql, $type = 'Select')
  {

    $conn = DataBase::DBConnect();
   
    try{
      $result = $conn->query($sql);
      if(!$result){
        throw new Exception("Erro Query: ".$sql,1);
      }
    } catch(Exception $e){
      LogHelp::GetLog($e->getMessage(), $e->getCode());
    }
    if ($result) {
      switch ($type) {
        case 'Select':
          $array = array();
          while ($row = mysqli_fetch_assoc($result)) {
            $array[] =  $row;
          }
          return $array;
          break;
        case 'Insert':
          return $conn->insert_id;
          break;
        case 'Update':
          return $result;
          break;
        default:
          return false;
          break;
      }
      return false;
    }
  }
}
