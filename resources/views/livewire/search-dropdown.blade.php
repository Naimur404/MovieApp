<div class="relative mt-3 md:mt-0" x-data ="{isOpen : true}" @click.away="isOpen = false">
    <input wire:model="search"  class="bg-gray-800 rounded-full w-64 px-4 py-1 pl-8  focus:shadow-outline text-sm" name="" placeholder="Search">
    
    <div class="absolute top-0">
        <svg class="fill-current w-4 text-gray-500 mt-2 ml-2" viewBox="0 0 24 24"><path class="heroicon-ui" d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z"/></svg>

    </div>
    <div wire:loading class="spinner top-0 right-0 mr-4 mt-3"></div>
    @if(strlen($search) > 2)
    <div class="absolute bg-gray-800 text-sm rounded w-64 mt-4" x-show="isOpen">
        @if($searchresult->count() > 0)
        <ul>
            @foreach($searchresult as $result)
            <li class="border-b border-gray-700">
                <a href="{{route('movies.show',$result['id'])}}" class="block hover:bg-gray-700 px-3 py-3 flex f items-center">
                    @if($result['poster_path'])
                  <img src="{{'https://image.tmdb.org/t/p/w92/'.$result['poster_path']}}" alt="Poster" class="w-8">
                  @else
                     <img src="https://vai.placeholder.com/50x75" alt="Poster" class="w-8">
                  @endif

                  <span class="ml-4">{{ $result['title'] }}</span>

                </a>
            </li>
          @endforeach
        </ul>
        @else
        <div class="px-3 py-3">No Results For "{{$search}}"</div>
        @endif
    </div>
    @endif
</div>
