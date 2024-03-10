<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Log;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $search['paginate'] = 10;
            return (new Project())->getProjects($search);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        try {
            $requestData = $request->all();
            $data = $this->prepareData($requestData);
            (new Project())->createProject($data);
            return response()->json(['success' => 'Project created successfully'], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            return response()->json((new Project())->findProjectById($id), 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            (new Project())->deleteProject($id);
            return response()->json(['success' => 'Project deleted successfully'], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }

    private function prepareData($request)
    {
        $data['title'] = $request['title'];
        $data['code'] = $request['code'];
        $data['description'] = $request['description'];
        $data['type'] = $request['type'];
        $data['client_id'] = $request['client_id'] ?? null;
        $data['total_rate'] = $request['total_rate'] ?? null;
        $data['lead_by'] = $request['lead_by'];
        $data['start_date'] = $request['start_date'] ?? null;
        $data['end_date'] = $request['end_date'] ?? null;
        $data['created_by'] = auth()->id();
        $data['status'] = $request['status'];

        return $data;
    }
}
