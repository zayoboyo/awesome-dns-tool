<?php
namespace Domain\DNS\Services;

use Common\Config;
use Common\DNSRecord;

class WebSupportDNSService
{
    private $path = "";
    private $method = "";

    private $data = "";

    private $apikey;
    private $secret;
    private $domain;

    function __construct()
    {
        $this->apikey = Config::get('apiKey');
        $this->secret = Config::get('secret');
        $this->domain = Config::get('domain');
    }

    /**
     * Sets DNS record data to be used in the request.
     *
     * @param $data
     * @return $this
     */
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
        $this->path = sprintf('%s%s%s','/v1/user/self/zone/', $this->domain, '/record');
        $this->method = 'GET';

        return $this;
    }

    /**
     * Creates new DNS record.
     *
     * @return $this
     */
    public function create()
    {
        $this->path = sprintf('%s%s%s', '/v1/user/self/zone/', $this->domain, '/record');
        $this->method = 'POST';

        return $this;
    }

    /**
     * Updates DNS record by ID.
     *
     * @param $id
     * @return $this
     */
    public function update($id)
    {
        $this->path = sprintf('%s%s%s%s', '/v1/user/self/zone/', $this->domain, '/record/', $id);
        $this->method = 'PUT';

        return $this;
    }

    /**
     * Deletes DNS record by ID.
     *
     * @param $id
     * @return $this
     */
    public function delete($id)
    {
        $this->path = sprintf('%s%s%s%s', '/v1/user/self/zone/', $this->domain,  '/record/', $id);
        $this->method = 'DELETE';

        return $this;
    }

    /**
     * Sends the built query to the WebSupport DNS API endpoint.
     *
     * @return mixed
     */
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
        curl_setopt($ch, CURLOPT_USERPWD, $this->apikey.':'.$signature);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->data));

        $response = curl_exec($ch);

        return json_decode($response, true);
    }
}