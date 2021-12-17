<?php
namespace Domain\DNS\Models;

use Common\DNSRecord;

class CNAME extends DNSRecord
{
    public function bindings() : array
    {
        return [
            'type'  =>  'CNAME',
            'name' => 'Name',
            'content' => 'Content',
            'ttl' => 'TTL'
        ];
    }
}