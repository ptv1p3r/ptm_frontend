<?php

/**
 * Verifica chaves de arrays
 *
 * Verifica se a chave existe no array e se ela tem algum valor.
 * Obs.: Essa função está no escopo global, pois, vamos precisar muito da mesma.
 *
 * @param array $array O array
 * @param string $key A chave do array
 * @return string|null  O valor da chave do array ou nulo
 */
function chk_array($array, $key)
{
    // Verifica se a chave existe no array
    if (isset($array[$key]) && !empty($array[$key])) {
        // Retorna o valor da chave
        return $array[$key];
    }

    // Retorna nulo por padrão
    return null;
}

/**
 * @param $file
 * @return null|string|string[]
 */
function auto_version($file)
{

    if (strpos($file, '/') !== 0 || !file_exists($_SERVER['DOCUMENT_ROOT'] . $file))
        return $file;

    $mtime = filemtime($_SERVER['DOCUMENT_ROOT'] . $file);
    return preg_replace('{\\.([^./]+)$}', ".$mtime.\$1", $file);
}

/**
 * Metodo calcula a diferenca entre datetime fornecido e now()
 * @param $time
 * @return string
 */
function timeCalculation($time)
{
    $time = strtotime($time);

    $time = time() - $time; // to get the time since that moment
    $time = ($time < 1) ? 1 : $time;
    $tokens = array(
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '');
    }
}

/**
 * Metodo para returnar mes baseado no seu numero
 * @param $number
 * @return string
 */
function getMonth($number){
    $months = array("Janeiro", 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
    return $months[$number-1];
}

/**
 * Metodo para converter tamanhos de ficheiro para (KB, MB, GB, TB, PB)
 * usage: echo formatBytes('1073741824'); //1GB || https://www.html-code-generator.com/php/function/convert-bytes
 * @param $bytes
 * @return int|string
 */
function formatBytes($bytes) {
    if ($bytes > 0) {
        $i = floor(log($bytes) / log(1024));
        $sizes = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        return sprintf('%.02F', round($bytes / pow(1024, $i),1)) * 1 . ' ' . @$sizes[$i];
    } else {
        return 0;
    }
}

/**
 * Metodo para ordenar arrays multidimencionais por um campo escolhido
 * usage: array_orderby($array, 'campo', SORT_DESC); | https://www.php.net/manual/en/function.array-multisort.php#100534
 * @return mixed|null
 */
function array_orderby() {
    $args = func_get_args();
    $data = array_shift($args);
    foreach ($args as $n => $field) {
        if (is_string($field)) {
            $tmp = array();
            foreach ($data as $key => $row)
                $tmp[$key] = $row[$field];
            $args[$n] = $tmp;
        }
    }
    $args[] = &$data;
    call_user_func_array('array_multisort', $args);
    return array_pop($args);
}

/**
 * Metodo que efetua os pedidos a api e retorna os valores
 * @param $method
 * @param $url
 * @param $data
 * @param string $token
 * @return array|void
 */
function callAPI($method, $url, $data, $token = "")
{
    $curl = curl_init();

    if(isset($data["file"]) && !empty($data["file"])){
        $header = "multipart/form-data";
    } else {
        $header = "application/json";
    }

    switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data){
                //se existir ficheiro
                if(isset($data['file']) && !empty($data['file'])){
                    //constroi o post de maineira diferente
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                } else {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                }
            }
            break;

        case "PUT":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            break;
        case "DELETE":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            break;
        case "GET":
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            break;
        case "PATCH":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PATCH");
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // OPTIONS:
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Authorization: ' . $token,
        'Content-Type: ' . $header
    ));
    curl_setopt($curl, CURLOPT_HEADER, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

    //if url doesnt respond, set timeout
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);

    // EXECUTE:
    $result = curl_exec($curl);

    //gets status code from api response
    $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    //gets header size from api response
    $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);

    //gets body from api response
    $body = substr($result, $header_size);

    if (!$result) {
        die("API Connection Failure");
        /*$resultArray = array(
            "statusCode" => 503,
            "body" => "Service Unavailable" //decode json body from api response
        );*/
    } else {
        //final response array construction
        $resultArray = array(
            "statusCode" => $http_status,
            "body" => json_decode($body, true) //decode json body from api response
        );
    }

    curl_close($curl);
    return $resultArray;
}