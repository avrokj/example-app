<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Orders') }} <!-- __( tähendab tõlke funktsiooni. Topelt nibudega sulud tähendavad php koodi -->
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 flex-grow overflow-auto">
          <table class="relative w-full">            
            <thead class="bg-neutral-100 text-left">
              <tr class="text-left py-4">
                <th class="text-left py-2 rounded-t-md">Order</th>
                <th class="text-left py-2 rounded-t-md">Client</th>
                <th class="text-left py-2 rounded-t-md">Address</th>
                <th class="text-left py-2 rounded-t-md">Date</th>
                <th class="text-left py-2 rounded-t-md">Status</th>
                <th class="text-left py-2 rounded-t-md">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($orders as $order)
              <tr class="border-b justify-between items-center transition duration-300 ease-in-out hover:bg-neutral-100">
                <td>#{{ $order -> id }}</td>
                <td>{{ $order -> client_id }}</td>
                <td>{{ $order -> delivery_address }}</td>
                <td>{{ $order -> order_date }}</td>
                <td>
                  @if ($order->status == 'ordered')
                  <span class="px-4 py-1 font-bold text-white bg-red-400 rounded-full">
                    {{ $order->status }}
                  </span>
                  @elseif($order->status == 'sent')
                  <span class="px-4 py-1 font-bold text-white bg-green-500 rounded-full">
                    {{ $order->status }}
                  </span>
                  @elseif($order->status == 'paid')
                  <span class="px-4 py-1 font-bold text-white bg-blue-400 rounded-full">
                    {{ $order->status }}
                  </span>
                  @else
                  <span class="px-4 py-1 font-bold text-white bg-gray-300 rounded-full">
                    {{ $order->status }}
                  </span>
                  @endif                  
                </td>
                <td>
                  <div class="flex">
                    <x-primary-button>edit</x-primary-button>
                    <form method="POST" action="{{ route('orders.destroy', $order) }}">
                      @csrf
                      @method('delete')
                      <x-danger-button onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Delete') }}
                      </x-danger-button>
                    </form>
                  </div>
                </td>
              </tr>
            @endforeach
            </table>
            <div class="pt-4">
              {{ $orders->links() }}
            </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>