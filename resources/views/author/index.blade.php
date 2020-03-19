@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-left">
            @foreach($authors as $author)
            <div class="col-lg-4 col-md-4 col-sm-12 mb-2">
                <div class="card">
                    <div class="card-header">
                        {{ $author->full_name() }}
                    </div>
                    <div class="card-body">
                        Книг автора: {{ $author->books_count }}
                    </div>
                </div>
            </div>
            @endforeach
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            {{ $authors->links() }}
        </div>
    </div>
</div>
@endsection