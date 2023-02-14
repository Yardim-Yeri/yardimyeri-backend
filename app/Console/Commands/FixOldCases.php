<?php

namespace App\Console\Commands;

use App\Enums\HelpStatusEnum;
use App\Models\HelperData;
use App\Services\Sms\Netgsm;
use Carbon\Carbon;
use Illuminate\Console\Command;

class FixOldCases extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:old-cases';

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
        $helper_datas = HelperData::get();

        foreach ($helper_datas as $helper_data) {
            $help = $helper_data->help;
            if ($help->help_status != HelpStatusEnum::PROCESS->value) {
                $this->info('Geçildi');
                continue;
            }

            $id = $help->id;
            $person_name = $help->name ?? 'İsimsiz';

            $base64 = base64_encode($id . '?' . $helper_data->tel . '?' . Carbon::now()->timestamp);
            $url = 'https://www.yardimyeri.com/yardim?id=' . $base64;
            $formatted_number = preg_replace("/[^0-9]/", "", $helper_data->tel);

            $sms = new Netgsm();
            $sms->send($formatted_number, 'yardimyeri.com\'dan ' . $person_name . ' adına sahip yardım talebine karşılık verdiğiniz için teşekkür ederiz. Yardımı tamamlandığınızda aşağıdaki linke tıklayarak yardımı tamamladığınızı bildirebilirsiniz. ' . $url . ' Geçmiş olsun.');

            $this->info('Mesaj ulaştırıldı yardım eden id --> ' . $helper_data->id);
        }

        return Command::SUCCESS;
    }
}
