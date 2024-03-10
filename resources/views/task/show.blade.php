<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <p>
                <a href="#" >
                    {{ $project->name }}
                </a>
                <a href="{{ route('projects.tasks.index', $project->id) }}" >
                    {{ ('.Tasks') }}
                </a>
                <a href="#" class="#">
                    {{ __('.Details') }}
                </a>
            </p>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-bold mb-4">Task Details</h2>
                    <div>
                        <p class="font-bold">Name: {{ $task->name }}</p>
                    </div>
                    <div>
                        <p class="font-bold">Priority: {{ $task->priority==1 ? 'Low':( $task->priority==2 ? 'Medium': ( $task->priority==3 ? 'High': 'No Priority')) }}</p>
                    </div>
                    <div>
                        <p class="font-bold">Description: {{ $task->description }}</p>
                    </div>
                    <div>
                        <p class="font-bold">Assigned To: {{ $task->user->name }}</p>
                    </div>
                    <div>
                        <p class="font-bold">Project: {{ $task->project->name }}</p>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('projects.tasks.edit', [$task->project_id, $task->id]) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
