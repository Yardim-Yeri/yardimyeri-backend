<?php

namespace App\Jobs;

use App\Models\SmsData;
use App\Models\Tweet;
use App\Services\Sms\Netgsm;
use App\Services\StencilService;
use App\Services\TwitterService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Termwind\Components\Dd;

class NewHelpNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // parameters for the job from the controller or other source
    public $help;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($help)
    {
        $this->help = $help;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        // //Stencil Service
        // $image_url = StencilService::generateFeaturedImage(strval($this->help->kac_kisilik), $this->help->sehir, $this->help->ihtiyac_turu)["image_url"];
        // // download the image and save it to the public folder

        // $image = file_get_contents($image_url);
        // Log::info($image_url.'-'.$this->help->id);
        // file_put_contents(public_path('images/'.$this->help->id.'.png'), $image);

        // it will save the image to the public folder with the name of the help id

        // Netgsm Service
        $phone_number = $this->help->tel;
        $formatted_number = preg_replace("/[^0-9]/", "", $phone_number);
        Log::alert($formatted_number .'_'. $this->help->id);

        $message = 'yardimyeri.com\'dan oluşturduğunuz #'. $this->help->id.' numaralı yardım talebiniz başarıyla oluşturulmuştur. Yardım talebiniz birisi tarafından onaylandığında size SMS ile bildirilecektir. Geçmiş olsun.';

        $sms =  new Netgsm();

        try {
            $response = $sms->send($formatted_number, $message);
            SmsData::create([
                'case_id' => $this->help->id,
                'phone' => $formatted_number,
                'message' => $message,
                'status' => 1,
                'data' => json_encode($response),
            ]);
        } catch (\Throwable $th) {
            Log::info($th .'_'. $this->help->id .'_'. $formatted_number);

            SmsData::create([
                'case_id' => $this->help->id,
                'phone' => $formatted_number,
                'message' => $message,
                'status' => 0,
                'data' => json_encode($th),
            ]);
        }

        // Twitter Service
        $hashtags = [
            '#yardimyericom',
            '#yardim',
            '#yardimda_bulunabilirim',
            '#deprem',
        ];

        $users = [
            '@OguzhanUgur',
            '@haluklevent',
        ];

        array_push($hashtags, '#'.$this->help->sehir);
        array_push($hashtags, '#'.$this->help->ihtiyac_turu);

        $tweet = $this->help->sehir .' ilinde '. $this->help->kac_kisilik. ' kişilik '.$this->help->ihtiyac_turu.' yardımına ihtiyaç var. https://yardimyeri.com/yardimda-bulunabilirim/'. $this->help->id.' '. implode(' ', $hashtags).' '. implode(' ', $users);

       try {
            $sendTweet = TwitterService::sendTweet($tweet);
            // it will send the tweet to the twitter account
            Log::info($sendTweet .'_'. $this->help->id .'_'. $tweet .'_'. json_encode($sendTweet));
            Tweet::create([
                'tweet_id' => $sendTweet['data']['id'],
                'case_id' => $this->help->id,
                'tweet_text' => $tweet,
                'status' => 1,
                'data' =>  json_encode($sendTweet),
            ]);
        } catch (\Throwable $th) {
            Log::info($th .'_'. $this->help->id .'_'. $tweet .'_'. json_encode($th));
            Tweet::create([
                'tweet_id' => 0,
                'case_id' => $this->help->id,
                'tweet_text' => $tweet,
                'status' => 2,
                'data' =>  json_encode($th),
            ]);
        }
    }

}
