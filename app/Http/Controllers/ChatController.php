<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Events\ChatEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
    	return view('chat.chat');
    }

    public function fetchAllMessages()
    {
    	return Chat::with('user')->get();
    }

    public function sendMessage(Request $request)
    {
    	$chat = auth()->user()->messages()->create([
            'message' => $request->message
        ]);


    	broadcast(new ChatEvent($chat->load('user')))->toOthers();

    	return ['status' => 'success'];
    }
}
