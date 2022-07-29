<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class viewMoviesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {   Http::fake([
        'https://api.themoviedb.org/3/movie/popular' => Http::response([

        ],200),
    ]);
        $response = $this->get(route('movies.index'));
        $response->assertSuccessful();
        $response->assertSee('Popular Movies');
    }
}
