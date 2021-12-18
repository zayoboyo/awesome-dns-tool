<?php
namespace Common;

abstract class DNSRecord
{
    /**
     * Bindings for each DNS type (their variables, basically).
     *
     * @return mixed
     */
    abstract public function bindings() : array;

    /**
     * All currently available DNS types.
     *
     * @return string[]
     */
    final public static function availableDnsRecords() : array
    {
        return ['A', 'MX', 'ANAME', 'AAAA', 'TXT', 'CNAME', 'SRV'];
    }

    /**
     * Instantiates a brand new DNS class of given type.
     *
     * @param string $dnsType
     * @return DNSRecord
     */
    final public static function instantiate(string $dnsType) : DNSRecord
    {
        $dnsRecord = 'Domain\DNS\Models\\' . $dnsType;

        return new $dnsRecord;
    }
}