<?php
/**
 * NPI Registry Client
 *
 * This sets up the client for making requests to the NPI registry to be used elsewhere in app.
 *
 * @since 0.0.0
 */
namespace App\Http\Clients;

use Illuminate\Support\Facades\Http;

class NpiRegistry {

    private string $url;
    private string $version;
    private int $attempts = 0;

    public function __construct(string $registry_url, string $version)
    {
        $this->url = $registry_url;
        $this->version = $version;

    }
    private function _generateQueryObject(array $query, int $page):array
    {
        $queryObj = $query;
        $queryObj['version'] = $this->version;
        $queryObj['use_first_name_alias'] = "true";
        $queryObj['limit'] = 50;
        $queryObj['skip'] = $queryObj['limit'] * $page;
        return $queryObj;
    }
    public function searchResults(array $query=[], int $page=1)
    {
        $response = Http::get($this->url, $this->_generateQueryObject($query, $page));
        if($response->successful()){
            // just pass it on if it's successful
            return response()->json($response->body());
        }else if($response->serverError() && $this->attempts <= 5){
            // try again in a few seconds if it's a server error;
            $this->attempts++;
            wait(5);
            $this->searchResults($query,$page);
        }else{
            // just give up and send the error back to the client if it's a client error or the server is having too much trouble
            $this->attempts=0;
            return response()->json($response->body(), $response->status());
        }
    }
}
