<?php

namespace App\Http\Controllers;


use App\Services\IssueService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Issues\CreateIssueRequest;
use App\Http\Requests\Issues\UpdateIssueRequest;


class IssueController extends Controller
{
    public function __construct(protected IssueService $service) {}
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
    public function store(CreateIssueRequest $request): JsonResponse
    {
        $validated = $request->validated();

        // labels من المصفوفة أو []
        $labels = $request->input('labels', []);
        $comment = $request->input('comment');

        $issue = $this->service->createIssueWithExtras($validated, $labels, $comment);

        return response()->json([
            'message' => 'Issue created successfully.',
            'data' => $issue,
        ], 201);
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
    public function update(UpdateIssueRequest $request, int $id)
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

    // مثال على endpoint لإظهار تقارير المشروع
    public function projectReport(int $projectId): JsonResponse
    {
        $list = $this->service->listProjectIssuesWithCommentCounts($projectId);

        return response()->json([
            'project_id' => $projectId,
            'issues' => $list,
        ]);
    }

    public function projectOpenUrgent(int $projectId): JsonResponse
    {
        $list = $this->service->listOpenUrgentForProject($projectId);
        return response()->json([
            'project_id' => $projectId,
            'issues' => $list,
        ]);
    }

    public function projectOpenIssues(int $projectId)
    {
        $issues = $this->service->openIssuesForProject($projectId);

        return response()->json([
            'project_id' => $projectId,
            'issues' => $issues,
        ]);
    }

    public function closedStatsPerUser(): JsonResponse
    {
        $stats = $this->service->closedIssuesStatisticsPerUser();

        return response()->json([
            'message' => 'Closed issues per user statistics.',
            'data' => $stats,
        ]);
    }
}
