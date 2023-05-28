<?php

namespace App\Services\Reward\ValidationRules;

use App\Services\Reward\Enums\RewardsEnum;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class RewardExistRule implements ValidationRule
{

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $reward = RewardsEnum::tryFrom($value);
        if (is_null($reward)) {
            $fail("Reward with :attribute = $value not exist");
        } else if (! $reward->isClassExist()) {
            $fail("Reward with :attribute = $value exist but related Object not defined");
        }
    }
}
