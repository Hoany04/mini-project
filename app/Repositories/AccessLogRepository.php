<?php

namespace App\Repositories;

use App\Models\AccessLog;
use Illuminate\Http\Request;

class AccessLogRepository
{
    protected $accessLog;

    public function __construct(AccessLog $accessLog)
    {
        $this->accessLog = $accessLog;
    }

    public function getListFitter($data)
    {
        return $this->accessLog
            ->with('user')
            ->when($data['user_id'], function ($query) use ($data) {
                $query->where('user_id', $data['user_id'],);
            })
            ->when($data['table_name'], function ($query) use ($data) {
                $query->where('table_name', $data['table_name'],);
            })
            ->when($data['action'], function ($query) use ($data) {
                $query->where('action', $data['action'],);
            })
            ->when($data['from'], function ($query) use ($data) {
                $query->whereDate('created_at', '>=', $data['user_id'],);
            })
            ->when($data['to'], function ($query) use ($data) {
                $query->whereDate('created_at', '<=', $data['to'],);
            })
            ->orderByDesc('created_at')
            ->paginate( 25);
    }
}