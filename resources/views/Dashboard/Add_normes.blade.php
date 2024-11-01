
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    @if(session('success'))
    <div class="bg-green-500 text-white p-4 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <!-- Hotel Information Section -->
    <div class="text-start bg-white mb-3 dark:bg-gray-700 p-6 rounded-lg shadow-lg">
        <h3 class="font-semibold text-2xl mb-3.5 dark:text-white font-serif">
            <span class="dark:text-white">Bienvenue M. </span>
            <span class="text-cyan-400">{{ Auth::user()->Prenom }} {{ Auth::user()->Nom }}</span>
        </h3>
        <h3 class="font-semibold text-2xl mb-3.5 dark:text-white font-serif">
            <span class="dark:text-white">Mission d'hotel :</span>
            <span class="text-cyan-400">{{ $hotel->Nom }}</span>
        </h3>
        <h3 class="font-semibold text-2xl mb-3.5 dark:text-white font-serif">
            <span class="dark:text-white">Ville d'hotel :</span>
            <span class="text-cyan-400">{{ $hotel->Ville->name }}</span>
        </h3>
        <h3 class="font-semibold text-2xl mb-3.5 dark:text-white font-serif">
            <span class="dark:text-white">Categorie d'hotel :</span>
            <span class="text-cyan-400"'>{{ $hotel->categorie }}</span>
        </h3>
    </div>

    <!-- Normes List Section -->
    @forelse ($groupedNormes as $item => $normesGroup)
    <!-- Display Item -->
    <div class=" mb-3 dark:bg-gray-800 p-6 rounded-lg shadow-lg">
        <h3 class="text-cyan-400 dark:text-cyan-400 font-bold  mb-3 ">{{ $normesGroup->first()->item->libelle }}</h3>
    </div>

    <!-- Display Normes -->
    @foreach ($normesGroup as $norme)
    <div class="bg-white mb-3 dark:bg-gray-700 p-6 rounded-lg shadow-lg">
        <div class="mb-6">
            <label for="inspection_{{ $norme->id }}" class="block dark:text-slate-100 text-sm font-medium mb-2">
                {{ $norme->Normes }}
            </label>
            <input type="hidden" id="item_{{ $norme->id }}" value="{{ $norme->ITEM }}">
            <input type="hidden" id="score_{{ $norme->id }}" value="{{ $norme->{$hotel_categorie} }}">
            <select id="inspection_{{ $norme->id }}" class="block w-full mt-1 mb-2 border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm">
                <option value="Non inspecté">Non inspecté</option>
                <option value="conforme">Conforme</option>
                <option value="non_conforme">Non conforme</option>
            </select>
            <textarea id="comment_{{ $norme->id }}" class="block w-full mt-1 border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm" placeholder="Commentaire"></textarea>
        </div>
    </div>
    @endforeach
    @empty
    <div class="bg-white mb-3 dark:bg-gray-700 p-6 rounded-lg shadow-lg">
        <p class="text-center text-gray-500">No normes available.</p>
    </div>
    @endforelse
</div>

<div id="item-counts" class="container mx-auto p-6">
    <div id="item-counts" class="container mx-auto p-6">
        <form id="resumeForm" method="POST" action="{{ route('missions.storeResume', $ID_Mission) }}">
            @csrf
            <div class="mt-4">
                <textarea id="resume" name="resume"  class="block w-full mt-1 border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm" placeholder="Enter resume here...">{{ old('resume', $resume) }}</textarea>
            </div>
            <div class="mt-2 flex">
                @if($resume)
                    <button type="submit" class="focus:outline-none text-white bg-blue-800 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 m-2 dark:bg-green-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Mise à jour </button>
                @else
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Ajouter Resume</button>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- <div class="text-end mb-10 mx-4">
    <a href="{{ route('generate_pdf', ['hotel_id' => $hotel_id, 'legende_id' => $legende_id, 'ID_Mission' => $ID_Mission]) }}" class="focus:outline-none text-white bg-blue-800 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 m-2 dark:bg-green-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Télécharger le rapport
    </a>
</div> -->

@php
    $url = route('page_rapport', ['legende_id' => $legende_id, 'hotel_id' => $hotel_id]) . '?ID_Mission=' . $ID_Mission;
@endphp
<div class="text-end my-4 mx-4">
    <a href="{{ $url }}" class="focus:outline-none text-white bg-blue-800 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 m-2 dark:bg-green-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Voir le rapport
    </a>
</div>
{{-- @php
$url = route('page_rapport', ['legende_id' => $legende_id, 'hotel_id' => $hotel_id]) . '?ID_Mission=' . $ID_Mission;
@endphp

<div class="text-end my-4 mx-4">
    <a href="{{ $url }}" class="focus:outline-none text-white bg-blue-800 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 m-2 dark:bg-green-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Voir Rapport
    </a>
</div> --}}

<div class="m-6">
    {{ $normes->appends(['ID_Mission' => $ID_Mission])->onEachSide(1)->links() }}
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Set up AJAX with CSRF token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Function to retrieve stored responses based on hotel ID and mission ID
    function getStoredResponses(hotel_id, mission_id) {
        $.ajax({
            url: '{{ route("get.stored.responses") }}',
            method: 'POST',
            data: {
                hotel_id: hotel_id,
                mission_id: mission_id,
            },
            success: function(response) {
                // Handle the response here, you can update the UI with the stored responses
                console.log('Stored responses:', response);
                // Example: prefill select and textarea elements
                response.forEach(function(item) {
                    $('#inspection_' + item.norm_id).val(item.verifie);
                    $('#comment_' + item.norm_id).val(item.remarques);
                });
            },
            error: function(xhr, status, error) {
                console.error('An error occurred while retrieving stored responses:', error);
            }
        });
    }

    // Call the function to retrieve stored responses when the page loads
    getStoredResponses('{{ $hotel_id }}', '{{ $ID_Mission }}');

    // Event listener for change events on select and textarea elements
    $('select[id^="inspection_"], textarea[id^="comment_"]').on('change', function() {
        var id = $(this).attr('id').split('_')[1];
        var inspectionValue = $('#inspection_' + id).val();
        var commentValue = $('#comment_' + id).val();
        var scoreValue = $('#score_' + id).val();

        // AJAX request to save the selected value
        $.ajax({
            url: '{{ route("save.normes") }}',
            method: 'POST',
            data: {
                mission: '{{ $ID_Mission }}',
                hotel_id: '{{ $hotel_id }}',
                norm_id: id,
                id_item: $('#item_' + id).val(),
                score: scoreValue,
                remarques: commentValue,
                verifie: inspectionValue
            },
            success: function(response) {
                console.log('Data saved successfully');
            },
            error: function(xhr, status, error) {
                console.error('An error occurred while saving data:', error);
            }
        });
    });
});
</script>
@endsection