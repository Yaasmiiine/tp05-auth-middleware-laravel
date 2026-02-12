@extends('layout')

@section('title', 'Détail de l\'article')

@section('content')
<h2>{{ $article->title }}</h2>

<p><strong>Auteur:</strong> {{ $article->user->name }}</p>
<p><strong>Contenu:</strong></p>
<p>{{ $article->content }}</p>

@if($article->image_path)
    <div style="margin-top:15px;">
        <img src="{{ asset('storage/'.$article->image_path) }}" alt="Image" width="300">
    </div>
@endif

<div style="margin-top:15px;">
    <a href="{{ route('articles.index') }}">Retour à la liste</a>
</div>
@endsection
