<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateNewsRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        // dd($this->route('encrypted_id'));
        $decryptedId = decrypt($this->route('encrypted_id'));
        // dd($decryptedId);
        return [
            'title' => [
                'required',
                'string',
                'unique:news,title' . ($decryptedId ? ",$decryptedId" : ''),
            ],
        ];

    }
}
