@extends('layouts.main')

@section('content')

    <div class="card bg-danger text-white">
        <div class="card-header">
            <div class="d-sm-flex align-items-center">
                <h1>Pokedex</h1>
                <div class="ml-auto">
                    <form action="" method="POST">
                        @csrf
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <input type="text" class="form-control" id="search" name="search" value="{{ old('search', '') }}" placeholder="Search the pokedex...">
                            </div>
                            <button type="submit" class="btn btn-secondary">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body overflow-auto" style="max-height: 70vh">
            @foreach($pokemon as $key => $name)
                <div class="pokemon" data-name="{{ $name }}">
                    <a href="{{ route('pokemon', [$name]) }}" class="name d-block text-white">{{ ucwords(str_replace('-', ' ', $name)) }}</a>
                </div>
            @endforeach
        </div>
    </div>

@endsection

@section('footer-scripts')

    <script
        src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
        integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI="
        crossorigin="anonymous"></script>
    <script>

        $(document).ready(function () {

            var $rows = $('.pokemon');
            var $search = $('#search');

            $search.keyup(function () {
                let search = $search.val().toLowerCase().replace(' ', '-');

                $rows.each(function () {
                    let $row = $(this);
                    if($row.data('name').includes(search)){
                        $row.removeClass('d-none');
                    } else {
                        $row.addClass('d-none');
                    }
                });
            });
        });

    </script>
@endsection
