<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TvController extends Controller
{
    public function index(){
        $popularShows = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/tv/popular')->json()['results'];
        $gernersArray = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/genre/tv/list')->json()['genres'];
        $genre = collect($gernersArray)->mapWithKeys(function($genre){
            return [$genre['id'] => $genre['name']];
        });
        $topRated = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/tv/top_rated')->json()['results'];
        return view('tv',['popularShows' => $popularShows,
        'genres' => $genre,'topRated' => $topRated]);

    }
    public function show($id){
        $show = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/tv/'.$id.'?append_to_response=credits,videos,images')->json();
      

        return view('tv_show',['show'=> $show,]);

    }
}
