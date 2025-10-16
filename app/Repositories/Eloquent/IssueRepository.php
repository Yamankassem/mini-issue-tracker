<?php

namespace App\Repositories\Eloquent;


use App\Models\Issue;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\IssueRepositoryInterface;


class IssueRepository extends BaseRepository implements IssueRepositoryInterface
{
        public function __construct(Issue $model)
    {
        parent::__construct($model);
    }
    
    public function attachLabels(Issue $issue, array $labelIds): void
    {
        $issue->labels()->sync($labelIds);
    }

    public function addComment(Issue $issue, int $userId, string $content)
    {
        return $issue->comments()->create([
            'user_id' => $userId,
            'content' => $content,
        ]);
    }

    public function listForProjectWithCounts(int $projectId, array $with = [])
    {
        return Issue::where('project_id', $projectId)
            ->with($with)
            ->withCount('comments')
            ->get();
    }

    public function openUrgentForProject(int $projectId)
    {
        return Issue::where('project_id', $projectId)
            ->open()      // local scopeOpen
            ->urgent()    // local scopeUrgent
            ->withCount('comments')
            ->get();
    }

}
