    @extends('base')
    @section('content')
    <div class="flex justify-center items-center">
        @include("partials.navbar")
    </div>
        <div class="flex flex-wrap justify-evenly sm:column items-center m-8">
            <h2 class='text-center font-sherif text-4xl py-8 text-orange-700 font-bold'> Mes contacts  </h2>
            <button id='new-contact' class="relative inline-flex items-center justify-center p-1  overflow-hidden text-sm rounded-lg group bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800">
                <span class="relative px-5 py-5 hover:text-white transition-all ease-in duration-75 text-black bg-white rounded-md group-hover:bg-opacity-0 font-medium text-2xl ">
                   Ajouter contacts 
                </span>
            </button>
        </div>    
        
        <div id='refresh-list-ajax'></div>
    @endsection
   

