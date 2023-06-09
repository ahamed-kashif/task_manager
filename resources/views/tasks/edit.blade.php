<x-app-layout :title="$title">
    <x-slot name="css">
        <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{route('tasks.update',$task->slug)}}" method="post">
                        @csrf
                        @method('PUT')
                        @include('tasks.form')
                        <div class="mt-4">
                            <x-primary-button class="ml-3">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="js">
        <script src="{{asset('js/app.js')}}" type="text/javascript"></script>
    </x-slot>
</x-app-layout>
