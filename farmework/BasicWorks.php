<?php
class BasicWorks {
  public static function login($login,$password){

    $login = preg_replace('/[^[:alpha:]_]/', '',$login);
    $password = preg_replace('/[^[:alnum:]_]/', '',$password);
    $sql = "select id,name,password,avatarphoto from sys_users where username =  '".$login."' and status = 'ACTIVE' ";
    $result =  DataBase::ExecuteQuery($sql);

    if(is_array($result) && count($result) > 0 ){
      if(password_verify($password,$result[0]['password'])){
        $_SESSION['id'] = $result[0]['id'];
        $_SESSION['name'] = $result[0]['name'];
        $_SESSION['photo'] = $result[0]['avatarphoto'];
       //$_SESSION['primission'] = BasicWorks::GetPrimission($result[0]['id']);
        /*if(empty($_SESSION['company'])){
          $arraycompany = BasicWorks::GetCompany($result[0]['id']);
          $_SESSION['company'] = $arraycompany[0]['id'];
        }*/
        if(empty($_SESSION['timelogout'])){
          $_SESSION['timelogout'] = date('H:i',strtotime(date('H:i'). "+25 minute")); 
        }
        return 1;
      }
      return 0;
    }
    return 0;
  }
  
  public static function GetPrimission($id,$p,$m){
      $sql = "select up.permission from sys_pages p 
              inner join sys_rel_pages_modules pm on p.id = pm.id_page 
              inner join sys_rel_users_pages up on up.id_page = p.id
              inner join sys_modules m on m.id = pm.id_module 
              where up.id_user = '".$id."' and m.module = '".$m."' and p.keyname = '".$p."' 
              order by m.order, p.order ASC";
   
    $resultQuery = DataBase::ExecuteQuery($sql);
 
    return  ( empty($resultQuery)  ? false : $resultQuery[0]['permission'] );
  }

  public static function GetCompany($id){
    $sql = "SELECT c.id, c.name FROM sys_companies c 
            inner join `sys_rel_users_companies` uc on c.id = uc.id_company  and  uc.status = 'ACTIVE'
            where c.status = 'ACTIVE' and uc.id_user = '".$id."'";
    return DataBase::ExecuteQuery($sql);
  }

  public static function checkTimeLogin()
  {
    if(!empty($_SESSION['timelogout']))
      if( strtotime(date('H:i')) >  strtotime($_SESSION['timelogout'])){
        BasicWorks::logout();
        header('Location: ./index.php');
      }
  }

  public static function logout(){
    session_destroy(); 
    unset($_SESSION);
  }

  public static function CreateTemplate($file,$values = false){
    $output = file_get_contents($file);
    if($values){
      foreach ($values as $key => $value) {
          $tagToReplace = "[@$key]";
          $output = str_replace($tagToReplace, $value, $output);
      }
    }

    return $output;
  }

  public static function PasswordHash($password){
    return password_hash($password, PASSWORD_DEFAULT);
  }

  public static function ParameterHelper($var,$default = false,$typeValue='GETorPOST'){
    switch($typeValue){
        case 'GET':
          $result = (isset($_GET[$var]) ? $_GET[$var] : $default); 
        break;
        case 'POST':
          $result = (isset($_POST[$var]) ? $_POST[$var] : $default); 
        break;
        case 'GETorPOST':
          $result = (isset($_POST[$var]) ? $_POST[$var] : (isset($_GET[$var]) ? $_GET[$var] : $default)); 
        break;
        case 'SESSION':
          $result = (isset($_SESSION[$var]) ? $_SESSION[$var] : $default); 
        break;     
        default;
          $result = $default;
        break;  
      }
      return  preg_replace("/\s\s+/","",$result);
  }     

  public static function monthExtense($month){
    switch($month){
      case '1':
        $result = 'Janeiro'; 
      break;
      case '2':
        $result  = 'Fevereiro'; 
      break;
      case '3':
        $result  = 'Março'; 
      break;
      case '4':
        $result  = 'Abril'; 
      break;     
      case '5':
        $result  = 'Maio'; 
      break;  
      case '6':
      $result  = 'Julho'; 
      break;  
      case '7':
        $result  = 'Junho'; 
      break;  
      case '8':
        $result  = 'Agosto'; 
      break;  
      case '9':
      $result  = 'Setembro'; 
      break;  
      case '10':
      $result  = 'Outubro'; 
      break;  
      case '11':
      $result  = 'Novembro'; 
      break;  
      case '12':
      $result  = 'Dezembro'; 
      break;  
    }

    return $result;
  }

  public static function ConvertNumberToWords($number) {

    $hyphen      = '-';
    $conjunction = ' e ';
    $separator   = ', ';
    $negative    = 'menos ';
    $decimal     = ' ponto ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'um',
        2                   => 'dois',
        3                   => 'três',
        4                   => 'quatro',
        5                   => 'cinco',
        6                   => 'seis',
        7                   => 'sete',
        8                   => 'oito',
        9                   => 'nove',
        10                  => 'dez',
        11                  => 'onze',
        12                  => 'doze',
        13                  => 'treze',
        14                  => 'quatorze',
        15                  => 'quinze',
        16                  => 'dezesseis',
        17                  => 'dezessete',
        18                  => 'dezoito',
        19                  => 'dezenove',
        20                  => 'vinte',
        30                  => 'trinta',
        40                  => 'quarenta',
        50                  => 'cinquenta',
        60                  => 'sessenta',
        70                  => 'setenta',
        80                  => 'oitenta',
        90                  => 'noventa',
        100                 => 'cento',
        200                 => 'duzentos',
        300                 => 'trezentos',
        400                 => 'quatrocentos',
        500                 => 'quinhentos',
        600                 => 'seiscentos',
        700                 => 'setecentos',
        800                 => 'oitocentos',
        900                 => 'novecentos',
        1000                => 'mil',
        1000000             => array('milhão', 'milhões'),
        1000000000          => array('bilhão', 'bilhões'),
        1000000000000       => array('trilhão', 'trilhões'),
        1000000000000000    => array('quatrilhão', 'quatrilhões'),
        1000000000000000000 => array('quinquilhão', 'quinquilhões')
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words só aceita números entre ' . PHP_INT_MAX . ' à ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative.convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $conjunction . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = floor($number / 100)*100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            if ($baseUnit == 1000) {
                $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[1000];
            } elseif ($numBaseUnits == 1) {
                $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit][0];
            } else {
                $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit][1];
            }
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
    return $string;
  }

}   
?>