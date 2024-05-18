@extends('layouts.app')

@section('title')
    {{__('Edit profile').': '.auth()->user()->username}}
@endsection
@section('content')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form method="POST" action="{{route('profile.update',auth()->user())}}" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @method('PUT')
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        {{__('Username')}}
                    </label>
                    <input type="text" id="username" name="username" placeholder="{{__('Your username')}}"
                           class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                           value="{{auth()->user()->username}}" />
                    @error('username')
                    <p class="bg-red-500  text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="file" class="mb-2 block uppercase text-gray-500 font-bold">
                        {{__('Profile Image')}}
                    </label>
                    <input type="file" id="file" name="file"
                           class="border p-3 w-full rounded-lg @error('file') border-red-500 @enderror" value=""
                           accept=".jpg,.jpeg,.png" />
                </div>

                <input type="submit"
                       class="bg-sky-600 hover-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                       value="{{__('Save changes')}}"/>
            </form>
        </div>
    </div>
@endsection
