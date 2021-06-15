<?php

namespace App\Http\Controllers\Backend;

use App\Domains\Auth\Models\User;
use App\Domains\Auth\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\WhatsAppNotification;

class NotificationController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * UserController constructor.
     *
     * @param  UserService  $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = User::membersOnly()->get(['id', 'name', 'pin', 'wa']);

        return view('backend.notifications.index', compact('members'));
    }

    /**
     * @param  Request  $request
     * @param  User  $user
     *
     * @return mixed
     */
    public function edit(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);

        return view('backend.notifications.edit')->withUser($user);
    }

    /**
     * @param  Request  $request
     * @param  User  $user
     *
     * @return mixed
     * @throws \Throwable
     */
    public function update(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);

        $this->userService->update($user, $request->all());

        return redirect()
            ->route('admin.notification.index')
            ->withFlashSuccess(__('Berhasil mengubah data peserta.'));
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

        $this->sendWhatsAppNotification($member);

        $message = 'Berhasil mengirim ulang informasi login ke nomor'. $member->wa;

        return back()->withFlashSuccess($message);
    }

    /**
     * Send notification to all user members.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendAll()
    {
        $members = User::membersOnly()->get(['id', 'name', 'pin', 'wa']);
        foreach ($members as $member) {
            $this->sendWhatsAppNotification($member);
        }

        $message = 'Berhasil mengirim seluruh informasi login peserta';

        return back()->withFlashSuccess($message);
    }

    private function sendWhatsAppNotification($member)
    {
        if ($member->wa !== null && $member->wa !== '') {
            $data = $this->dataTemplate($member);

            WhatsAppNotification::dispatch($data)->onQueue('notif_wa');
        }
    }

    private function dataTemplate($member)
    {
        return [
            'phone' => $member->wa,
            'name' => $member->name,
            'pin' => $member->pin,
        ];
    }

}
