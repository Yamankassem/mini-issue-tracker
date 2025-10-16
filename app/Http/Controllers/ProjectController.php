<?php

namespace App\Http\Controllers;

use App\Http\Requests\Projects\CreateProjectRequest;
use App\Http\Requests\Projects\UpdateProjectRequest;
use Illuminate\Http\Request;
use App\Services\ProjectService;

class ProjectController extends Controller
{
    public function __construct(private ProjectService $service) {}
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
    public function store(CreateProjectRequest $request)
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
    public function update(UpdateProjectRequest $request, int $id)
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
