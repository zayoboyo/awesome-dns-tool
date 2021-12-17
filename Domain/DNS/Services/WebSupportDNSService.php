<?php
namespace Domain\DNS\Services;

use Common\Config;
use Common\DNSRecord;

/**
 * WebSupport DNS value changing service.
 */
class WebSupportDNSService
{
    private $path = "";
    private $method = "";

    private $data = "";

    private $apikey = "e55d4ef0-6b5f-4990-9372-baf7bcaa6db3";
    private $secret = "56c53a079f28c109df2f23301257de04a0a80cc8";

    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Retrieves a specific DNS record by ID.
     *
     * @param $id
     * @return $this
     */
    public function get($id)
    {
        $this->path = sprintf('%s%s%s%s', '/v1/user/self/zone/', Config::get('domain'), '/record/', $id);
        $this->method = 'GET';

        return $this;
    }

    /**
     * Retrieves all DNS records for a given domain.
     *
     * @return $this
     */
    public function getAll()
    {
        $this->path = sprintf('%s%s%s','/v1/user/self/zone/', Config::get('domain'), '/record');
        $this->method = 'GET';

        return $this;
    }

    public function create()
    {
        $this->path = sprintf('%s%s%s', '/v1/user/self/zone/', Config::get('domain'), '/record');
        $this->method = 'POST';

        return $this;
    }

    public function update($id)
    {
        $this->path = sprintf('%s%s%s%s', '/v1/user/self/zone/', Config::get('domain'), '/record/', $id);
        $this->method = 'PUT';

        return $this;
    }

    public function delete($id)
    {
        $this->path = sprintf('%s%s%s%s', '/v1/user/self/zone/', Config::get('domain'),  '/record/', $id);
        $this->method = 'DELETE';

        return $this;
    }

    public function send()
    {
        $time = time();

        $canonicalRequest = sprintf('%s %s %s', $this->method, $this->path, $time);
        $signature = hash_hmac('sha1', $canonicalRequest, Config::get('secret'));

        $headers = [
            'Date: ' . gmdate('Ymd\THis\Z', $time),
            "Content-Type: application/json",
        ];

        $ch = curl_init();
        $endpoint = sprintf('%s%s', Config::get('base_url'), $this->path);

        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->method);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, Config::get('apiKey').':'.$signature);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->data));

        $response = curl_exec($ch);

        return json_decode($response, true);
    }
}