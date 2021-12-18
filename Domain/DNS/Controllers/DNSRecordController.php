<?php
namespace Domain\DNS\Controllers;
use Common\DNSRecord;
use Common\View;
use Domain\DNS\Services\WebSupportDNSService;

class DNSRecordController
{
    public $dnsService;

    public function __construct()
    {
        // In an ideal world, this would be retrieved from an IoC container.
        $this->dnsService = new WebSupportDNSService();
    }

    /**
     * Lists all DNS records based on a particular type.
     *
     * @return void
     */
    public function index()
    {
        $type = @$_GET['type'];

        // If the DNS type parameter is not set, redirect to A record.
        if(!in_array($type, DNSRecord::availableDnsRecords())) {
            redirect('/?type=A');
        }

        // Retrieve all DNS records from WebSupport REST API
        $response = $this->dnsService->getAll()->send();

        // Instantiate a new DNS class so we can get the bindings.
        $dnsRecord = DNSRecord::instantiate($type);

        // The response contains ALL dns types (A, AAAA, MX, etc.), we need to filter it
        // since we're interested in only one DNS type at a time.

        $filtered = array_values(array_filter($response['items'], function($var) use ($type) {
            return ($var['type'] == $type);
        }));

        // Include the view
        include(app_path('Domain/DNS/Views/index.php'));

        // Reset the session messages after including the view, so it doesn't display everytime.
        reset_session_message();
    }

    /**
     * Retrieves and shows an existing DNS record in a edit form.
     *
     * @return void
     */
    public function show()
    {
        // Retrieve a single DNS record from WebSupport REST API by ID
        $response = $this->dnsService->get($_GET['id'])->send();

        // Instantiate a new DNS class of given type, so we can get the bindings
        $dnsRecord = DNSRecord::instantiate($response['type']);


        include(app_path('Domain/DNS/Views/show.php'));

    }

    /**
     * Create a new DNS record of a specific type.
     *
     * @return void
     */
    public function store()
    {
        $type = $_GET['type'];
        $dnsRecord = 'Domain\Dns\Models\\' . $type;
        $dnsRecord = new $dnsRecord;

        include(app_path('Domain/DNS/Views/store.php'));

        unset($_SESSION['errors']);
        unset($_SESSION['message']);
    }

}