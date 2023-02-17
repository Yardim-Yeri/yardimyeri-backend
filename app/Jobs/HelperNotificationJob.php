<?php

namespace App\Jobs;

use App\Models\Tweet;
use App\Services\Sms\Netgsm;
use App\Services\TwitterService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class HelperNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $helper_data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($helper_data)
    {
        $this->helper_data = $helper_data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $phone = $this->helper_data->tel;
        $formatted_number = preg_replace("/[^0-9]/", "", $phone);
        $email = $this->helper_data->email;
        $helpId = $this->helper_data->help_data_id;

        $base64 = base64_encode($helpId . '?' . $phone);

        $url = 'https://www.yardimyeri.com/yardim?id=' . $base64;

        $sms = new Netgsm();
        $sms->send($formatted_number, 'yardimyeri.com\'dan oluşturduğunuz yardım için teşekkür ederiz. Yardımı tamamlandığınızda aşağıdaki linke tıklayarak yardımı tamamladığınızı bildirebilirsiniz. ' . $url . ' Geçmiş olsun.');

        $tweet = Tweet::where('help_data_id', $helpId)->first();

        try {
            TwitterService::deleteTweet($tweet->tweet_id);

            $tweet->update([
                'status' => 0
            ]);
            Log::info('Tweet deleted'.$tweet->tweet_id.' for help id: '.$helpId);
        } catch (\Throwable $th) {
            Log::error('Tweet delete error: '.$th->getMessage().' for help id: '.$helpId);
        }



    }
}
