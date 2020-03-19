@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Добавить книгу</h1>
        <div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
            @endif
            <form method="post" action="{{ route('books.store') }}">
                @csrf
                <div class="form-group">    
                    <label for="name">Заголовок:</label>
                    <input type="text" class="form-control" value="{{ old('name') }}" name="name"/>
                </div>
                <div class="form-group">
                    <label for="description">Описание:</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="isbn">ISBN:</label>
                    <input type="text" class="form-control" value="{{ old('isbn') }}" name="isbn"/>
                </div>
                <div class="form-group">
                    <label for="authors">Авторы</label>
                    <select multiple class="form-control" name="authors[]" id="authors">
                        @foreach($authors as $author)
                        <option value="{{ $author->id }}">{{ $author->fullName }}</option>
                        @endforeach
                    </select>
                </div>
                            
                <button type="submit" class="btn btn-primary">Добавить</button>
            </form>
        </div>
    </div>
</div>
@endsection