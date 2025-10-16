<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comments\CreateCommentRequest;
use App\Http\Requests\Comments\UpdateCommentRequest;
use Illuminate\Http\Request;
use App\Services\CommentService;

class CommentController extends Controller
{
    public function __construct(private CommentService $service) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json($this->service->listAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCommentRequest $request)
    {
        $data = $request->validated();
        return response()->json($this->service->create($data), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return response()->json($this->service->findById($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, int $id)
    {
        $data = $request->validated();
        return response()->json($this->service->update($id, $request->all()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}
