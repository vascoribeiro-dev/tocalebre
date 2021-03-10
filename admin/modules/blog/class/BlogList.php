<?php
class BlogList {
    public static function CreateTableBlog($rowsBlog)
    {    
      $lines = "";
      $i = 1;
      $arrayHTML['LINES'] = '';
      foreach($rowsBlog as $row){
         $lines .= '<tr role="row" class="odd">
                        <td style="width: 5%;">'.($i++).'</td>
                        <td style="width: 50%;">'.$row["title"].'</td>
                        <td style="width: 15%;">'.$row["date"].'</td>
                        <td style="width: 10%;"><button onclick="ChangeStatusUsers('.$row["id"].',\''.$row["status"].'\')"  type="button" data-id = "'.$row["id"].'" data-status = "'.$row["status"].'" class="userstatus btn btn-block '.($row["status"] == 'ACTIVE' ? 'btn-success' : 'btn-warning').' ">'.($row["status"] == 'ACTIVE' ? '<i class="fas fa-lock-open"></i>' : '<i class="fas fa-lock"></i>').' '.$row["status"].'</button></td>
                        <td style="width: 10%;"><button onclick="EditarUser('.$row["id"].')" type="button"  data-id = "'.$row["id"].'"    class="useredit btn btn-block btn-info"><i class="far fa-edit"></i>EDITAR</button></td>
                        <td style="width: 10%;"><button onclick="DeleteUser('.$row["id"].')" type="button" data-id = "'.$row["id"].'"  class="userdelete btn btn-block btn-danger"><i class="far fa-trash-alt"></i>APAGAR</button></td>
                  </tr>';
   
      }
      $arrayHTML['LINES'] = $lines ;
      $table =  BasicWorks::CreateTemplate('modules/blog/template/bloglisttable.tpl',$arrayHTML);
      return $table;
    }

}