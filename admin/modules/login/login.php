
<?php
$OrderAjax = BasicWorks::ParameterHelper('o',false,'POST');

if($OrderAjax){
    $login = BasicWorks::ParameterHelper('name',false,'POST');
    $password = BasicWorks::ParameterHelper('password',false,'POST');
   switch($OrderAjax){
      case 'check':
        echo   BasicWorks::login($login,$password);
      break;
   }
  exit;
}
$body =  BasicWorks::CreateTemplate('Template/login.tpl');
$title = 'Login';

?>