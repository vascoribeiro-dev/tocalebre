<?php
class ArrayHelp
{
    public static function ArrayFind($array, $value)
    {
        $numberinteractions = 0;
        if (is_array($array)) {
            foreach ($array as $k => $v) {
                $numberinteractions +=  ArrayHelp::ArrayFind($v, $value);
            }
        } else {
            return ($array == $value ? 1 : 0);
        }
        return $numberinteractions;
    }
}
?>