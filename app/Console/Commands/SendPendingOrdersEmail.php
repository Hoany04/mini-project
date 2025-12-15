<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Mail\PendingOrdersMail;
use Illuminate\Support\Facades\Mail;

class SendPendingOrdersEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:pending-orders';
    protected $description = 'Send an email to the admin with any unprocessed orders for the day.';

    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    // sd cron job
    public function handle()
    {
        $orders = Order::with('user')
            ->where('status', 'pending')
            ->whereDate('created_at', '<=', now()->toDateString()) //don cu hon hoac trong ngay
            ->get();

            if ($orders->isEmpty()) {
                $this->info('No orders are pending.');
                return;
            }

            $adminEmail = config('mail.admin_address', 'admin@example.com');

            Mail::to($adminEmail)->send(new PendingOrdersMail($orders));

            $this->info('I have sent an email reporting the unprocessed order to the admin.');
    }
}
