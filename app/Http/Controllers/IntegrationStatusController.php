<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;

class IntegrationStatusController extends Controller
{
    private $client;

    private $services = [
        'kobo' => 'http://kf.kobo.visystem.net/',
        'rstudio' => 'http://rstudio.visystem.net/',
        'jupyter' => 'http://jupyter.visystem.net/',
    ];

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function show($service)
    {
        abort_unless(isset($this->services[$service]), 404);

        try {
            $response = $this->client->request('GET', $this->services[$service], [
                'allow_redirects' => false,
                'connect_timeout' => 1,
                'http_errors' => false,
                'stream' => true,
                'timeout' => 2,
            ]);
            $status = $response->getStatusCode();
            $response->getBody()->close();

            return response()->json([
                'available' => $status >= 200 && $status < 500,
            ]);
        } catch (TransferException $exception) {
            return response()->json(['available' => false]);
        }
    }
}
