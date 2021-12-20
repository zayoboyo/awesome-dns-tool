<?php
namespace Domain\DNS\Models;

use Common\DNSRecord;

class AAAA extends DNSRecord
{
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