<?php


session_start();

include("../farmework/DataBase.php");
include("../farmework/DataQuery.php");
include("../farmework/BasicWorks.php");
include("../farmework/ArrayHelp.php");
include("../farmework/Menu.php");
include("../farmework/LogHelp.php");
include("../farmework/Update.php");

$currentDate = date('Y-m-d');
$currentDateTime = date('Y-m-d H:m:s');
$currentMonth = date("m",strtotime($currentDate));
$currentYear =  date("Y",strtotime($currentDate));

define("CURRENTMONTH", intval($currentMonth));
define("CURRENTYEAR", $currentYear);
define("CURRENTDATE", $currentDate);
define("CURRENTDATETIME", $currentDateTime);
define("VERSION", '24012021.1856');

$post = BasicWorks::ParameterHelper('var',false,'POST');

if($post == 'login'){
    $login = BasicWorks::ParameterHelper('name',false,'POST');
    $password = BasicWorks::ParameterHelper('password',false,'POST');
    echo BasicWorks::login($login, $password);
    exit;
}

if($post == 'logout'){
    BasicWorks::logout();
    exit;
}

$m = BasicWorks::ParameterHelper('m',false,'GET');
$p = BasicWorks::ParameterHelper('p',false,'GET');
$sessionId = BasicWorks::ParameterHelper('id',false,'SESSION');
$sessionName = BasicWorks::ParameterHelper('name',false,'SESSION');
$sessionPhoto = BasicWorks::ParameterHelper('photo',false,'SESSION');


$html = '';
$arrayHTML['MODULE'] = '';
$arrayHTML['MENU'] = '';
$arrayHTML['TITLE']  = '';
$arrayHTML['BODY'] = '';
$arrayHTML['VERSION'] = VERSION;
if($sessionId){
    //BasicWorks::checkTimeLogin();
    $arraycompany = BasicWorks::GetCompany($sessionId);

    $company = '<select class="form-control startselect2simple">';
    $first = true;
    foreach($arraycompany as $row){
        $company .= '<option value="'.$row['id'].'"'.($first ? 'selected' : '' ).'  >'.$row['name'].'</option>';
        $first = false;
    }
    $company .= ' </select>';
    if(BasicWorks::GetPrimission($sessionId,$p,$m)){
        define("PATHIMAGE", "modules/".$m."/"."images/");
        include("modules/".$m."/".$p.".php");
      

        $arrayHTML['MODULE'] = $m;
        $arrayHTML['PAGE'] = $p;
        $arrayHTML['MENU'] = Menu::GetMenu($m,$p,$sessionId);
        $arrayHTML['BODY'] = $body;
        $arrayHTML['TITLE']  = $title;
        $arrayHTML['COMPANY']  = $company;
        $arrayHTML['USERNAME'] = $sessionName; 
        $arrayHTML['USERPHOTO'] = $sessionPhoto;
    }else{
        $arrayHTML['MENU'] = Menu::GetMenu($m,$p,$sessionId);
        $arrayHTML['TITLE']  = 'TOCA DA LEBRE';
        $arrayHTML['COMPANY']  = $company;
        $arrayHTML['USERNAME'] = $sessionName; 
        $arrayHTML['USERPHOTO'] = $sessionPhoto;
    }
$html =  BasicWorks::CreateTemplate('template/index.tpl',$arrayHTML,$m);

}else{
    include("modules/login/login.php");
    $arrayHTML['MODULE'] = 'login';
    $arrayHTML['PAGE'] = 'login';
    $html =  BasicWorks::CreateTemplate('template/login.tpl',$arrayHTML,$m);
}

echo $html;
