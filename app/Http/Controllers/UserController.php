<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(private UserService $service) {}
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
    public function store(CreateUserRequest $request)
    {
        $data = $request->validated();
        return response()->json($this->service->create($data), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json($this->service->findById($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $data = $request->validated();
        return response()->json($this->service->update($id, $request->all()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}
