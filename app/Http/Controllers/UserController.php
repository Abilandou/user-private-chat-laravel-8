<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $users = \App\Models\User::latest()->where('id', '!=', Auth::id())->get();
        if($request->ajax())
        {
            return response()->json($users, 200);
        }
        abort(404);
        
    }

    public function getMessages(Request $request, $id)
    {
        
        //Get the selected user to chat with
        $user = User::findOrFail($id);
        
        $messages = Message::where(function($q) use ($id) {
            $q->where('from',Auth::id());
            $q->where('to', $id);
        })->orWhere(function($q) use($id) {
            $q->where('from',$id);
            $q->where('to', Auth::id());
        })->with('user')->get();

        if($request->ajax())
        {
            return response()->json([
                'messages' => $messages,
                'user' => $user
            ]);
        }
        return abort(404);
        
    }

    public function sendMessage(Request $request)
    {
        // $message = new Message();
        // $message->message = $request->message;
        // $message->from = Auth::id();
        // $message->to = $request->user_id;
        // $message->save();

        $messages = Message::create([
            'message' => $request->message,
            'from' => Auth::id(),
            'to' => $request->user_id,
        ]);
        // if($message){
            return response()->json($messages);
        // }else {
        //     return response()->json('error');
        // }
    }

}