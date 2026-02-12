@extends('layout')

@section('title', 'Créer un article')

@section('content')
<h2>Créer un article</h2>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label>Titre</label><br>
        <input type="text" name="title" value="{{ old('title') }}" required>
    </div>
    <div style="margin-top:10px;">
        <label>Contenu</label><br>
        <textarea name="content" rows="5" required>{{ old('content') }}</textarea>
    </div>
    <div style="margin-top:10px;">
        <label>Image (optionnelle)</label><br>
        <input type="file" name="image" accept="image/*">
    </div>
    <div style="margin-top:15px;">
        <button type="submit">Créer</button>
        <a href="{{ route('articles.index') }}">Annuler</a>
    </div>
</form>
@endsection
