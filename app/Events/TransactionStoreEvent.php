<?php

namespace App\Events;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TransactionStoreEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Transaction $transaction;
    public User $user;
    public int $status;

    public function __construct($transaction, $user, $status)
    {
        $this->transaction = $transaction;
        $this->user = $user;
        $this->status = $status;
    }
}
