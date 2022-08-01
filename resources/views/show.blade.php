@extends('layouts.main')
@section('title', $movie['original_title'])
@section('content')
<div class="movie-info border-b border-gray-800">

	<div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
		<img src="{{'https://image.tmdb.org/t/p/w500/'.$movie['poster_path']}}" alt="parasite" class=" w-64 md:w-96">
		<div class="md:ml-24">
			<h2 class="text-4xl font-semibold">{{$movie['original_title']}}
			</h2>
				<div class="flex flex-wrap items-center text-gray-400">

							<svg class="fill-current text-orange-500 w-4" viewBox="0 0 24 24"><g data-name="Layer 2"><path d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z" data-name="star"/></g></svg>
						<span class="ml-1">{{ $movie['vote_average'] *10 .'%' }}</span>
						<span class="m-2">|</span>
						<span>{{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y') }}</span>
						<span class="mx-2">|</span>
						<span>@foreach ($movie['genres'] as $genre )
{{ $genre['name'] }} @if(!$loop->last),
@endif
        @endforeach</span>
					</div>
					<p class="text-gray-300 mt-7">
						{{ $movie['overview']}}

					</p>
					<div class="mt-12 ">
						<h4 class="text-white font-semibold">Featured Cast</h4>
						<div class="flex mt-4">
							@foreach($movie['credits']['crew'] as $crew)
							@if($loop->index < 2)
							<div class="mr-8">
								<div>{{$crew['name']}}</div>
								<div class="text-sm text-gray-400">{{$crew['known_for_department']}}</div>

							</div>

							@endif

							@endforeach


						</div>


					</div>
					<div x-data="{isOpen: false }">
					@if(count($movie['videos']['results']) > 0)
					<div class="mt-12">
					<button
                     @click="isOpen = true"
					 class="flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150">
						<svg class="w-6 fill-current" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
						<span class="ml-2">Play Trailer</span>


						</button>

					    @endif
					</div>


                            <div
                                style="background-color: rgba(0, 0, 0, .5);"
                                class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                                x-show.transition.opacity="isOpen"
                            >
                                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                    <div class="bg-gray-900 rounded">
                                        <div class="flex justify-end pr-4 pt-2">
                                            <button
                                                @click="isOpen = false"
                                                @keydown.escape.window="isOpen = false"
                                                class="text-3xl leading-none hover:text-gray-300">&times;
                                            </button>
                                        </div>
                                        <div class="modal-body px-8 py-8">
                                            <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                                <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full" src="https://youtube.com/embed/{{$movie['videos']['results'][0]['key']}}"  style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>





					</div>

		</div>

	</div>


</div>

<div class="credits border-b border-gray-800 flex flex-col md:flex-row items-center">
    <div class="container mx-auto px-4 py-16 ">
        <h2 class="text-4xl font-semibold">Comment</h2>
        <ul class=" leading-loose pl-5 mt-8">
               @foreach ($review as $revi)

<?php
$url = '';
?>
                <li class="mt-4">
                    @if (strpos($revi['author_details']['avatar_path'],'gravatar') !== false)
<?php

$url = $revi['author_details']['avatar_path'];
$url = ltrim($url, '/');
?>

                    <img src="<?php echo $url; ?>" class="rounded-full w-8 h-8 inline-flex mr-4">
                    @elseif ( $revi['author_details']['avatar_path'])
                    <img src="{{'https://image.tmdb.org/t/p/w500/'.$revi['author_details']['avatar_path']}}" alt="Profile Image" class="rounded-full w-8 h-8 inline-flex mr-4">
                     @else
                    <img src="{{'https://ui-avatars.com/api/?size=235name='.$revi['author']}}" alt="Profile Image" class="rounded-full w-8 h-8 inline-flex mr-4">
                    @endif
                    <strong><a href="" class="hover:underline inline-flex">

                        {{ $revi['author'] }}</a>

                    </strong>

                      <div x-data="{ helloworld: true, okOpen: false}">
                     <p class="mt-2 truncate" x-show="helloworld">{!!  $revi['content'] !!}</p>



                     <p class="mt-2 text text-sm" x-show="okOpen">{!!  $revi['content'] !!}</p>

                     <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full mt-2" @click="okOpen = true , helloworld = false" x-show="helloworld">RedMore</button>
                     <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full mt-2" @click="okOpen = false , helloworld = true" x-show="okOpen">Showless</button>
                       </div>
                 </li>


                 @endforeach

        </ul>

    </div>


</div>
<div class="movie-cast border-b border-gray-800">
	<div class="container mx-auto px-4 py-16">
		<h2 class="text-4xl font-semibold">Cast</h3>

		<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-5 gap-16">
    <!--Card 1-->
    @foreach($movie['credits']['cast'] as $cast)
    @if($loop->index < 5)
    <div class="rounded overflow-hidden shadow-lg mt-8">
      <a href="{{route('actor.show',$cast['id'])  }}"><img class="w-full hover:opacity-75 transition ease-out duration-150 w-66 md:w-96" src="{{'https://image.tmdb.org/t/p/w500/'.$cast['profile_path']}}" alt="" ></a>
      <div class="px-6 py-4">
        <div class="font-bold text-xl mb-2 ">
<a href="{{route('actor.show',$cast['id'])  }}" class="text-lg mt-2 hover:text-gray-300">
        {{$cast['original_name']}}</a>
    </div>
      	<div class="flex items-center text-gray-400 text-sm">



		<span> {{$cast['character']}}</span>

		</div>
      </div>

    </div>
    @else
    @break
    @endif
    @endforeach
	</div>

  </div>
</div>

<div class="movie-images border-b border-gray-800" x-data="{isOpen: false, image: ''}">
	<div class="container mx-auto px-4 py-16">
		<h2 class="text-4xl font-semibold">Images</h3>

		<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-16">
    <!--Card 1-->
    @foreach($movie['images']['backdrops'] as $image)
    @if($loop->index < 9)
    <div class="rounded overflow-hidden shadow-lg mt-8">
      <a href="#"
       @click.prevent="isOpen = true
                       image ='{{'https://image.tmdb.org/t/p/original/'.$image['file_path']}}'
       "

      ><img class="w-full hover:opacity-75 transition ease-out duration-150" src="{{'https://image.tmdb.org/t/p/w500/'.$image['file_path']}}" alt="Parasite" class="hover:opacity-75 transition ease-in-out duration-150"></a>


    </div>
    @else
    @break
    @endif
    @endforeach
	</div>

         <div
               style="background-color: rgba(0, 0, 0, .5);"
                class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                x-show="isOpen">
                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                    <div class="bg-gray-900 rounded">
                        <div class="flex justify-end pr-4 pt-2">
                            <button
                                @click="isOpen = false"
                                @keydown.escape.window="isOpen = false"
                                class="text-3xl leading-none hover:text-gray-300">&times;
                            </button>
                        </div>
                        <div class="modal-body px-8 py-8">
                            <img :src="image" alt="poster">
                        </div>
                    </div>
                </div>
            </div>

  </div>
</div>

@endsection
