<div class="flex justify-center items-center">
    <div class="relative pt-6 px-4 sm:px-6 lg:px-5">
        <nav class="relative flex items-center justify-between sm:h-10 lg:justify-start" aria-label="Global">
            <div class="hidden md:block md:ml-10 md:pr-4 md:space-x-8">
                <a href="{{ route('contacts') }}"  class="font-medium text-gray-500 hover:text-gray-800"> Mes contacts </a>
                <a href="{{ route('filtre-contact', ["membre" => "famille"]) }}"  class="font-medium text-gray-500 hover:text-gray-800">Ma famille </a>
                <a href="{{ route('filtre-contact', ["membre" => "amis"]) }}"  class="font-medium text-gray-500 hover:text-gray-900">Mes ami(e)s</a>
                <a href="{{ route('filtre-contact', ["membre" => "collegues"]) }}" class="font-medium text-gray-500 hover:text-gray-900">Mes collègues</a>
                <a href="{{ route('filtre-contact', ["membre" => "autres"]) }}"  class="font-medium text-orange-600 hover:text-orange-400">Autres</a>
            </div>
        </nav>
    </div>
</div>