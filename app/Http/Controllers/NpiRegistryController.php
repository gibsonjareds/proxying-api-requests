<?php
namespace App\Http\Controllers;

use App\Http\Clients\NpiRegistry;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse as Response;


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
            if(!empty($request->input($arg))){
                $params[$arg] = $request->input($arg);
            }
        }
        $response = $this->client->searchResults($params, $page);
        return response()->json(json_decode($response->body()), $response->status());
    }
}
