<?php
/**
 * Created by PhpStorm.
 * User: Ernesto
 * Date: 30/06/2016
 * Time: 05:29 PM
 */

namespace common\models;

class Utils{
    const COMBO_ESTATUS = [1=>'Activo', -1=>'Inactivo'];

    public static function validateChain($chain){
        return utf8_encode(trim($chain));
    }
    public static function getRGB($color){
    	$color = substr($color, 4, -1);
    	$colores = explode(', ', $color);
    	return ['r'=>$colores[0], 'g'=>$colores[1], 'b'=>$colores[2]];
    }
    public static function getRGBtoHexa($r, $g, $b){
    	$hex = "#";
		$hex .= str_pad(dechex($r), 2, "0", STR_PAD_LEFT);
		$hex .= str_pad(dechex($g), 2, "0", STR_PAD_LEFT);
		$hex .= str_pad(dechex($b), 2, "0", STR_PAD_LEFT);
		return $hex;
    }
    public static function convertirFecha($fecha){ //Return 0000-00-00 a 00/00/0000
        $hoy=explode('-',$fecha);
        return $hoy[2].'/'.$hoy[1].'/'.$hoy[0];
    }
    public static function invertirFecha($fecha){ //Return 00/00/0000 a 0000-00-00
        $hoy=explode('/',$fecha);
        return $hoy[2].'-'.$hoy[1].'-'.$hoy[0];
    }
    public static function getFormatDate($fecha){ //Formato para fechas de publicación de objetos
        $aux = strtotime($fecha);
        $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        return date('j ', $aux).$meses[date('m', $aux)-1].date(' Y g:i a', $aux);
    }
    public static function getFormatDateMiembro($fecha){ //Formato de fecha de sección "miembro desde".
        $aux = strtotime($fecha);
        $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        return date('j \d\e ', $aux).$meses[date('m', $aux)-1].date(' \d\e Y', $aux);
    }
}