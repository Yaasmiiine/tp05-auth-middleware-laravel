@extends('layout')

@section('title', 'Modifier l\'article')

@section('content')
<h2>Modifier l'article</h2>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('articles.update', $article) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div>
        <label>Titre</label><br>
        <input type="text" name="title" value="{{ old('title', $article->title) }}" required>
    </div>
    <div style="margin-top:10px;">
        <label>Contenu</label><br>
        <textarea name="content" rows="5" required>{{ old('content', $article->content) }}</textarea>
    </div>
    <div style="margin-top:10px;">
        <label>Image (optionnelle)</label><br>
        @if($article->image_path)
            <div style="margin-bottom:5px;">
                <img src="{{ asset('storage/'.$article->image_path) }}" alt="Image" width="150">
            </div>
        @endif
        <input type="file" name="image" accept="image/*">
    </div>
    <div style="margin-top:15px;">
        <button type="submit">Modifier</button>
        <a href="{{ route('articles.index') }}">Annuler</a>
    </div>
</form>
@endsection
