<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

$dotenv = Dotenv\Dotenv::createImmutable('C:\xampp\htdocs\api-mahasiswa');
$dotenv->load();

class ApiService {
    
    private static $baseUrl;

    public static function getBaseUrl() {
        if (is_null(self::$baseUrl)) {
            self::$baseUrl = $_ENV['BASE_URL'];
        }

        return self::$baseUrl;
    }

    public static function login(){
        $client = new Client();
        $url = self::getBaseUrl().'/v1/auth';

        $response = $client->request('POST',
            $url,
            [
                'form_params' => [
                    'email' =>  $_ENV['EMAIL'],
                    'password' => $_ENV['PASSWORD']
                ]
            ],
            [
                'headers'=> ['Content-Type' => 'Application/json'],
            ]
        )->getBody()->getContents();

        $var = json_decode($response);

        return $var->token;
    }

    public static function getDataPribadiByNim($nim, $token){
        $client = new Client();
        $url = self::getBaseUrl().'/v1/data-pribadi/'.$nim;

        try {
            $ress = $request = $client->get($url, [
                'headers'=> ['Authorization' => 'Bearer '.$token],
            ])->getBody()->getContents();

            $obj = json_decode($ress);
            $var = json_decode(json_encode($obj->data), true);
            return $var;
        }
        catch (ClientException $e){
            $ress = $e->getCode();
            return $ress;
        }
    }

    public static function getBillingByNomorBillingDanMasa($nim, $masa, $token){
        $client = new Client();
        $url = self::getBaseUrl().'/v1/data-billing?nim='.$nim.'&masa='.$masa;

        try {
            $ress = $request = $client->get($url, [
                'headers'=> ['Authorization' => 'Bearer '.$token],
            ])->getBody()->getContents();

            $obj = json_decode($ress);
            $var = json_decode(json_encode($obj->data), true);
            return $var;
        }
        catch (ClientException $e){
            $ress = $e->getCode();
            return $ress;
        }
    }
}
?>
