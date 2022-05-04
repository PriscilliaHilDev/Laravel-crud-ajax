

<!-- This example requires Tailwind CSS v2.0+ -->
<div class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true" id='overlay'>
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
      <!--
        Background overlay, show/hide based on modal state.
  
        Entering: "ease-out duration-300"
          From: "opacity-0"
          To: "opacity-100"
        Leaving: "ease-in duration-200"
          From: "opacity-100"
          To: "opacity-0"
      -->
      <div id='bg-modal' class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
  
      <!-- This element is to trick the browser into centering the modal contents. -->
      <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
  
      <!--
        Modal panel, show/hide based on modal state.
  
        Entering: "ease-out duration-300"
          From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          To: "opacity-100 translate-y-0 sm:scale-100"
        Leaving: "ease-in duration-200"
          From: "opacity-100 translate-y-0 sm:scale-100"
          To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
      -->
      <div class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
        <div class="bg-white pb-4 sm:p-6 sm:pb-4">
          <div class="flex sm:items-center justify-center">
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
              <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                 Création d'un nouveau contact
              </h3>
              <div class="mt-2">
                 @include('partials.form-add')
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- <div class="bg-black bg-opacity-50 absolute inset-0 hidden flex justify-center items-center" id="overlay">
    <div class="bg-gray-200 max-w-sm py-2 px-3 rounded shadow-xl text-gray-800">
        <div class="flex justify-between items-center">
            <h4 class="text-lg font-bold">Confirm Delete?</h4>
            <svg class="h-6 w-6 cursor-pointer p-1 hover:bg-gray-300 rounded-full" id="close-modal" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </div>
        <div class="mt-2 text-sm">
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maiores, sunt.</p>
        </div>
        <div class="mt-3 flex justify-end space-x-3">
            <button class="px-3 py-1 rounded hover:bg-red-300 hover:bg-opacity-50 hover:text-red-900" id='action'>Cancel</button>
            <button class="px-3 py-1 bg-red-800 text-gray-200 hover:bg-red-600 rounded"  id='action'>Delete</button>
        </div>
    </div>
</div> -->