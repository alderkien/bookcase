@extends('layouts.app')

@section('content')

<div class="container">
    @if(session()->get('success'))
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="alert alert-success">
                {{ session()->get('success') }}  
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <form class="form-inline" method="GET" action="{{ route('books') }}">
                <div class="form-group mx-sm-12 mb-2">
                    <label for="search" class="sr-only">Поиск</label>
                    <input type="text" name="search" class="form-control" value="{{ old('search') }}" id="search" placeholder="Поиск">
                </div>
                <button type="submit" class="btn btn-primary mb-2">Поиск</button>
            </form>
        </div>
    </div>
    <div class="row justify-content-left mb-2">
        @forelse($books as $book)
        <div class="col-lg-4 col-md-4 col-sm-12 mb-2">
            <div class="card">
                <div class="card-header text-center">{{ $book->name }}</div>
                <div class="card-body">
                Авторы: 
                @foreach($book->authors as $author)
                    {{ $author->name }} {{ $author->surname }}{{ $loop->last ? '' : ', ' }}
                @endforeach
                </div>
            </div>
        </div>
        @empty
        <div class="col-lg-4 col-md-4 col-sm-12 mb-2">
            <h2>Ничего не найдено</h2>
        </div>
        @endforelse
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            {{ $books->appends(request()->input())->links() }}
        </div>
    </div>
</div>
@endsection