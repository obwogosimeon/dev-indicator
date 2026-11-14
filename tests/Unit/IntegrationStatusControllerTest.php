<?php

namespace Tests\Unit;

use App\Http\Controllers\IntegrationStatusController;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\HandlerStack;
use Tests\TestCase;

class IntegrationStatusControllerTest extends TestCase
{
    public function test_it_reports_a_successful_service_response_as_available()
    {
        $controller = $this->controllerWithResponse(new Response(200));

        $response = $controller->show('kobo');

        $this->assertSame(['available' => true], $response->getData(true));
    }

    public function test_it_reports_a_server_error_as_unavailable()
    {
        $controller = $this->controllerWithResponse(new Response(503));

        $response = $controller->show('rstudio');

        $this->assertSame(['available' => false], $response->getData(true));
    }

    public function test_it_reports_a_connection_failure_as_unavailable()
    {
        $controller = $this->controllerWithResponse(new ConnectException('Unavailable', new Request('GET', '/')));

        $response = $controller->show('jupyter');

        $this->assertSame(['available' => false], $response->getData(true));
    }

    public function test_it_does_not_accept_unknown_service_names()
    {
        $this->expectException(\Symfony\Component\HttpKernel\Exception\NotFoundHttpException::class);

        $this->controllerWithResponse(new Response(200))->show('unknown');
    }

    private function controllerWithResponse($response)
    {
        $mock = new MockHandler([$response]);
        $handler = HandlerStack::create($mock);

        return new IntegrationStatusController(new Client(['handler' => $handler]));
    }
}
