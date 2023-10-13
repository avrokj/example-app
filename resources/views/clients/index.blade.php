<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Clients') }} <!-- __( tähendab tõlke funktsiooni. Topelt nibudega sulud tähendavad php koodi -->
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <table class="table-auto">            
            <thead>
              <tr>
                <th>Eesnimi</th>
                <th>Perekonnanimi</th>
                <th>Year</th>
                <th>Artist</th>
                <th>Year</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($clients as $client)
            <tr class="flex border-b justify-between items-center">
              <td>
                  {{ $client->first_name }}
              </td>
              <td>
                  {{ $client->last_name }}
                </td>
                <td>
                  {{ $client->email }}
                </td>
                <td>
                  {{ $client->address }} 
                </td>
                  <td class="grid grid-cols-2 gap-2 pt-2">
                    <x-primary-button>edit</x-primary-button>
                    <x-danger-button>delete</x-danger-button>
                  </td>
                </td>
              </tr>
            @endforeach
            
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>