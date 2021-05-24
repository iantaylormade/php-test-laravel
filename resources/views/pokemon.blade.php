@extends('layouts.main')

@section('content')

    <div id="app" class="card bg-danger text-white">

        <div class="card-header py-0">
            <div class="d-sm-flex align-items-center">
                <a href="{{ route('pokedex') }}" class="btn btn-secondary">Back</a>
                <img class="mr-2 ml-auto" src="{{ $pokemon->sprites->front_default }}">
                <h2>#{{ $pokemon->id }} {{ ucwords(str_replace('-', ' ', $pokemon->name)) }}</h2>
            </div>
        </div>
        <div class="card-body">

            <div class="row d-flex align-center">
                <div class="col-6 col-lg-3">
                    <div class="small-text">Height</div>
                    <strong>{{ $pokemon->height }}</strong>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="small-text">Weight</div>
                    <strong>{{ $pokemon->weight }}</strong>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="small-text">Species</div>
                    <strong>{{ $pokemon->species->name }}</strong>
                </div>
                @foreach($pokemon->abilities as $key => $ability)
                    <div class="col-6 col-lg-3">
                        <div class="small-text">Ability {{ $key + 1 }}</div>
                        <strong>{{  ucwords(str_replace('-', ' ', $ability->ability->name)) }}</strong>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

@endsection
