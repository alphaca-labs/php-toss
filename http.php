<?php
require_once './toss.config.php';

class Http
{
    public static function request($url, $method = "GET", $data = null)
    {
        $secretKey = TossConfig::$secretKey;
        $credential = base64_encode($secretKey . ':');
        $curlHandle = curl_init($url);

        $options = [
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => [
                'Authorization: Basic ' . $credential,
                'Content-Type: application/json'
            ],
        ];

        if ($method === 'POST') {
            $options[CURLOPT_POST] = TRUE;
            if ($data !== null) {
                $options[CURLOPT_POSTFIELDS] = json_encode($data);
            }
        }

        curl_setopt_array($curlHandle, $options);
        $response = curl_exec($curlHandle);
        $httpCode = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);
        curl_close($curlHandle);

        $isSuccess = $httpCode == 200;
        if (!$isSuccess) {
            // Handle error
        }

        return json_decode($response);
    }
}