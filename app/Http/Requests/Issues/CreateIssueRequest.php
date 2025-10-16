<?php

namespace App\Http\Requests\Issues;

use Illuminate\Foundation\Http\FormRequest;

class CreateIssueRequest extends FormRequest
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
            'project_id' => ['required', 'exists:projects,id'],
            'reporter_id' => ['required', 'exists:users,id'],
            'assignee_id' => ['nullable', 'exists:users,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:open,in_progress,closed'],
            'priority' => ['required', 'in:low,medium,high'],
            'due_window.start' => ['required', 'date'],
            'due_window.end' => ['required', 'date', 'after_or_equal:due_window.start'],
            'labels' => ['nullable', 'array'],
            'labels.*' => ['exists:labels,id'],
            'comment' => ['nullable', 'string'],
        ];
    }
}
