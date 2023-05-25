<?php

namespace App\Services\Reward\RewardModels;

use App\Services\Reward\RewardModels\Fields\FieldObject;
use App\Services\Reward\RewardModels\Fields\Types\ListType;
use App\Services\Reward\RewardModels\Fields\Types\NumericType;

class Gift extends BaseReward
{
    private int $id = 1;

    private string $title = 'هدیه';

    public function getFields(): array
    {
        return [
            new FieldObject(
                type: new ListType([1 => 'gift1', 2 => 'gift2']),
                valueType: new NumericType(),
                name: 'id',
                label: 'شناسه'
            ),
        ];
    }

    public function getInfo(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title
        ];
    }
}
