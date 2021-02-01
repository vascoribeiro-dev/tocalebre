<?php
class LogHelp
{
    public static function GetLog($message, $code)
    {
        $logFile = fopen("logs/".CURRENTDATE.".txt", "a") or die("Unable to open file!");
        $txt = "-------------------------------------".CURRENTDATETIME." : Code ".$code." -------------------------------------\n";
        fwrite($logFile, $txt);
        $txt = $message."\n\n";
        fwrite($logFile, $txt);
        fclose($logFile);
    }
}
?>