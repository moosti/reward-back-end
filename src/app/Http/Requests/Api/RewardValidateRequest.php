<?php

namespace App\Http\Requests\Api;

use App\Services\Reward\Enums\RewardsEnum;
use App\Services\Reward\ValidationRules\RewardExistRule;
use App\Services\Reward\ValidationRules\RewardFieldNameRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RewardValidateRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', new RewardExistRule],
            'fields' => 'required|array',
            'fields.*.name' => ['required', 'string', new RewardFieldNameRule],
            'fields.*.value' => 'required'
        ];
    }
}
