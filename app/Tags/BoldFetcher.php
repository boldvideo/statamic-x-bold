<?php

namespace App\Tags;

use Statamic\Tags\Tags;
use Illuminate\Support\Facades\Http;

class BoldFetcher extends Tags
{
    /**
     * The {{ bold_fetcher }} tag.
     *
     * @return string|array
     */
    public function index()
    {
        $response = Http::withHeaders([
            'Authorization' => env('BOLD_API_KEY'),
        ])->get(rtrim(env('BOLD_API_HOST'), '/') . '/videos/latest');

        if ($response->successful()) {
            $data = $response->json();
            return $data['data'];
        }

        return [];
    }

    /**
     * The {{ bold_fetcher:example }} tag.
     *
     * @return string|array
     */
    public function single()
    {
        $videoId = $this->params->get('videoId');
        if (!$videoId) {
            abort(404);
        }

        $response = Http::withHeaders([
            'Authorization' => env('BOLD_API_KEY'),
        ])->get(rtrim(env('BOLD_API_HOST'), '/') . "/videos/$videoId");

        if ($response->successful()) {
            return $response->json()['data'];
        }

        abort(404);
    }
}
