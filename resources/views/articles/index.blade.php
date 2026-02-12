@extends('layout')

@section('content')

<div class="container">

    <h2>Liste des Articles</h2>

    {{-- Flash Message --}}
    @if(session('success'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('articles.create') }}">Créer un article</a>

    <br><br>

    <form method="GET" action="{{ route('articles.index') }}">
        <input type="text" name="search" placeholder="Rechercher par titre" value="{{ request('search') }}">
        <button type="submit">Rechercher</button>
    </form>
    <br>


    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Date de création</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($articles as $article)
                <tr>
                    <td>{{ $article->id }}</td>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->user->name }}</td>
                    <td>{{ $article->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('articles.show', $article) }}">Voir</a>

                        <a href="{{ route('articles.edit', $article) }}">Modifier</a>

                        <form action="{{ route('articles.destroy', $article) }}" 
                              method="POST" 
                              style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Supprimer cet article ?')">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>

    {{-- Pagination --}}
    {{ $articles->links() }}

</div>

@endsection
