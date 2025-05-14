<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TourStoreRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'question' => 'required|string|max:255',
            'tour_date' => 'required|date|after:today',
            'tour_time' => 'required|date_format:H:i',
            'cover_image' => 'required|file|mimes:png,jpg,jpeg|max:2048',
            'video_link' => 'required|string',
            'live_event_link' => 'required|string',
            'questions' => 'required|json'
        ];
    }
}
