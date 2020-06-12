<?php

namespace App\Http\Controllers;

use App\Subscriber;
use Illuminate\Http\Request;
use App\Notifications\EmailSubscribed;
use Illuminate\Support\Facades\Notification;

class SubscriberController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->email == ''){
            flash('Please input your email', 'danger');
            return back();
        }

        $exist = Subscriber::where('email', $request->email)->first();
        if($exist){
            flash('You are already subscribed to our newsletter', 'danger');
            return back();
        }

        $subscriber = Subscriber::create([
            'email' => $request->email
        ]);
        
        $subscriber->notify(new EmailSubscribed());

        flash('You\'ve been subscribed to our newsletter successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subscriber = Subscriber::findOrFail($id);
        $subscriber->delete();

        flash('Subscriber was removed from mailing list successfully!');
        return back();
    }

    public function restore($id)
    {
        // return $id;
        $subscribers = Subscriber::onlyTrashed();
        $subscriber = $subscribers->findOrFail($id);

        if($subscriber->deleted_at != NULL){
            $subscriber->restore();
        }

        flash('Subscriber was restored back to mailin list successfully!');

        return back();
        
    }
}
