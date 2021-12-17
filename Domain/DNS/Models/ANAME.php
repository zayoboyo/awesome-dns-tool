<?php
namespace Domain\DNS\Models;

use Common\DNSRecord;

class ANAME extends DNSRecord
{
    public function bindings() : array
    {
        return [
            'type'  =>  'ANAME',
            'name' => 'Name',
            'content' => 'Content',
            'ttl' => 'TTL'
        ];
    }
}