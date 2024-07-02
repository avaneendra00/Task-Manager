<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks;
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $task = new Task();
        $task->nama = $request->nama;
        $task->deskripsi = $request->deskripsi;
        $task->status = 'pending';
        $task->user_id = auth()->id();

        if ($request->hasFile('image')){
            $imagePath = $request->file('image')->store('images/tasks', 'public');
            $task->image = $imagePath;
        }

        $task->save();
        
        return redirect()->route('home')->with('success', 'Task create successfully.');
    }

    public function complete(Task $task)
    {
        if ($task->user_id !== auth()->id()){
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $task->status = 'completed';
        $task->save();

        return response()->json(['success' => 'Task marked as completed.']);
    }

    public function destroy(Task $task)
    {
        if ($task->user_id !== auth()->id()){
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        $task->delete();

        return response()->json(['success' => 'Task deleted successfully.']);
    }
    
}
