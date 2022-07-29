   <div class="rounded overflow-hidden shadow-lg mt-8">
      <a href="{{route('movies.show',$popularMovie['id'])}}"><img class="w-full hover:opacity-75 transition ease-out duration-150" src="{{'https://image.tmdb.org/t/p/w500/'.$popularMovie['poster_path']}}" alt="poster" ></a>
      <div class="px-6 py-4">
        <div class="font-bold text-xl mb-2 ">
<a href="{{route('movies.show',$popularMovie['id'])}}" class="text-sm mt-2 hover:text-gray-300">
        {{ $popularMovie['title'] }}</a>
    </div>
        <div class="flex items-center text-gray-400 text-sm">

                        <svg class="fill-current text-orange-500 w-4" viewBox="0 0 24 24"><g data-name="Layer 2"><path d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z" data-name="star"/></g></svg>
                        <span class="ml-1 text-sm">{{ $popularMovie['vote_average'] *10 .'%' }}</span>
                        <span class="mx-2">|</span>
                        <span class="text-sm">{{ \Carbon\Carbon::parse($popularMovie['release_date'])->format('M d, Y') }}</span>


                    </div>
                    <div class="text-gray-400 text-sm">

                    <span class="text-sm">@foreach ($popularMovie['genre_ids'] as $genre )
{{ $genres->get($genre) }} @if(!$loop->last),
@endif
        @endforeach</span>
                    </div>
      </div>
   
    </div>