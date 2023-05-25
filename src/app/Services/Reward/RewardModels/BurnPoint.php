<?php

namespace App\Services\Reward\RewardModels;

use App\Services\Reward\RewardModels\Fields\FieldObject;
use App\Services\Reward\RewardModels\Fields\Types\PercentType;
use App\Services\Reward\RewardModels\Fields\Types\TextType;

class BurnPoint extends BaseReward
{
    private int $id = 3;

    private string $title = 'سوزاندن امتیاز';

    public function getFields(): array
    {
        return [
            new FieldObject(
                type: new TextType(),
                valueType: new PercentType(),
                name: 'percent',
                label: 'درصد'
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
