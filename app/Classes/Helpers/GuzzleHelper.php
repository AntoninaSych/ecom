<?php
namespace App\Classes\Helpers;


class GuzzleHelper
{
    public static function getData($url, $query)
    {
        $default = [
            'key' => env("KEY_API"),
            'lang' => 'ru'
        ];
        $query = array_merge($query, $default);

        $client = new \GuzzleHttp\Client(['verify' => false, 'debug' => false]);
        $res = $client->request('GET', $url, [
            'query' => $query
        ]);
        $json = $res->getBody()->getContents();
        $arr = json_decode($json, true);
        return $arr;
    }
}