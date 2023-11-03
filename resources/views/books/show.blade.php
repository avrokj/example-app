<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Books') }} <!-- __( tähendab tõlke funktsiooni. Topelt nibudega sulud tähendavad php koodi -->
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 flex-grow overflow-auto">
          <div class="container m-auto bg-white overflow-auto p-4">
            <div class="grid grid-cols-4 gap-4">
              <div class=""><img src="{{ $book->cover_path }}" class="object-contain w-full"></div>
              <div class="col-span-3">
                <h1 class="text-2xl">{{ $book->title }}</h1>
                <p class="py-2"><strong>Author: </strong>
                  <ul>
                    @foreach ($book->authors as $author)
                    <li>
                      {{ $author->first_name }} {{ $author->last_name }}
                    </li>
                    @endforeach
                    </ul>
                  <span></span>
                </p>
                <p class="py-2"><strong>Keel:</strong> {{ $book->language }}</p>
                <p class="py-2"><strong>Hind:</strong> <?= number_format($book['price'], 2); ?> € <small><em>(keskmine lehe hind: <?= round($book['price'] / $book['pages'], 2); ?> €)</em></small></p>
                <p class="py-2"><strong>Lehti:</strong> {{ $book->pages }}</p>
                <p class="py-2"><strong>Laoseis:</strong> {{ $book->stock_saldo }}</p>
                <p class="py-2"><strong>Raamatu tüüp:</strong> {{ $book->type }}</p>
                <!-- <p class="py-2"><strong>Olek:</strong> {{ $book->is_deleted }}</p> -->
              </div>
            </div>
      
            <div class="py-4"><strong>Kokkuvõte:</strong> {{ $book->summary }}</div>
      
            <div class="inline-flex pt-10">
              <a href="{{route('books.edit', $book)}}" class="text-white bg-blue-500 hover:bg-blue-600 rounded-md text-sm px-2 py-1 mr-2 focus:outline-none uppercase font-semibold tracking-widest text-xs">
                {{ __('Edit') }}
              </a>
              <form method="POST" action="{{ route('books.destroy', $book) }}">
                @csrf
                @method('delete')
                <x-danger-button onclick="event.preventDefault(); this.closest('form').submit();">
                  {{ __('Delete') }}
                </x-danger-button>
            </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>