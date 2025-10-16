<?php

namespace App\Http\Requests\Issues;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIssueRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'project_id' => ['sometimes', 'exists:projects,id'],
            'reporter_id' => ['sometimes', 'exists:users,id'],
            'assignee_id' => ['nullable', 'exists:users,id'],
            'title' => ['sometimes', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['sometimes', 'in:open,in_progress,closed'],
            'priority' => ['sometimes', 'in:low,medium,high'],
            'due_window.start' => ['sometimes', 'date'],
            'due_window.end' => ['sometimes', 'date', 'after_or_equal:due_window.start'],
            'labels' => ['nullable', 'array'],
            'labels.*' => ['exists:labels,id'],
            'comment' => ['nullable', 'string'],
        ];
    }
}
