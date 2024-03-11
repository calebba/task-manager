<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <a href="#" >
                {{ $project->name }}
            </a>
            <a href="{{ route('projects.tasks.index', $project->id) }}" >
                {{ __('.Tasks') }}
            </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('projects.tasks.create', $project->id) }}" class="inline-flex items-center px-4 py-2 mb-5 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Create Task</a>
                    <!-- Iterate over tasks and group them by priority -->
                    @foreach ([1, 2, 3] as $priority)
                        @php
                            $priorityTasks = $tasks->where('priority', $priority);
                        @endphp

                            <div class="priority-group mb-4  bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 px-4" data-priority="{{ $priority }}" data-project="{{ $project->id }}">
                                <h3 class="text-lg font-semibold mb-2">
                                    Priority {{ $priority==1 ? 'Low' : ($priority==2 ? 'Medium' : ($priority==3 ? 'High': 'No Priority')) }}
                                    <hr>
                                </h3>

                                <!-- Display tasks for the current priority -->
                                <div class="sortable-tasks">
                                    @forelse ($priorityTasks as $task)
                                        <div class="task bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 p-4 mb-2 rounded-md cursor-move" data-task="{{ $task->id }}">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                    <circle cx="10" cy="10" r="8" />
                                                </svg>
                                                {{ $task->name }}
                                            </span>
                                            <a href="{{ route('projects.tasks.show', [$project->id, $task->id]) }}" class="inline-flex items-center px-2 py-1 bg-blue-500 text-white rounded-md ml-2">View</a>
                                            <a href="{{ route('projects.tasks.edit', [$project->id, $task->id]) }}" class="inline-flex items-center px-2 py-1 bg-yellow-500 text-white rounded-md">Edit</a>
                                            <form action="{{ route('projects.tasks.destroy', [$project->id, $task->id]) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 text-white rounded-md px-2 py-1" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                                            </form>
                                        </div>
                                    @empty
                                        <p>No tasks under priority</p>
                                    @endforelse
                                </div>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
