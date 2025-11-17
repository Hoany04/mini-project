<?php

namespace App\Schedules;

use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\SendPendingOrdersEmail;

class SendPendingOrdersSchedule
{
    public function __invoke(Schedule $schedule)
    {
        // Lên lịch chạy command mỗi ngày lúc 8h sáng
        // php artisan email:pending-orders
        // php artisan schedule:run
        $schedule->command(SendPendingOrdersEmail::class)->everyMinute(); //everyMinute()->withoutOverlapping()
    }
}
