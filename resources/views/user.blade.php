@extends('layouts.app')

@section('content')
    @foreach($result as $user)
        @if(auth()->id())
            @if (auth()->id() == $user->id)
                <form method="post" action="{{ route('upload') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- поле для загрузки файла -->
                    <div class="input-group mb-3">
                        <input class="form-control" type="file" name="userfile">
                        <div class="input-group-append">
                            <button  class="btn btn-outline-secondary" type="submit">Загрузить</button>
                        </div>
                    </div>
                </form>
            @endif
        @endif

        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg mr-3 ml-3">
            <div class="p-6">
                <div class="flex items-center">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    <div class="ml-4 text-lg leading-7 font-semibold">
                        <a href="{{ $user->id }}" class="underline">{{ $user->name }}</a>
                    </div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 text-sm">
                        {{ $user->email }}
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div>
        <div class="flex items-center" style="width: 100%">
            @foreach($photos as $photo)
                <div class="card" style="width: 18rem">
                    <img class="" src="{{ asset($photo->photo_path.$photo->photo_name) }}"  alt="IMAGE"/>
                </div>
            @endforeach
        </div>
    </div>
@endsection


