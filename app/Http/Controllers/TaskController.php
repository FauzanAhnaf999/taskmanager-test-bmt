<?php
namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $sortOrder = $request->query('sort', 'latest');
        $tasks = ($sortOrder === 'oldest') ? Task::oldest()->get() : Task::latest()->get();
        return response()->json(['status' => 'success', 'message' => 'Daftar tugas berhasil didapatkan', 'data' => $tasks]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'sometimes|string|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => 'Validasi gagal', 'data' => $validator->errors()], 400);
        }

        $task = Task::create($request->all());
        return response()->json(['status' => 'success', 'message' => 'Tugas berhasil ditambahkan', 'data' => $task], 201);
    }

    public function show(Task $task)
    {
        return response()->json(['status' => 'success', 'message' => 'Detail tugas berhasil diambil', 'data' => $task]);
    }

    public function update(Request $request, Task $task)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|string|nullable',
            'is_completed' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => 'Validasi gagal', 'data' => $validator->errors()], 400);
        }

        $task->update($request->all());
        return response()->json(['status' => 'success', 'message' => 'Tugas berhasil diperbarui', 'data' => $task]);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['status' => 'success', 'message' => 'Tugas berhasil dihapus', 'data' => null]);
    }
}
