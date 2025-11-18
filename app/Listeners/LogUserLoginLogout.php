<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Failed;
use App\Models\AccessLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogUserLoginLogout
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
    public function handle(object $event): void
    {
        if ($event instanceof Login) {
            AccessLog::create([
                'user_id' => $event->user->id,
                'action' => 'login',
                'table_name' => 'users',
                'record_id' => $event->user->id,
                'old_data' => null,
                'new_data' => json_encode(['message' => 'User logged in']),
            ]);
        }

        if ($event instanceof Logout && $event->user) {
            AccessLog::create([
                'user_id' => $event->user->id ?? null,
                'action' => 'logout',
                'table_name' => 'users',
                'record_id' => $event->user->id ?? null,
                'old_data' => json_encode(['message' => 'User logged out']),
                'new_data' => null,
            ]);
        }

        if ($event instanceof Failed) {
            AccessLog::create([
                'user_id'    => null,
                'action'     => 'login_failed',
                'table_name' => 'users',
                'record_id'  => 0,
                'old_data'   => null,
                'new_data'   => json_encode(['email' => $event->credentials['email'] ?? 'unknown']),
            ]);
        }
    }
}
