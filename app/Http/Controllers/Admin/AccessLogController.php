<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccessLog;
use Illuminate\Http\Request;
use App\Services\AccessLogService;

class AccessLogController extends Controller
{
    protected AccessLogService $accessLogService;
    public function __construct(AccessLogService $accessLogService){
        $this->accessLogService = $accessLogService;
    }
    public function index(Request $request)
    {
        $logs  = $this->accessLogService->getListFitter($request->all());

        return view('admin.access-logs.index', compact('logs'));
    }
}
