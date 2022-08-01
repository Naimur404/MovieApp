@extends('layouts.main')
@section('title', 'Tv Shows')
@section('content')
<div class="container mx-auto px-4 pt-12">
	<div class="popular_movies">
		<h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Shows</h2>


	<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-5 gap-16">
    <!--Card 1-->
    @foreach ($popularShows as $popularShow )

   <x-tv-card :popularShow="$popularShow" :genres="$genres"/>



@endforeach






</div>

		</div>


{{-- //now playing --}}

			<div class="now_playing_movies py-24">
		<h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Top Rated</h2>


	<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-5 gap-16">
    <!--Card 1-->
    @foreach($topRated as $nmovies)

    <x-tv-card :popularShow="$nmovies" :genres="$genres"/>

@endforeach










</div>

		</div>
	</div>



@endsection
