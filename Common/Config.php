<?php
namespace Common;

class Config
{
    private static array $config = [
        'domain'        =>      'php-assignment-4.ws',
        'apiKey'        =>      'e55d4ef0-6b5f-4990-9372-baf7bcaa6db3',
        'secret'        =>      '56c53a079f28c109df2f23301257de04a0a80cc8',
        'base_url'      =>      'https://rest.websupport.sk'
    ];

    public static function get($key)
    {
        return self::$config[$key];
    }
}