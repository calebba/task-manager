<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index( Project $project)
    {
        $tasks = $project->tasks;
        return view('task.tasks', compact('project', 'tasks'));
    }

    public function all_tasks()
    {
        $tasks = Task::paginate(10);
        $projects = Project::all();
        return view('task.index', compact('tasks', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        $users = User::all();
        return view('task.create', compact(['project', 'users']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request, Project $project)
    {
        $project->tasks()->create($request->validated());
        return redirect()->route('projects.tasks.index', $project->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project, Task $task)
    {
        return view('task.show', compact('project', 'task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project, Task $task)
    {
        $users = User::all();
        return view('task.edit', compact('project', 'task', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Project $project, Task $task)
    {
        $task->update($request->validated());
        return redirect()->route('projects.tasks.show', [$project->id, $task->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, Task $task)
    {
        $task->delete();
        return redirect()->route('projects.tasks.index', $project->id);
    }
}