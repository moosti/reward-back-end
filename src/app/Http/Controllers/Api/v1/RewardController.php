<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\Reward\DTO\ValidateRequestDto;
use App\Services\Reward\Enums\RewardsEnum;
use App\Services\Reward\RewardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    public function __construct(private readonly RewardService $service)
    {
    }

    public function getAllRewards(): JsonResponse
    {
        return response()->json($this->service->getAllRewards());
    }

    public function getRewardById(int|string $id): JsonResponse
    {
        $reward = RewardsEnum::tryFrom((int)$id);

        if (is_null($reward) || ! $rewardObject = $reward->getObject()) {
            return response()->json([
                'status' => 'error',
                'message' => 'not exist'
            ], 404);
        }

        return response()->json($this->service->getRewardFields($rewardObject));
    }

    public function validateRewardFields(Request $request): JsonResponse
    {
        $dto = ValidateRequestDto::make($request);

        if( $messages = $dto->getErrorMessages()) {
            return response()->json($messages, 404);
        }

        $reward = RewardsEnum::from($dto->id)->getObject();
        $result = $this->service->rewardValidateFields($reward, $dto->fields);

        if ($result) {
            return response()->json([
                'status' => 'error',
                'messages' => $result
            ], 400);
        }

        return response()->json([
            'status' => 'ok',
            'message' => 'all clear'
        ]);
    }
}
