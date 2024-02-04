<?php

namespace App\Http\Requests;

use App\Enums\TransactionAction;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TransactionStoreOrUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'action' => ['required', 'string', 'in:'.TransactionAction::getAllActionAsString()],
            'value' => ['required', 'integer', 'min:1'],
        ];
    }
}
