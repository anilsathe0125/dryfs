<?php

namespace App\Repositories\Backend;

use App\Models\User;
use App\Helpers\ImageHelper;
use App\Models\Message;
use App\Models\Ticket;

class TicketRepository{

    /**
     * Store Ticket
     *
     * @param \App\Http\Requests\ImageUpdateRequest $request
     * @return void
    */
    public function store($request)
    {
        $input = $request->all();
        $input['user_id'] = User::where('email', $request->email)->first()->id;
        if ($file = $request->file('file')) {
            $input['file'] = ImageHelper::handleUploadedImage($file, 'uploads/tickets');
        }
        Ticket::create($input);
    }

    /**
     * Update Ticket
     *
     * @param \App\Models\Ticket $ticket
     * @param \Illuminate\Http\Request $request
     * @return void
    */
    public function update($ticket, $request)
    {
        $ticket->update(['status' => 'Open']);
        $message            = new Message();
        $message->ticket_id = $request['ticket_id'];
        $message->user_id   = 0;
        $message->message   = $request['message'];
        $message->save();
    }

    /**
     * Delete Ticket
     *
     * @param \App\Models\Ticket $ticket
     * @return void
    */
    public function delete($ticket)
    {
        $id = $ticket->id;
        if (Ticket::whereId($id)->exists()) {
            $ticket = Ticket::findOrFail($id);
            $messages = $ticket->messages;

            if ($messages->count() > 0) {
                foreach ($messages as $message) {
                    $message->delete();
                }
            }

            if ($ticket->file) {
                ImageHelper::handleDeletedImage($ticket, 'file');
            }
            $ticket->delete();
        }
    }
}
