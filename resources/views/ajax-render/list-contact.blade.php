@if($contacts->count())
    <div id='load-data' class="flex justify-center block">
        <svg role="status" class=" h-96 inline w-20 h-20  text-gray-200 animate-spin dark:text-gray-600 fill-orange-600 " viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
        </svg>
    </div>
    <ul role="list" id='list-contact' class=" hidden p-6 divide-y divide-slate-10">
    @foreach ($contacts as $contact)
        <li class="flex py-4 first:pt-0 last:pb-0 shrink-2" id={{$contact->id}}>
            <div id='card-contact' class=" py-8 px-8 w-1/2 hover:bg-red-300 mx-auto bg-white rounded-xl shadow-lg space-y-2 sm:py-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-6">
                <img id='avatar' class="block  mx-auto w-24	h-24 rounded-full  sm:mx-0 sm:shrink-0"  src="{{Storage::url($contact->image->path)}}" alt="{{$contact->prenom}}">
                <div class="space-y-2 sm:text-left w-full ">
                    <div id="dropdown" class="flex justify-end w-96 text-base list-none  rounded divide-y ">
                    <button type='button' id='delete' data-id={{$contact->id}}  class='rounded-lg p-2 py-0 bg-gray-100 flex items-end'>X</button>
                </div>
                    <div class="space-y-0.5">
                        <h5 id='contact-membres'>{{$contact->membres ? $contact->membres : ''}}</h5>
                        <p id='names' class="text-lg text-black font-semibold text-center break-words">
                          {{$contact->nom}} {{$contact->prenom}}
                        </p>
                        <p id='email' class="text-red-900 font-medium text-center break-words">
                          {{$contact->email}}
                        </p>
                    </div>
                    <div class='grid place-items-end' id='bloc-edit'>
                        <button type='button' id='editData' data-id={{$contact->id}} class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Modifier
                        </button>
                    </div>
                </div>
            </div>
        </li>
    @endforeach
    </ul>
    @else
        <div id='empty-contacts' class="flex justify-center items-center bg-red-500 py-2 m-8">
            <h2 class='text-center font-sherif text-4xl py-8 text-white font-bold'> Aucuns utilisateurs trouvés </h2>
        </div>
    @endif