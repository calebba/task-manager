<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                   <div class="container mx-auto">

                        <div class="mb-4">
                            <label for="project_filter" class="block font-semibold">Filter by Project:</label>
                            <select id="project_filter" name="project_filter" class="block w-full mt-1  text-gray-900 dark:text-gray-900">
                                <option value="">All Projects</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Name</th>
                                    <th class="px-4 py-2">Description</th>
                                    <th class="px-4 py-2">Priority</th>
                                    <th class="px-4 py-2">Assigned To</th>
                                    <th class="px-4 py-2">Project</th>
                                    <th class="px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tasks as $task)
                                <tr data-project-id="{{ $task->project_id }}">
                                    <td class="border px-4 py-2">{{ $task->name }}</td>
                                    <td class="border px-4 py-2">{{ $task->description }}</td>
                                    <td class="border px-4 py-2">{{ $task->priority==1 ? "Low": ($task->priority==2 ? "Medium" : ($task->priority==3 ? "High" : "No Priority")) }}</td>
                                    <td class="border px-4 py-2">{{ $task->user->name }}</td>
                                    <td class="border px-4 py-2">{{ $task->project->name }}</td>
                                    <td class="border px-4 py-2">
                                        {{-- <a href="{{ route('projects.tasks.show', [$project->id, $task->id]) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">View</a> --}}
                                        <a href="{{ route('projects.tasks.edit', [$project->id, $task->id]) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Edit</a>
                                        <form action="{{ route('projects.destroy', [$project->id, $task->id]) }}" method="POST" style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td class="border px-4 py-2 text-center" colspan="6">No Tasks</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $tasks->links() }} <!-- Pagination links -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
