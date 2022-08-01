<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class SearchDropdown extends Component
{
    public $search ='';


    public function render()
    {
         $searchresult = [];

 if (strlen($this->search) > 2) {
      $searchresult = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/search/multi?query='.$this->search)->json()['results'];
 }



        return view('livewire.search-dropdown',[
            'searchresult' => collect($searchresult)->take(10),
        ]);
    }
}
