<?php

namespace App\Services\Transaction;

use Illuminate\Http\JsonResponse;

interface TransactionServiceInterface
{
    /**
     * @param $user
     * @param $request
     * @return JsonResponse
     */
    public function makeTransaction($user, $request): JsonResponse;
}
