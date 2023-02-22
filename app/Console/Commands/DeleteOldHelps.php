<?php

namespace App\Console\Commands;

use App\Models\HelpData;
use App\Models\SmsData;
use App\Services\EncrpytDecrypt;
use App\Services\Sms\Netgsm;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteOldHelps extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:old-helps';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $fiveDaysAgo = Carbon::now()->subDays(5);

        $records = HelpData::where('created_at', '<=', $fiveDaysAgo)->where('help_status', 'Yardım Bekliyor')->where('approved', 0)->get();

        $this->info('Delete successful');



        $encrypter = new EncrpytDecrypt();
        $sms =  new Netgsm();

        foreach ($records as $item) {
            $item->delete();
            $encyrptedId = $encrypter->encrypt($item->id);
            $phone_number = $item->tel;
            $formatted_number = preg_replace("/[^0-9]/", "", $phone_number);
            $base64 = base64_encode($encyrptedId);
            $messageArray = [
                'yardimyeri.com\'dan oluşturduğunuz #'. $item->id.' numaralı yardım talebiniz',
                ' 5 gün boyunca yanıtsız kaldığı için pasif hale getirilmiştir.',
                ' Yardım talebinizi tekrar aktifleştirmek için tıklayın',
                'https://api.yardimyeri.com/reactive/'.$base64
            ];
            $message = implode(' ', $messageArray);
            try {
                $response = $sms->send($formatted_number, $message);
                dump($item->name);
                SmsData::create([
                    'case_id' => $item->id,
                    'phone' => $formatted_number,
                    'message' => $message,
                    'status' => 1,
                    'data' => json_encode($response)

                ]);
            } catch (\Exception $e) {
                $this->info($e->getMessage());

                SmsData::create([
                    'case_id' => $item->id,
                    'phone' => $formatted_number,
                    'message' => $message,
                    'status' => 0,
                    'data' => $e->getMessage()
                ]);
            }
        }

        return Command::SUCCESS;
    }
}
