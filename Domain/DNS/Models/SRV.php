<?php
namespace Domain\DNS\Models;

use Common\DNSRecord;

class SRV extends DNSRecord
{
    public function bindings() : array
    {
        return [
            'type'  =>  'SRV',
            'name' => 'Name',
            'content' => 'Content',
            'prio'  =>  'Priority',
            'port'  =>  'Port',
            'weight'    =>  'Weight',
            'ttl' => 'TTL'
        ];
    }
}