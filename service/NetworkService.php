<?php
/**
 * Created by IntelliJ IDEA.
 * User: Alberto García Olivero
 * Date: 17/05/2018
 * Time: 13:30
 */

class NetworkService
{
    const URL_ESTACIONES = 'http://servizos.meteogalicia.gal/rss/observacion/estadoEstacionsMeteo.action';
    const URL_ESTACION_BY_ID = 'http://servizos.meteogalicia.gal/rss/observacion/estadoEstacionsMeteo.action?idEst=';

    public function getEstaciones()
    {
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, self::URL_ESTACIONES);//CURLOPT_URL => determina la url donde realizar la petición
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);//TRUE para devolver el resultado de la transferencia como string del valor de curl_exec() en lugar de mostrarlo directamente.
        $res = curl_exec($handler);
        curl_close($handler);
        return $array = json_decode($res, true)['listEstadoActual'];
    }

    public function getEstacionById($id)
    {
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, self::URL_ESTACION_BY_ID . $id);//CURLOPT_URL => determina la url donde realizar la petición
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);//TRUE para devolver el resultado de la transferencia como string del valor de curl_exec() en lugar de mostrarlo directamente.
        $res = curl_exec($handler);
        curl_close($handler);
        return $array = json_decode($res, true)['listEstadoActual'];
    }

}