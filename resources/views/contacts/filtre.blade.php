@extends('base')
@include('partials.navbar')
@section('content')
    <button id='new-contact' class="hidden relative inline-flex items-center justify-center p-1  overflow-hidden text-sm rounded-lg group bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800">
        <span class="relative px-5 py-5 hover:text-white transition-all ease-in duration-75 text-black bg-white rounded-md group-hover:bg-opacity-0 font-medium text-2xl ">
           Ajouter contacts 
        </span>
    </button>
@include('ajax-render.list-contact')
@endsection