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
    protected $description = 'Gui mail den admin cac order chua xu ly trong ngay';

    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $orders = Order::with('user')
            ->where('status', 'pending')
            ->whereDate('created_at', '<=', now()->toDateString()) //don cu hon hoac trong ngay
            ->get();

            if ($orders->isEmpty()) {
                $this->info('Khong co don hang nao chua xu ly.');
                return;
            }

            $adminEmail = config('mail.admin_address', 'admin@example.com');

            Mail::to($adminEmail)->send(new PendingOrdersMail($orders));

            $this->info('Da gui mail bao cao don hang chua xu ly cho admin.');
    }
}
