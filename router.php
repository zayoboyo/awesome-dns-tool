<?php
/**
 * @author Peter Zajicek
 *
 * The most basic router that the world has ever seen.
 *
 */

// Request method (GET, POST)
$method = $_SERVER['REQUEST_METHOD'];

// Current url without parameters
$url = strtok($_SERVER['REQUEST_URI'], '?');

// Controllers
$dnsRecordController = new Domain\DNS\Controllers\DNSRecordController();
$dnsRecordApiController = new Domain\DNS\Controllers\DNSRecordApiController();

// The actual 'router'
switch($url)
{

    // Homepage, shows all DNS records for a given DNS type
    case $url == '/' && $method == 'GET':
        $dnsRecordController->index();
        break;

    // Shows form to create a new DNS record
    case $url == '/dns/create' && $method == 'GET':
        $dnsRecordController->store();
        break;

    // Shows form to edit a single instance of a DNS record
    case $url == '/dns/edit' && $method == 'GET':
        $dnsRecordController->show();
        break;

    // Creates new DNS record via API
    case $url == '/dns/create' && $method == 'POST':
        $dnsRecordApiController->store();
        break;

    // Deletes the single instance of a DNS record
    case $url == '/dns/delete' && $method == 'POST':
        $dnsRecordApiController->destroy();
        break;

    // Updates the single instance of a DNS record
    case $url == '/dns/update' && $method == 'POST':
        $dnsRecordApiController->update();
        break;

    default:
        die("404");
}