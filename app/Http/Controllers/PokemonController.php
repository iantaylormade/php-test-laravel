<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Pokemon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use PokePHP\PokeApi;

class PokemonController extends Controller
{

    private $pokemon;

    public function __construct()
    {
        $this->pokemon = new Pokemon();
    }

    public function index()
    {
        if(Cache::has('pokemon_list')){
            $pokemon = Cache::get('pokemon_list');
        } else {
            $pokemonApiResults =$this->pokemon->all();

            $pokemon = array_map(function ($item){
                return $item->name;
            }, $pokemonApiResults);

            Cache::put('pokemon_list', $pokemon);
        }

        return view('pokedex', [
            'pokemon' => $pokemon
        ]);
    }

    public function find(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors([
                'issue' => 'Could not find the pokemon, did you check the grass?'
            ]);
        }

        return redirect()->route('pokemon', [$request->search]);
    }

    public function show($search)
    {
        $pokemon = $this->pokemon->find($search);

        if(is_null($pokemon)){

            $alternative = $this->potentialMatch($search);

            return redirect()->route('pokedex')->withErrors([
                'issue' => 'Pokemon not found :(',
                'alternative' => $alternative
            ]);
        }

        return view('pokemon', [
            'pokemon' => $pokemon
        ]);
    }

    private function potentialMatch($search)
    {
        if(!Cache::has('pokemon_list')){
            return null;
        }

        $search = strtolower(str_replace(' ', '-', $search));

        foreach (Cache::get('pokemon_list') as $pokemon)
        {
            if(strpos($pokemon, $search) === 0)
                return $pokemon;
        }

        return null;
    }
}
