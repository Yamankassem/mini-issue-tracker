<?php

namespace App\Services;


use App\Models\User;
use App\Models\Issue;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\IssueRepositoryInterface;


class IssueService
{
    protected IssueRepositoryInterface $issues;

    public function __construct(protected IssueRepositoryInterface $Issues)
    {
        $this->issues = $Issues;
    }

    public function listAll()
    {
        return $this->Issues->all();
    }

    public function findById(int $id)
    {
        return $this->Issues->find($id);
    }

    public function create(array $data)
    {
        return $this->Issues->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->Issues->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->Issues->delete($id);
    }

    /**
     * إنشاء Issue مع Labels و Comment داخل Transaction.
     *
     * @param array $data validated data for Issue
     * @param array $labelIds
     * @param string|null $initialComment
     * @return Issue
     */
    public function createIssueWithExtras(array $data, array $labelIds = [], ?string $initialComment = null): Issue
    {
        return DB::transaction(function () use ($data, $labelIds, $initialComment) {
            $issue = $this->issues->create($data);

            if (!empty($labelIds)) {
                $this->issues->attachLabels($issue, $labelIds);
            }

            if ($initialComment) {
                $this->issues->addComment($issue, (int) $data['reporter_id'], $initialComment);
            }

            return $this->issues->find($issue->id); // return loaded relations
        });
    }

    /**
     * أمثلة استعلامات للتقارير
     */

    public function listProjectIssuesWithCommentCounts(int $projectId)
    {
        return $this->issues->listForProjectWithCounts($projectId, ['labels', 'assignee', 'reporter']);
    }

    public function listOpenUrgentForProject(int $projectId)
    {
        return $this->issues->openUrgentForProject($projectId);
    }

    public function openIssuesForProject(int $projectId)
    {
        return Issue::with(['reporter', 'assignee', 'labels', 'comments'])
            ->where('project_id', $projectId)
            ->open()
            ->get();
    }

    public function closedIssuesStatisticsPerUser()
    {
        return User::withCount([
            'assignedIssues as closed_assigned_count' => fn($q) => $q->where('status', 'closed'),
            'reportedIssues as closed_reported_count' => fn($q) => $q->where('status', 'closed'),
        ])->get(['id', 'name']);
    }
}
