<?php
class GalleryList {
    function CreateTableGallery($rowsGallery)
    {    
      $lines = "";
      $i = 1;
      $arrayHTML['LINES'] = '';
      foreach($rowsGallery as $row){
         $lines .= '<tr role="row" class="odd">
                        <td>'.($i++).'</td>
                        <td style="width: 5%;">  <div style="height: 44; width: 44;"> <div  class="circleimagem" style="background-image: url('.$row["avatarphoto"].');"></div> </div></td>
                        <td>'.$row["name"].'</td>
                        <td>'.$row["create_date"].'</td>
                        <td style="width: 5%;"><button onclick="ChangeStatusUsers('.$row["id"].',\''.$row["status"].'\')"  type="button" data-id = "'.$row["id"].'" data-status = "'.$row["status"].'" class="userstatus btn btn-block '.($row["status"] == 'ACTIVE' ? 'btn-success' : 'btn-warning').' ">'.$row["status"].'</button></td>
                        <td style="width: 5%;"><button  onclick="EditarUser('.$row["id"].')" type="button"  data-id = "'.$row["id"].'"    class="useredit btn btn-block btn-info"><i class="far fa-edit"></i></button></td>
                        <td style="width: 5%;"><button onclick="DeleteUser('.$row["id"].')" type="button" data-id = "'.$row["id"].'"  class="userdelete btn btn-block btn-danger"><i class="far fa-trash-alt"></i></button></td>
                  </tr>';
   
      }
      $arrayHTML['LINES'] = $lines ;
      $table =  BasicWorks::CreateTemplate('modules/gallery/template/gallerylisttable.tpl',$arrayHTML);
      return $table;
    }

}