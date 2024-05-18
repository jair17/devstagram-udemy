@extends('layouts.app')

@section('title')
    {{__('Home')}}
@endsection
@section('content')
   <x-list-post :posts="$posts" />
@endsection
