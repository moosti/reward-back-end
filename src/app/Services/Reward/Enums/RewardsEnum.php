<?php

namespace App\Services\Reward\Enums;

use App\Services\Reward\RewardModels\BaseReward;

enum RewardsEnum: int
{
    case Gift = 1;
    case IncreasePoint = 2;
    case BurnPoint = 3;
    case IncreaseWallet = 4;
    case RandomIncreaseWallet = 5;
    case IncreaseCredit = 6;
    case RandomIncreaseCredit = 7;
    case Medal = 8;

    public function getObject(): ?BaseReward
    {
        $name = $this->resolveClass();
        return $this->isClassExist($name) ? new $name : null;
    }

    public function isClassExist(): bool
    {
        return class_exists($this->resolveClass());
    }

    private function resolveClass(): string
    {
        return str_replace(
            '\\Enums',
            "\\RewardModels\\{$this->name}",
            __NAMESPACE__
        );
    }
}
