<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class WhatsAppNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data  = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        return $this->notifWa($this->data['phone'], $this->template($this->data));
    }

    private function template($data)
    {
        $message = '*E-VOTE KONDA2 BALIKPAPAN*\n';
        $message .= '17 - 18 Juni 2021\n';
        $message .= '---------------\n';
        $message .= 'Nama Peserta: '. $data['name'] .'\n';
        $message .= 'Kode PIN: *'. $data['pin'] .'*\n';
        $message .= 'URL Voting: \n'. url('/login-member?pin='. $data['pin']) .'\n';
        $message .= '---------------\n';
        $message .= '_Pesan ini dikirim otomatis melalui sistem konda2bpp.com._\n\n';
        $message .= 'SILAHKAN BALAS *OK* BAGI YANG TIDAK MUNCUL URL.\n\n';
        $message .= '#ID'. time();

        return $message;
    }

    /**
     * NOTIFIKASI WHATSAPP
     *
     * @param string $no WhatsApp Number
     * @param string $message Messages
     * @return boolean
    */
    private function notifWa($no = '', $message)
    {
        $route      = $no === '' ? 'send_message_group_id' : 'send_message';
        $group_id   = 'IBn6E0kjRM17HSvp47oXZe';
        $key        = '2f8d7338340ba379e04246fc3f090d61d3b9ef000554b862';
        $url        = 'http://116.203.92.59/api/'. $route;
        if ($no === '') {
            $data = array("group_id" => $group_id, "key" => $key, "message" => $message);
        } else {
            $data = array("phone_no" => $no, "key" => $key, "message" => $message);
        }

        $content = json_encode($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 360);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($content))
        );

        $res = curl_exec($ch);
        curl_close($ch);

        return true;
    }
}
