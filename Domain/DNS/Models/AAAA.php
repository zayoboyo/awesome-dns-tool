<?php
namespace Domain\DNS\Models;

use Common\DNSRecord;

class AAAA extends DNSRecord
{
    private string $type = "AAAA";
    public string $name = "";
    public string $content = "";
    public int $ttl = 600;

    public function bindings() : array
    {
        return [
            'type'  =>  'AAAA',
            'name' => 'Name',
            'content' => 'Content',
            'ttl' => 'TTL'
        ];
    }
}