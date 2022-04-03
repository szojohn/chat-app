<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $messages = Message::get();

        return response()->json($messages);
    }

    public function store(Request $request)
    {
        if(!$request->ajax()) {
            return abort(404);
        }

        $message = new Message;
        $message->id = $request->id;
        $message->body = $request->body;
        $message->self_message = true;
        $message->name = $request->name;

        $message->save();

        return response()->json(["result" => "ok"], 200);
    }
}
