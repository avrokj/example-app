<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Search books') }} <!-- __( tähendab tõlke funktsiooni. Topelt nibudega sulud tähendavad php koodi -->
        </h2> 
      </div>
      <div>   
        <form action="{{ route('search') }}" method="GET">
          <x-text-input type="text" name="search books here..." value="{{ request('search') }}" required/>
          <x-primary-button type="submit">Search</x-primary-button>
        </form>
      </div>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 flex-grow overflow-auto">
          <table class="relative w-full rounded-lg">            
            <thead class="bg-neutral-100">
              <tr>
                <th class="text-left py-2 rounded-t-md">Name</th>
                <th class="text-left py-2 rounded-t-md">Released</th>
                <th class="text-left py-2 rounded-t-md">Language</th>
                <th class="text-left py-2 rounded-t-md">Price</th>
                <th class="text-left py-2 rounded-t-md">Type</th>
                <th class="text-left py-2 rounded-t-md">Action</th>
              </tr>
            </thead>
            <tbody>
              @if($books->isNotEmpty())
            @foreach ($books as $book)
              <tr class="border-b justify-between items-center transition duration-300 ease-in-out hover:bg-neutral-50">
                <td>
                  <a href="{{route('books.show', $book)}}">
                    {{ $book->title }}
                  </a> 
                </td>
                <td>
                  {{ $book->release_date }} 
                </td>
                <td>
                  {{ $book->language }} 
                </td>
                <td>
                  {{ $book->price }} 
                </td>
                <td>
                  @if ($book->type == 'used')
                  <span class="px-2 py-1 bg-red-200 rounded-full">
                    {{ $book->type }}
                  </span>
                  @elseif($book->type == 'new')
                  <span class="px-2 py-1 bg-green-200 rounded-full">
                    {{ $book->type }}
                  </span>
                  @elseif($book->type == 'ebook')
                  <span class="px-2 py-1 bg-blue-200 rounded-full">
                    {{ $book->type }}
                  </span>
                  @else
                  <span class="px-2 py-1 bg-gray-200 rounded-full">
                    {{ $book->type }}
                  </span>
                  @endif 
                </td>
                <td>
                  <div class="flex">
                  <a href="{{route('books.edit', $book)}}" class="text-white bg-blue-500 hover:bg-blue-600 rounded-md text-sm px-2 py-1 mr-2 focus:outline-none uppercase font-semibold tracking-widest text-xs">
                    {{ __('Edit') }}
                  </a>
                  <form method="POST" action="{{ route('books.destroy', $book) }}">
                    @csrf
                    @method('delete')
                    <x-danger-button onclick="event.preventDefault(); this.closest('form').submit();">
                      {{ __('Delete') }}
                    </x-danger-button>
                </form></div>
                </td>
              </tr> 
            @endforeach
            @else 
                <div>
                    <h2>No books found, search again or turn back to <a href="/">books page</a>.</h2>
                </div>
            @endif         
            </tbody>
          </table>
        <div class="pt-4">
        </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>