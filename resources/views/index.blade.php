@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 pt-12">
	<div class="popular_movies">
		<h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Movies</h2>
		<!-- <div class="grid grid-cols-4 gap-16">
			<div class="mt-8">
				<a href="#">
					<img src="{{asset('img/parasite.jpg')}}" alt="" class="">
				</a>
				<div class="mt-2">
					<a href="#" class="text-lg mt-2 hover:text-gray-300">Parasite</a>
					<div class="flex items-center text-gray-400">

						<span>Star</span>
						<span class="ml-1">85%</span>
						<span class="m-2">|</span>
						<span>Jul 24, 2022</span>
					</div>

				</div>
			</div>
			<div class="mt-8">
				<a href="#">
					<img src="{{asset('img/parasite.jpg')}}" alt="" class="">
				</a>
			</div>
			<div class="mt-8">
				<a href="#">
					<img src="{{asset('img/parasite.jpg')}}" alt="" class="">
				</a>
			</div>
			<div class="mt-8">
				<a href="#">
					<img src="{{asset('img/parasite.jpg')}}" alt="" class="">
				</a>
			</div>
			<div class="mt-8">
				<a href="#">
					<img src="{{asset('img/parasite.jpg')}}" alt="" class="">
				</a>
			</div> -->

	<div class=" grid  sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-5 gap-16">
    <!--Card 1-->
    @foreach ($popularMovies as $popularMovie )

   <x-movie-card :popularMovie="$popularMovie" :genres="$genres"/>



@endforeach






</div>

		</div>


{{-- //now playing --}}

			<div class="now_playing_movies py-24">
		<h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">now playing</h2>
	

	<div class=" grid  sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-5 gap-16">
    <!--Card 1-->
    @foreach($nowPlaying as $nmovies)

    <x-movie-card :popularMovie="$nmovies" :genres="$genres"/>
   
@endforeach


   
   
 
    
 



</div>

		</div>
	</div>



@endsection
