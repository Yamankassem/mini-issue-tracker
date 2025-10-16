<?php

namespace App\Repositories\Interfaces;

use App\Models\Issue;
use App\Repositories\Interfaces\BaseRepositoryInterface;


interface IssueRepositoryInterface extends BaseRepositoryInterface
{

    public function attachLabels(Issue $issue, array $labelIds): void;

    public function addComment(Issue $issue, int $userId, string $content);

    /**
     * الحصول على مشكلات مشروع مع تعداد التعليقات
     *
     * @param int $projectId
     * @param array $with relations to eager load
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function listForProjectWithCounts(int $projectId, array $with = []);

    /**
     * استعلام للمشكلات المفتوحة وذات أولوية عالية داخل مشروع معين
     * يعيد Builder أو Collection حسب التنفيذ
     */
    public function openUrgentForProject(int $projectId);
    
}
