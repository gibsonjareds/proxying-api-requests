<?php
namespace App\Http\Controller;

use App\Http\Clients\NpiRegistry;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Response;


class NpiRegistryController extends Controller{
    private NpiRegistry $client;

    public function __construct(NpiRegistry $client)
    {
        $this->client = $client;
    }

    public function get(Request $request): Response
    {
        $params = array();
        $page = (int) ($request->input('page') ?? 1);
        foreach (NpiRegistry::$args as $arg) {
            if($request->input($arg)){
                $params[$arg] = $request->input($arg);
            }
        }
        $response = $this->client->searchResults($params, $page);
        return response()->json($response->body(), $response->status());
    }
}
