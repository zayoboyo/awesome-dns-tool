<?php
namespace Domain\DNS\Models;

use Common\DNSRecord;

class MX extends DNSRecord
{
    public function bindings() : array
    {
        return [
            'type'      =>      'MX',
            'name'      =>      'Name',
            'content'   =>      'Content',
            'prio'      =>      'Priority',
            'ttl'       =>      'TTL'
        ];
    }

}