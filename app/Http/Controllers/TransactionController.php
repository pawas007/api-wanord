<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionStoreOrUpdateRequest;
use App\Models\Transaction;
use App\Models\User;
use App\Services\Transaction\TransactionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class TransactionController extends Controller
{
    private TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->authorizeResource(Transaction::class, 'transaction', [
            'except' => ['index', 'show'],
        ]);
        $this->transactionService = $transactionService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $transactions = Cache::remember('transactions', 60 * 5, function () {
            return Transaction::query()->with('user')->get();
        });
        return response()->json($transactions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionStoreOrUpdateRequest $request, User $user): JsonResponse
    {
        return $this->transactionService->makeTransaction($user, $request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction): JsonResponse
    {
        return response()->json($transaction->load('user'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Transaction $transaction): JsonResponse
    {
        $user->transactions()->findOrFail($transaction->id)->delete();
        return response()->json(['message' => 'deleted']);
    }
}
