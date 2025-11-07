@extends('layouts.main')

@section('title', 'Új Város Létrehozása')

@section('content')
    <h2>Új Város Létrehozása</h2>

    <form action="{{ route('admin.varosok.store') }}" method="POST">
        @include('admin.varosok._form')
    </form>
@endsection