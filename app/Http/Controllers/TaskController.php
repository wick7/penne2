<?php
namespace App\Http\Controllers;
use App\Task;
use Illuminate\Http\Request;
class TaskController extends Controller
{
    public function index()
    {
        return Task::latest()->get();
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'party' => 'required|max:500'
        ]);
        return Task::create([
        'party' => request('party'),
        'size' => request('size'),
        'phone' => request('phone')
      ]);
    }
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return 204;
    }
}
