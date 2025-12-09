<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use App\Events\MessageSent;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function send(Request $request)
    {
        $msg = Message::create([
            'from_id' => auth()->id(),
            'to_id'   => $request->to_id,
            'message' => $request->message,
        ]);

        broadcast(new MessageSent($msg))->toOthers();

        return response()->json([
            'message' => $msg
        ]);
    }

    public function index($userId)
    {
        $userInfo = User::with('profile')->findOrFail($userId);

        $messages = Message::where(function ($q) use ($userId) {
                $q->where('from_id', auth()->id())
                  ->orWhere('to_id', auth()->id());
            })
            ->where(function ($q) use ($userId) {
                $q->where('from_id', $userId)
                  ->orWhere('to_id', $userId);
            })
            ->orderBy('id','ASC')
            ->get();

        return view('admin.chat.index', compact('messages', 'userId', 'userInfo'));
    }

    public function sendAdmin(Request $request)
    {
        $msg = Message::create([
            'from_id' => auth()->id(),
            'to_id' => $request->user_id,
            'message' => $request->message,
            'is_read' => 0,
        ])->load('sender');

        \Log::info('NEW MESSAGE: ', $msg->toArray());

        broadcast(new MessageSent($msg))->toOthers();

        return response()->json(['success' => true]);
    }

    public function userList()
    {
        // Lấy tất cả user (trừ admin)
        $users = User::where('role_id', 3)->get();

        return view('admin.chat.user-list', compact('users'));
    }

    public function history()
    {
        $userId = auth()->id();

        return Message::with('sender')
            ->where(function ($q) use ($userId) {
                $q->where('from_id', $userId)
                ->orWhere('to_id', $userId);
            })
            ->orderBy('id')
            ->get();
    }
}

