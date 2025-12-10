<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function listUsers()
    {
        $users = DB::table('messages')
            ->join('users', 'messages.from_id', '=', 'users.id')
            ->select(
                'users.id',
                'users.username as name',
                DB::raw('(SELECT message
                    FROM messages m2
                    WHERE m2.from_id = users.id
                    OR m2.to_id = users.id
                    ORDER BY id DESC LIMIT 1
                ) as last_message'),
                DB::raw('(SELECT created_at
                    FROM messages m3
                    WHERE m3.from_id = users.id
                    OR m3.to_id = users.id
                    ORDER BY id DESC LIMIT 1
                ) as last_time')
            )
            ->groupBy('users.id', 'users.username')
            ->orderBy('last_time', 'DESC')
            ->get();

        return response()->json($users);
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

