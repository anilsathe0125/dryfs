<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show a listing of resources
     *
     * @return \Illuminate\Http\Response
    */
    public function ticket()
    {
        $user = Auth::user();
        return view('user.dashboard.ticket', [
            'tickets' => Ticket::whereUserId($user->id)->get()
        ]);
    }


    /**
     * Show a page to create new ticket
     *
     * @return \Illuminate\Http\Response
    */
    public function ticketNew()
    {
        return view('user.dashboard.ticket-new');
    }

    /**
     * Show a specific ticket
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function ticketView($id)
    {
        $user = Auth::user();
        return view('user.dashboard.ticket-view', [
            'ticket' => Ticket::where(['user_id' => $user->id, 'id' => $id])->firstOrFail()
        ]);
    }

    /**
     * Store a newly created ticket in storage
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
    */
    public function ticketStore(Request $request)
    {
        $request->validate([
            'file'    => 'file|mimes:zip|max:5000',
            'message' => 'required|max:255',
            'subject' => 'required|max:255'
        ]);

        $input = $request->all();
        $input['user_id'] = Auth::user()->id;

        // file upload if submitted by user
        if ($request->hasFile('file')) {
            $file = $request->file;
            $name = microtime() . '-' . $file->getClientOriginalName();
            $file->move(public_path('uploads/tickets', $name));
            $input['file'] = 'uploads/tickets/' . $name;
        }
        Ticket::create($input);
        return redirect()->route('user.ticket')->withSuccess(__('Ticket Created Successfully.'));
    }

    /**
     * Submit ticket reply
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
    */
    public function ticketReply(Request $request)
    {
        $request->validate([
            'message' => 'required|max:255'
        ]);
        $message            = new Message();
        $message->ticket_id = $request->ticket_id;
        $message->user_id   = Auth::user()->id;
        $message->message   = $request->message;
        $message->save();
        return redirect()->back()->withSuccess(__('Reply Sent Successfully.'));
    }

    /**
     * Remove specified ticket from storage
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function ticketDelete($id)
    {
        $ticket = Ticket::where(['id' => $id, 'user_id' => Auth::user()->id])->firstOrFail();
        Message::where('ticket_id', $ticket->id)->delete();
        if ($ticket->file) {
            unlink($ticket->file);
        }
        $ticket->delete();
        return redirect()->back()->withSuccess(__('Ticket Deleted Successfully.'));
    }
}
