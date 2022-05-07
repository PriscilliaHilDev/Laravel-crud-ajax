<!--
  This example requires Tailwind CSS v2.0+ 
  
  This example requires some changes to your config:
  
  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->
<!--
  This example requires updating your template:

  ```
  <html class="h-full bg-gray-50">
  <body class="h-full">
  ```
-->
<div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 ">
  <div class="max-w-md w-full">
    <button id='load-form' disabled type="button" class= " block py-2.5 px-5 mr-2 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center">
      <svg role="status" class="inline w-4 h-4 mr-2 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
      <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2"/>
      </svg>
          Loading...
      </button>
        <form  class='hidden' action="{{route('send-contact')}}" id='form-add' method="post" enctype="multipart/form-data">
          @csrf
          <div class="mb-6">
            <label for="nom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nom du contact</label>
            <input type="text" name='nom' id="input-form" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" >
            <p class="mt-2 text-sm text-red-600 dark:text-red-500 font-medium error-text" id='error_nom'></p>
            {{-- @if($errors->has('nom'))
              <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{$errors->first('nom')}}</span></p>
            @endif --}}
          </div>
          <div class="mb-6">
            <label for="prenom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Prénom du contact</label>
            <input type="text" name='prenom' id="input-form"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com">
            <p class="mt-2 text-sm text-red-600 dark:text-red-500 font-medium error-text" id="error_prenom"><span class="font-medium"></span></p>
            {{-- @if($errors->has('prenom'))
              <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{$errors->first('prenom')}}</span></p>
            @endif --}}
          </div>
          <label for="membres" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Liens</label>
          <select id="membres" name='membres' class="block p-2 mb-6 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected></option>
            <option value="Collegues">Collégues</option>
            <option value="Ami(e)s">Ami(e)s</option>
            <option value="Famille">Famille</option>
          </select>
          <div class="mb-8">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email du contact</label>
            <input type="email" name='email' id="input-form" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
            <p class="mt-2 text-sm text-red-600 dark:text-red-500 font-medium error-text" id='error_email'><span class="font-medium"></span></p>
            {{-- @if($errors->has('email'))
              <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{$errors->first('email')}}</span></p>
            @endif --}}
          </div>
          <div class="mb-6">
            <div class="p-6 w-full flex justify-center  bg-white flex-wrap rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
              <img id='avatar-contact-form' class="p-8 shadow-lg rounded-lg w-80 h-64 " src=""/>
              <input name='avatar' id="input-form" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file">
            </div>
            <p class="mt-2 text-sm text-red-600 dark:text-red-500 font-medium error-text" id='error_avatar'><span class="font-medium"></span></p>
            {{-- @if($errors->has('avatar'))
              <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{$errors->first('avatar')}}</span></p>
            @endif --}}
          </div>
         
          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button id='sendData' class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
              Enregistrer
            </button>
            <button type="button" id='cancel' class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
              Annuler
            </button>
          </div>
        </form>
  </div>
</div>
