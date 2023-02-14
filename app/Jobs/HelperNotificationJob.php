<?php

namespace App\Jobs;

use App\Services\Sms\Netgsm;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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
    }
}
