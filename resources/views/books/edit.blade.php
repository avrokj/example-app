<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Edit Book') }}: {{ $book->title }} <!-- __( tähendab tõlke funktsiooni. Topelt nibudega sulud tähendavad php koodi -->
    </h2>
  </x-slot>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 flex-grow overflow-auto">
          <form method="POST" action="{{ route('books.update', $book) }}" class="flex flex-col">
              @csrf
              @method('patch')
              <x-input-label for="title" value="Title" class="pt-4" />
              <x-text-input name="title" value="{{ old('title', $book->title) }}" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
              
              <x-input-label for="language" value="Language" class="pt-4" />
              <x-text-input name="language" value="{{ old('language', $book->language) }}" />
                <x-input-error :messages="$errors->get('language')" class="mt-2" />
                  
              <x-input-label for="price" value="Price" class="pt-4" />              
                  <x-text-input name="price" value="{{ old('price', $book->price) }}" />
                <x-input-error :messages="$errors->get('price')" class="mt-2" />
                <x-input-error :messages="$errors->get('release_date')" class="mt-2" />
                  
              <x-input-label for="release_date" value="Released" class="pt-4" />              
                  <x-text-input name="release_date" value="{{ old('release_date', $book->release_date) }}" />
                <x-input-error :messages="$errors->get('release_date')" class="mt-2" />
                  
              <x-input-label for="pages" value="Pages" class="pt-4" />              
                  <x-text-input name="pages" value="{{ old('pages', $book->pages) }}" />
                <x-input-error :messages="$errors->get('pages')" class="mt-2" />
                <x-input-error :messages="$errors->get('release_date')" class="mt-2" />
                  
              <x-input-label for="stock_saldo" value="Stock saldo" class="pt-4" />              
                  <x-text-input name="stock_saldo" value="{{ old('stock_saldo', $book->stock_saldo) }}" />
                <x-input-error :messages="$errors->get('stock_saldo')" class="mt-2" />
                  
              <x-input-label for="type" value="Type" class="pt-4" />
                  <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="type" id="type">
                    <option value="new" {{ $book->type == "new" ? "selected" : "" }}>new</option>
                    <option value="ebook" {{ $book->type == "ebook" ? "selected" : "" }}>ebook</option>
                    <option value="used" {{ $book->type == "used" ? "selected" : "" }}>used</option>
                  </select>
              
                  <x-input-label for="pages" value="Pages" class="pt-4" />              
                  <x-text-input name="pages" value="{{ old('pages', $book->pages) }}" />
                <x-input-error :messages="$errors->get('pages')" class="mt-2" />
                <x-input-error :messages="$errors->get('release_date')" class="mt-2" />
              
              <x-input-label for="summary" value="Summary" class="pt-4" />
                  <textarea name="summary" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('summary', $book->summary) }}</textarea>
                <x-input-error :messages="$errors->get('summary')" class="mt-2" />
              <div class="mt-4 space-x-2">
                  <x-primary-button>{{ __('Save') }}</x-primary-button>
                  <a href="{{ route('books.index') }}" class="text-white bg-red-500 hover:bg-red-600 rounded-md text-sm px-4 py-2 focus:outline-none uppercase font-semibold text-xs">{{ __('Cancel') }}</a>
              </div>
          </form> 
          <div class="py-6 text-gray-900 flex-grow overflow-auto"> 
            <x-input-label for="summary" value="Authors" class="pt-4 text-3xl" />   
            @foreach ($book->authors as $author)
                <div class="flex items-center gap-2 p-1">
                  {{ $author->first_name }} {{ $author->last_name }} 
                  <form method="POST" action="{{ route('book.detach.author', $book) }}">
                    @csrf
                    @method('delete')
                    <input type="hidden" value="{{ $author->id }}" name="author_id">
                    <x-danger-button onclick="event.preventDefault(); this.closest('form').submit();">
                      {{ __('Delete') }}
                    </x-danger-button>
                  </form>
                </div>
            @endforeach

            <form method="POST" action="{{ route('book.attach.author', $book) }}" class="flex flex-col">
              @csrf
              @method('post')
              <x-input-label for="author_id" value="Add author:" class="pt-4" />
                  <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="author_id" id="author_id">                   
                    <option selected="true" disabled="disabled">-- choose author --</option>
                    @foreach ($authors as $author)
                      <option value="{{ $author->id }}">{{ $author->first_name }} {{ $author->last_name }}</option>
                    @endforeach
                  </select>
              <div class="mt-4 space-x-2">
                  <x-primary-button>{{ __('Add author') }}</x-primary-button>
              </div>
          </form> 
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>