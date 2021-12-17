<?php
namespace Domain\DNS\Models;

use Common\DNSRecord;

class TXT extends DNSRecord
{
    public function bindings() : array
    {
        return [
            'type'      =>      'TXT',
            'name'      =>      'Name',
            'content'   =>      'IP address',
            'ttl'       =>      'TTL'
        ];
    }
}