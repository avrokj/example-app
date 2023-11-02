<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Clients') }} <!-- __( tähendab tõlke funktsiooni. Topelt nibudega sulud tähendavad php koodi -->
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 flex-grow overflow-auto">
          <table class="relative w-full">            
            <thead class="bg-neutral-100 text-left">
              <tr class="text-left py-4">
                <th class="text-left py-2 rounded-t-md">Firstname</th>
                <th class="text-left py-2 rounded-t-md">Lastname</th>
                <th class="text-left py-2 rounded-t-md">Email</th>
                <th class="text-left py-2 rounded-t-md">Address</th>
                <th class="text-left py-2 rounded-t-md">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($clients as $client)
              <tr class="border-b justify-between items-center transition duration-300 ease-in-out hover:bg-neutral-100"">
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
                  <form method="POST" action="{{ route('clients.destroy', $client) }}">
                    @csrf
                    @method('delete')
                    <x-danger-button onclick="event.preventDefault(); this.closest('form').submit();">
                      {{ __('Delete') }}
                    </x-danger-button>
                  </form>
                </td>
              </tr>
              @endforeach            
            </tbody>
          </table>
          <div class="pt-4">
            {{ $clients->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>