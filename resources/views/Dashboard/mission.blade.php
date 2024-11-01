@extends('layouts.app')
@section('content')
@if(session('success'))
    <div class="bg-green-500 text-white p-4 rounded mb-4">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="bg-red-500 text-white p-4 rounded mb-4">
        {{ session('error') }}
    </div>
@endif


<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            <div
                class="flex overflow-x-auto flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div
                    class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <button type="button" id="createmissionModalButton" data-modal-target="createmissionModal"
                        data-modal-toggle="createmissionModal"
                        class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Ajouter mission
                    </button>
                    <form class="flex flex-col sm:flex-row gap-1" action="{{ route('missions.search') }}" method="post">
                        @csrf

                        <div class="flex-1 mt-2 sm:mt-0">
                            <select id="statutSelect" name="Statut"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-white">
                                <option value="">Choisir une Statut</option>
                                <option value="désignée">désignée</option>
                                <option value="En cours">En cours</option>
                                <option value="Terminée">Terminée</option>
                                <option value="Annulée">Annulée</option>
                            </select>
                        </div>
                        <div class="flex-1 mt-2 sm:mt-0">
                            <select id="auditeurSelect" name="user_id"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-white">
                                <option value="">Choisir une Auditeur</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->Nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex-1 mt-2 sm:mt-0">
                            <select id="legendeSelect" name="legende_id"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-white">
                                <option value="">Choisir Description de legende</option>
                                @foreach($legendes as $legende)
                                    <option value="{{ $legende->id }}">{{ $legende->Description }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-2 sm:mt-0">
                            <button id="searchButton" type="submit"
                                class="w-full sm:w-auto px-6 py-2 bg-green-800 text-white rounded-md hover:bg-green-900 focus:outline-none focus:ring-2 focus:ring-purple-600">Recherche</button>
                        </div>
                    </form>
                    <div class="mt-2">
                        <a href="{{ route('showmisson') }}">
                            <button
                                class="w-full sm:w-auto px-6 py-2 bg-red-800 text-white rounded-md hover:bg-red-900 focus:outline-none focus:ring-2 focus:ring-purple-600">Reset</button>
                        </a>
                    </div>

                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Description</th>
                            <th scope="col" class="px-6 py-3">Statut</th>
                            <th scope="col" class="px-6 py-3">Auditeur</th>
                            <th scope="col" class="px-6 py-3">Légende</th>
                            <th scope="col" class="px-6 py-3">Nom de l'hôtel</th>
                            <th scope="col" class="px-6 py-3">Ville d'hôtel</th>
                            <th scope="col" class="px-6 py-3">Commencer Mission</th>
                            <th scope="col" class="px-6 py-3">Modifier Mission</th>
                            <th scope="col" class="px-6 py-3">Supprimer Mission</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($missions as $mission)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-6 py-4">{{ Str::limit($mission->Description, 50, '...') }}</td>
                                <td class="px-6 py-4">{{ $mission->Statut }}</td>
                                <td class="px-6 py-4">{{ $mission->user->Nom }}</td>
                                <td class="px-6 py-4">{{ Str::limit($mission->Description, 50, '...') }}</td>
                                <td class="px-6 py-4">{{ $mission->hotel->Nom }}</td>
                                <td class="px-6 py-4">{{ $mission->hotel->ville->name}}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('details', ['ID_Mission' => $mission->ID_Mission]) }}"
                                        class="inline-block focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2 dark:bg-green-500 dark:hover:bg-green-700 dark:focus:ring-green-800">Voir
                                        détail</a>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('missions.edit', ['mission' => $mission->ID_Mission]) }}"
                                        class="inline-block focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2 dark:bg-yellow-400 dark:hover:bg-yellow-500 dark:focus:ring-yellow-600">Modifier
                                        Mission</a>
                                </td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('missions.destroy', ['mission' => $mission->ID_Mission]) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this mission?');">
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Create modal -->

<div id="createmissionModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Ajouter mission</h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-target="createmissionModal" data-modal-toggle="createmissionModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('add_missions') }}" method="POST">
                @csrf

                <div>
                    <label for="Description"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                    <textarea name="Description" id="Description" rows="4"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"></textarea>
                </div>
                <div>
                    <label for="Statut"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Statut</label>
                    <select name="Statut" id="Statut"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        required>
                        <option value="désignée">désignée</option>
                        <option value="En cours">En cours</option>
                        <option value="Terminée">Terminée</option>
                        <option value="Annulée">Annulée</option>
                    </select>
                </div>

                <div>
                    <label for="user_id"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Auditeur</label>
                    <select name="user_id" id="user_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        required>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->Nom }} {{ $user->Prenom }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="legende_id"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Légende</label>
                    <select name="legende_id" id="legende_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        required>
                        @foreach ($legendes as $legende)
                            <option value="{{ $legende->id }}">{{ $legende->Description }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="hotel_id"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hôtel</label>
                    <select name="hotel_id" id="hotel_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        required>
                        @foreach ($hotels as $hotel)
                            <option value="{{ $hotel->id }}">{{ $hotel->Nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-4">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Creer une Mission</button>
                </div>
            </form>

        </div>
    </div>

    @endsection



    <script>
        // delete functionality
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('[data-modal-target="deleteModal"]');
            const deleteModal = document.getElementById('deleteModal');
            const deleteForm = document.getElementById('deleteForm');
            const deleteRecordIdInput = document.getElementById('deleteRecordId');
            const deleteConfirmButton = deleteModal.querySelector('.delete-confirm-button');

            deleteButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    const recordId = button.getAttribute('data-record-id');
                    const deleteAction = button.getAttribute('data-action');

                    deleteForm.action = deleteAction;
                    deleteRecordIdInput.value = recordId;

                    deleteModal.classList.remove('hidden');
                });
            });

            deleteForm.addEventListener('submit', function (e) {
                e.preventDefault();

                fetch(deleteForm.action, {
                    method: 'POST',
                    body: new FormData(deleteForm),
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            console.log(data.message);

                            const successMessage = document.getElementById('successMessage');
                            if (successMessage) {
                                successMessage.innerText = data.message;
                            }

                            location.reload();
                        } else {
                            console.error(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error deleting record:', error.message);
                    })
                    .finally(() => {
                        deleteModal.classList.add('hidden');
                    });
            });
        });
    </script>