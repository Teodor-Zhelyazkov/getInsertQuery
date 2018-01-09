<?php

/**
*   @method getInsertQuery
*   @param Array
*   @param String
*
*   @return String
*   @example
*   "INSERT INTO `dbName` (`name` ,`email` ,`age`)
*       VALUES
*           (John ,j@asd.com ,25),
*           (Anna ,a@asd.com ,NULL),
*           (Lussile ,l@asd.com ,25)"
*/
function getInsertQuery( $array = array(), $table = NULL)
{
    $insert = "";

    if( empty( $array ) || !$table )
        return $insert;

    $insert .= "INSERT INTO `" . $table . "`";
    $insert .= " (";
    $array   = array_values( $array );
    $keys    = array_keys( reset($array) );
    foreach ($keys as $k => $keyVal)
        if( count($keys) - 1 == $k )
            $insert .= "`" . $keyVal . "`)";
        else
            $insert .= "`" . $keyVal . "` ,";

    $insert .= " VALUES";

    foreach ($array as $key => $value)
    {
        $insert .= " (";

        $count = 0;
        foreach ($value as $k => $v)
        {
            if($v == "")
                $v .= "NULL";

            if( count($value) - 1 == $count )
                $insert .= $v;
            else
                $insert .= $v . " ,";

            $count ++;
        }

        if( count($array) - 1 == $key )
            $insert .= ")";
        else
            $insert .= "),";
    }

    return $insert;

}

$arr = array(
    0 => array(
        "name" => "John",
        "email" => "j@asd.com",
        "age" => 25,
    ),
    12 => array(
        "name" => "Anna",
        "email" => "a@asd.com",
        "age" => "",
    ),
    26 => array(
        "name" => "Lussile",
        "email" => "l@asd.com",
        "age" => 25,
    ),
);

$q = getInsertQuery($arr, "dbName");
var_dump($q);

?>
