<?php
namespace Domain\DNS\Models;

use Common\DNSRecord;

class A extends DNSRecord
{
    public function bindings() : array
    {
        return [
            'type'  =>  'A',
            'name' => 'Name',
            'content' => 'Content',
            'ttl' => 'TTL',
            'note' => 'Note'
        ];
    }
}