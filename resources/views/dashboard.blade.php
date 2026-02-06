@extends('layout')

@section('content')
<h2>Dashboard</h2>
Bienvenue {{ auth()->user()->name }}
@endsection
