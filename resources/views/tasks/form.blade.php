<div>
    <x-input-label for="project_id" :value="__('Project')" />
    <select {{isset($task) ? 'disabled' : ''}} name="project_id" id="project_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
        @foreach($projects as  $project)
            <option value="{{$project->id}}" {{isset($task) && $task->project_id == $project->id}}>{{ucwords($project->title)}}</option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('project_id')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="title" :value="__('Name')" />
    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="isset($task) ? $task->title : old('title')" required autofocus autocomplete="username" required/>
    <x-input-error :messages="$errors->get('title')" class="mt-2" />
</div>
<!-- Password -->
<div class="mt-4">
    <x-input-label for="description" :value="__('Description')" />
    <textarea name="description" id="description" cols="30" rows="10" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{isset($task) ? $task->description : old('description')}}</textarea>
    <x-input-error :messages="$errors->get('description')" class="mt-2" />
</div>
