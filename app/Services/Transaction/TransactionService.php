<?php

namespace App\Services\Transaction;

use App\Enums\TransactionAction;
use App\Events\TransactionStoreEvent;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;


class TransactionService implements TransactionServiceInterface
{
    /**
     * @param $user
     * @param $request
     * @return JsonResponse
     */
    public function makeTransaction($user, $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $action = $request->action;
            $value = intval($request->value);
            $transaction = $user->transactions()->create($request->validated());

            switch ($action) {
                case TransactionAction::SELL->value:
                    $user->balance += $value;
                    break;

                case TransactionAction::BUY->value:
                    if ($user->balance < $value) {
                        event(new TransactionStoreEvent($transaction, $user, 400));
                        return response()->json(['message' => 'Insufficient balance'], 400);
                    }
                    $user->balance -= $value;
                    break;
            }

            $user->save();
            DB::commit();
            event(new TransactionStoreEvent($transaction, $user, 201));
            return response()->json(['message' => 'created'], 201);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['message' => $exception->getMessage()], 500);
        }
    }
}
