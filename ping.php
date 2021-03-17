<?php
/**
 *Función que devuelve miliseconos para un ping o falso si no existe ip o dominio
 *
 * parametros string $ip - ip o dominio
 *
 * return [string|false] milisegundos o falso si no existe ip o dominio
 */
function obtPing($ip) {
    if(strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        $exec = exec("ping -n 3 -l 64 ".$ip);
        $array=preg_split("/Media =|Average =/", $exec);
        return count($array)==1 ? false : trim(end($array));
    } else {
        $exec = exec("ping -c 3 -s 64 -t 64 ".$ip);
        $array = explode("/", end(explode("=", $exec)));
        return count($array)==1 ? false : ceil($array[1]).'ms';
    }
}
