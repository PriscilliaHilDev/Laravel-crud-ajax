@extends('base')
@include('partials.navbar')
@section('content')
    <button id='new-contact' class="hidden relative inline-flex items-center justify-center p-1  overflow-hidden text-sm rounded-lg group bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800">
        <span class="relative px-5 py-5 hover:text-white transition-all ease-in duration-75 text-black bg-white rounded-md group-hover:bg-opacity-0 font-medium text-2xl ">
           Ajouter contacts 
        </span>
    </button>
    
        @include('ajax-render.list-contact')
 
@if($contacts->count())
<div id='pagination' class="flex flex-col items-center">
    <!-- Help text -->
    <span class="text-sm text-gray-700 dark:text-gray-400">
        Pagination <span id ='current-page' data-page={{$currentPage}} class="font-semibold text-gray-900 ">{{$currentPage}}</span> sur <span class="font-semibold text-gray-900 ">{{$lastPage}}</span> of <span class="font-semibold text-gray-900 "> {{$total}} </span>contacts trouvés
    </span>
  <!-- Buttons -->
    <div class="inline-flex mt-2 xs:mt-0">
        <button id='prev-filtre' class="py-2 px-4 text-sm font-medium text-white bg-gray-800 rounded-l hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            Prev
        </button>
        <button id='next-filtre' data-max={{$lastPage}} class="py-2 px-4 text-sm font-medium text-white bg-gray-800 rounded-r border-0 border-l border-gray-700 hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            Next
        </button>
    </div>
</div>
@endif
@endsection