<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TasksRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'description' => 'required',
            'due_date' => 'required|date',
            'status' => 'in:pending,in_progress,completed'
        ];
    }

    public function messages(){
        return [
            'title.required' => 'Task title is required.',
            'description.required' => 'Task description is required.',
            'due_date.required' => 'Due date for this Task is required.',
            'due_date.date' => 'Due date for this Task is in incorrect format.',
            'status.in' => 'Status should either be pending, in_progress or completed.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));

    }
}
