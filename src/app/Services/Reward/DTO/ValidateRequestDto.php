<?php

namespace App\Services\Reward\DTO;


use App\Services\Reward\Enums\RewardsEnum;
use Illuminate\Http\Request;

readonly class ValidateRequestDto
{
    public function __construct(public int|string $id, public array $fields)
    {
    }

    public static function make(Request $request): self
    {
        $id = $request->integer('id', 0);
        $fields = $request->get('fields', []);
        return new self(id: $id, fields:$fields );
    }

    public function getErrorMessages(): array
    {
        $message = [];
        $reward = RewardsEnum::tryFrom($this->id);

        if ($this->id <= 0 || is_null($reward) ) {
            $message[] = 'reward not exist';
        } elseif (! $reward->isClassExist()) {
            $message[] = 'reward defined but related object not exist by name: ' . $reward->name;
        }
        if (! count($this->fields)) {
            $message[] = 'fields is empty';
        } else {
            foreach ($this->fields as $field) {
                if (! isset($field['name'])) {
                    $message[] = 'name index is required for all fields';
                }
                if (! isset($field['value'])) {
                    $message[] = 'value index is required for all fields';
                }
            }
        }
        return $message;
    }
}
