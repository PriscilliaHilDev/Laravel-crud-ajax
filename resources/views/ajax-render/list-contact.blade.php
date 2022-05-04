@if($contacts->count())
<ul role="list" id='list-contact' class="p-6 divide-y divide-slate-10">
    @foreach ($contacts as $contact)
        <li class="flex py-4 first:pt-0 last:pb-0 shrink-2" id={{$contact->id}}>
            <div id='card-contact' class=" py-8 px-8 w-1/2 hover:bg-red-300 mx-auto bg-white rounded-xl shadow-lg space-y-2 sm:py-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-6">
                <img id='avatar' class="block  mx-auto w-32	h-32 rounded-r-lg sm:mx-0 sm:shrink-0"  src="{{$contact->image_url ? Storage::url($contact->image_url) : ""}}" alt="Woman's Face">
                <div class="space-y-2 sm:text-left w-full ">
                    <span class='flex justify-end'>X</span>
                    <div class="space-y-0.5">
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