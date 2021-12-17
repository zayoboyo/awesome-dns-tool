<?php
namespace Domain\DNS\Controllers;
use Common\View;
use Domain\DNS\Services\WebSupportDNSService;

class DNSRecordApiController
{
    public $dnsService;

    public function __construct()
    {
        // In an ideal world, this would be retrieved from an IoC container.
        $this->dnsService = new WebSupportDNSService();
    }

    /**
     * Creates a new DNS record.
     *
     * @return void
     */
    public function store() : void
    {
        $response = $this->dnsService->setData($_POST)->create()->send();

        $_SESSION['errors'] = $response['errors'];

        if($response['status'] == 'success')
        {
            redirect('/?type=' . $_POST['type'], 'DNS record sucessfully created.');
        }
        else
        {
            redirect('/dns/create?type=' . $_POST['type']);
        }
    }
    /**
     * Updates DNS record by ID.
     */
    public function update()
    {
        $response = $this->dnsService->setData($_POST)->update($_POST['id'])->send();

        $_SESSION['errors'] = $response['errors'];

        if($response['status'] == 'success')
        {
            redirect('/?type=' . $_POST['type'], 'Record updated!');
        }
        else
        {
            redirect('/', 'Something went wrong.');
        }

    }

    /**
     * Destroys DNS record by ID.
     *
     * @todo: It would be a good idea to add error handling logic instead
     * of just displaying a generic error message. Yeah. That would be great. :D
     */
    public function destroy()
    {
        $response = $this->dnsService->setData($_POST)->delete($_POST['id'])->send();

        if($response['status'] == 'success')
        {
            redirect('/?type=' . $_POST['type'], 'Record deleted!');
        }
        else
        {
            redirect('/', 'Something went wrong.');
        }

    }
}