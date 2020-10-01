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

    public function messageByUser($id){
        $messages = Message::where(function($q) use ($id) {
            $q->where('from',Auth::id());
            $q->where('to', $id);
        })->orWhere(function($q) use($id) {
            $q->where('from',$id);
            $q->where('to', Auth::id());
        })->with('user')->get();

        return $messages;
    }

    public function getMessages(Request $request, $id)
    {
        //Get the selected user to chat with
        $user = User::findOrFail($id);
        $messages = $this->messageByUser($id);

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
        if ($request->ajax()) {
            $messages = Message::create([
                'message' => $request->message,
                'from' => Auth::id(),
                'to' => $request->user_id,
            ]);
            return response()->json($messages);
        }else{
            abort(404);
        }
    }

    public function deleteMessage( Request $request, $id) {
        
        if($request->ajax()){
            Message::findOrFail($id)->delete();
            return response()->json('Deleted');
        }else {
            abort(404);
        }
      
    }


    public function deleteAllMessage($id) 
    {
        
       $messages =  $this->messageByUser($id);
       foreach($messages as $msg){
           Message::findOrFail($msg->id)->delete();
       }
       return response()->json('all messages deleted');
      
    }

   

}