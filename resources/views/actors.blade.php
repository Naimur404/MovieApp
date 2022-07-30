@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-12">
	<div class="popular_actor">
		<h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Actors</h2>
            <div class="grid  sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-5 gap-16">
                <!--Card 1-->
@foreach ($popularActors as $actor)


        <div class="actor mt-8">

        <a href="{{ route('actor.show',$actor['id'])}}">
         @if ($actor['profile_path'])


        <img src="{{'https://image.tmdb.org/t/p/w470_and_h470_face/'.$actor['profile_path']}}" alt="Profile Image" class="hover:opacity-75 transition ease-in-out duration-150">
        @else
        <img src="{{'https://ui-avatars.com/api/?size=235name='.$actor['name']}}" alt="Profile Image" class="hover:opacity-75 transition ease-in-out duration-150">
        @endif
        </a>
        <div class="mt-2">
        <a href="{{ route('actor.show',$actor['id'])}}" class="text-sm hover:text-gray-300 font-bold">{{ $actor['name'] }}</a>
        <div class="text-sm truncate text-gray-400">{{$known_for[0]['known_for']}}</div>
        </div>

        </div>
        @endforeach



            </div>
    </div>
{{-- {{-- <div class="flex justify-between mt-8">
    	<a href="">Previous</a>
    	<a href="">Next</a>
    </div> --}}
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
<script>
    var elem = document.querySelector('.grid');
    var infScroll = new InfiniteScroll( elem, {
      path: '/actor/page/@{{#}}',
      append: '.actor',
      status: '.page-load-status',
      // history: false,
    });
</script>

@endsection




