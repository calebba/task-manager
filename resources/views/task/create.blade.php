<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <a href="#" >
                {{ $project->name }}
            </a>
            <a href="{{ route('projects.tasks.index', $project->id) }}" >
                {{ ('.Tasks') }}
            </a>
            <a href="#" class="">
                    {{ __('.Create') }}
            </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mx-auto">
                        <h2 class="text-2xl font-bold mb-4">Create Task</h2>
                        <form action="{{ route('projects.tasks.store', $project->id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="block mb-1">Name:</label>
                                <input type="text" id="name" name="name" required
                                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500  text-gray-900 dark:text-gray-900">
                            </div>
                            <div class="mb-4">
                                <label for="description" class="block mb-1">Description:</label>
                                <textarea id="description" name="description"
                                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500 text-gray-900 dark:text-gray-900"></textarea>
                            </div>
                            <div class="mb-4" style="display: none;"> 
                                <input type="text" id="project_id" name="project_id" required
                                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500  text-gray-900 dark:text-gray-900" value="{{ $project->id}}">
                            </div>
                            <div class="mb-4">
                                <label for="user_id" class="block font-semibold">Assign To</label>
                                <select id="user_id" name="user_id" class="block w-full mt-1  text-gray-900 dark:text-gray-900">
                                    <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="priority" class="block font-semibold">Priority</label>
                                <select id="priority" name="priority" class="block w-full mt-1  text-gray-900 dark:text-gray-900">
                                    <option value="1">Low</option>
                                    <option value="2">Medium</option>
                                    <option value="3">High</option>
                                </select>
                            </div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Create
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

