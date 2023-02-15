<?php

namespace App\Console\Commands;

use App\Models\HelpData;
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
        
        HelpData::where('created_at', '<=', $fiveDaysAgo)->where('help_status', 'Yardım Bekliyor')->where('approved', 0)->delete();

        $this->info('Delete successful');

        // TODO
        // $encrypter = new EncrpytDecrypt();
        // $sms =  new Netgsm();

        // foreach ($records as $item) {
        //     TODO
        //     $encrypter->encrypt($item->id);
        //     $phone_number = $item->tel;
        //     $formatted_number = preg_replace("/[^0-9]/", "", $phone_number);
        //     $sms->send($formatted_number, 'yardimyeri.com\'dan oluşturduğunuz #'. $item->id.' numaralı yardım talebiniz başarıyla oluşturulmuştur. Yardım talebiniz onaylandığında size SMS ile bildirilecektir. Geçmiş olsun.');

        //     $item->delete();
        // }

        return Command::SUCCESS;
    }
}
