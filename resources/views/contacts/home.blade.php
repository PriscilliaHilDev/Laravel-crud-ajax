@extends('base')

<!-- This example requires Tailwind CSS v2.0+ -->

<div class="relative bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto">
        <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
            <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
            <polygon points="50,0 100,0 50,100 0,100" />
            </svg>
        <div>
            @include("partials.navbar")
        
            <div class="absolute z-10 top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden">
                <div class="rounded-lg shadow-md bg-white ring-1 ring-black ring-opacity-5 overflow-hidden">
                    <div class="px-5 pt-4 flex items-center justify-between">
                        <div>
                            <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-orange-600.svg" alt="">
                        </div>
                        <div class="-mr-2">
                            <button type="button" class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-orange-500">
                                <span class="sr-only">Close main menu</span>
                                <!-- Heroicon name: outline/x -->
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <main class="mt-10 mx-auto max-w-7xl px-4 py-6 sm:mt-12 sm:px-7 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                <div class="sm:text-center lg:text-left">
                    <h1 class="text-4xl tracking-tight text-center font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                        <span class="block xl:inline">Gestionnaire</span>
                        <span class="block text-red-800 xl:inline">DE CONTACTS</span>
                    </h1>
                    <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-center">
                        <div class="mt-3 sm:mt-0 sm:ml-3">
                            <a href="{{ route('contacts') }}" class="relative inline-flex items-center justify-center p-1  overflow-hidden text-sm rounded-lg group bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800">
                                <span class="relative px-5 py-5 hover:text-white transition-all ease-in duration-75 text-black bg-white rounded-md group-hover:bg-opacity-0 font-medium text-2xl ">
                                    Consulter
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
        <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="{{asset("storage/images/people.jpg")}}" alt="">
    </div>
</div>
  