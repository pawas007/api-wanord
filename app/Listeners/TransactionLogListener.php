<?php

namespace App\Listeners;

use App\Events\TransactionStoreEvent;
use Illuminate\Support\Facades\DB;
use JetBrains\PhpStorm\NoReturn;

class TransactionLogListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    #[NoReturn] public function handle(TransactionStoreEvent $event): void
    {
        $details = match ($event->status) {
            400 => 'Insufficient balance ' . $event->user->name . ' ' . $event->transaction->action . ' ' . $event->transaction->value,
            201 => $event->user->name . ' ' . $event->transaction->action . ' ' . $event->transaction->value,
            default => null,
        };

        DB::table('transactions_log')->insert([
            'user_id' => $event->user->id,
            'action' => $event->transaction->action,
            'value' => $event->transaction->value,
            'status' => $event->status,
            'details' => $details,
            'created_at' => now()
        ]);
    }
}
