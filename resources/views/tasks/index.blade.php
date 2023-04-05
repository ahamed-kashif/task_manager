<x-app-layout :title="$title">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div id="bar" class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-row p-4 mb-4 justify-between">
                    <div>
                        <select class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" onchange="dispatchTaskFetchingEvent($(this).val())">
                            <option value="" disabled selected>Select Project</option>
                            @foreach($projects as  $project)
                                <option value="{{$project->slug}}">{{ucwords($project->title)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-center mt-2">
                        <button type="button" onclick="handleAddTask($(this))" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-3">Add Task</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div id="app">
                    <task-list update-url="{{route('axios.fetch.tasks.update.priority')}}"/>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div id="addTask" class="p-6 text-gray-900 mt-4" style="display: none">
                    <form action="{{route('tasks.store')}}" method="post">
                        @csrf
                        @include('tasks.form')
                        <div class="mt-4">
                            <x-primary-button class="ml-3" type="submit">
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="js">
        <script>
            let $showAddTask = false;
            function dispatchTaskFetchingEvent(eventPayload){
                let url = '{{route('axios.fetch.tasks',':id')}}';
                url = url.replace(':id',eventPayload);
                const event = new CustomEvent('fetch-tasks',{
                    detail : {
                        url:url
                    },
                    bubbles: true,
                    cancelable: true,
                    composed: false
                })
                document.dispatchEvent(event);
            }
            function handleAddTask(el){
                $showAddTask = !$showAddTask;
                let form = $('#addTask');
                if($showAddTask){
                    form.removeAttr('style')
                    el.html('Close Task Form');
                    document.getElementById('addTask').scrollIntoView();
                }else{
                    el.html('Add Task');
                    form.attr('style','display:none;');
                }
            }
        </script>
    </x-slot>
</x-app-layout>
