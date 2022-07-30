<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ActorController extends Controller
{

    public function index($page = 1){
        abort_if($page > 500, 204);
        $popularActors = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/person/popular?page='.$page)->json()['results'];

        $known_for = collect($popularActors)->map(function($known_for){
            return collect($known_for)->merge([

             'known_for' =>collect($known_for['known_for'])->where('media_type', 'movie')->pluck('title')->union(
                collect($known_for['known_for'])->where('media_type', 'tv')->pluck('name')
             )->implode(', '),
            ])->only([
                'known_for'
            ]);
        });

        $topRated = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/tv/top_rated')->json()['results'];
        return view('actors',['popularActors' => $popularActors,
        'known_for' =>$known_for,
        ]);

    }
    public function show($id){
        $actor = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/person/'.$id)->json();




        $social = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/person/'.$id.'/external_ids')->json();
        $credits = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/person/'.$id.'/combined_credits')->json();



        $castMovies = collect($credits)->get('cast');

         $movies = collect($castMovies)->sortByDesc('popularity')->take(5)->map(function($movie) {
            if (isset($movie['title'])) {
                $title = $movie['title'];
            } elseif (isset($movie['name'])) {
                $title = $movie['name'];
            } else {
                $title = 'Untitled';
            }

            return collect($movie)->merge([
                'poster_path' => $movie['poster_path']
                    ? 'https://image.tmdb.org/t/p/w185'.$movie['poster_path']
                    : 'https://via.placeholder.com/185x278',
                'title' => $title,
                'linkToPage' => $movie['media_type'] === 'movie' ? route('movies.show', $movie['id']) : route('tv.show', $movie['id'])
            ])->only([
                'poster_path', 'title', 'id', 'media_type', 'linkToPage',
            ]);
        });




        $new_credits = collect($castMovies)->map(function($movie) {
            if (isset($movie['release_date'])) {
                $releaseDate = $movie['release_date'];
            } elseif (isset($movie['first_air_date'])) {
                $releaseDate = $movie['first_air_date'];
            } else {
                $releaseDate = '';
            }

            if (isset($movie['title'])) {
                $title = $movie['title'];
            } elseif (isset($movie['name'])) {
                $title = $movie['name'];
            } else {
                $title = 'Untitled';
            }

            return collect($movie)->merge([
                'release_date' => $releaseDate,
                'release_year' => isset($releaseDate) ? Carbon::parse($releaseDate)->format('Y') : 'Future',
                'title' => $title,
                'character' => isset($movie['character']) ? $movie['character'] : '',
                'linkToPage' => $movie['media_type'] === 'movie' ? route('movies.show', $movie['id']) : route('tv.show', $movie['id']),
            ])->only([
                'release_date', 'release_year', 'title', 'character', 'linkToPage',
            ]);
        })->sortByDesc('release_date');









        return view('actors_show',['actor'=> $actor,
    'social' => $social,
     'credits' =>$new_credits,
      'movies' => $movies
    ]);

    }

}
