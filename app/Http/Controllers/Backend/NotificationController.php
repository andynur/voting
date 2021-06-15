<?php

namespace App\Http\Controllers\Backend;

use App\Domains\Auth\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = User::membersOnly()->get();

        return view('backend.notifications.index', compact('members'));
    }

    /**
     * Send notification to selected user member.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function send($user_id)
    {
        $member = User::findOrFail($user_id);
        dd($member);
    }

    /**
     * Send notification to all user members.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendAll()
    {
        $members = User::membersOnly()->get();

        dd($members);

    }

}
