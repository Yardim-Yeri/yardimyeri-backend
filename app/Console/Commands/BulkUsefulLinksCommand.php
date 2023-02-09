<?php

namespace App\Console\Commands;

use App\Models\UsefulLink;
use Illuminate\Console\Command;
use Termwind\Components\Dd;

class BulkUsefulLinksCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bulk:useful-links';

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
//         - afetharita.com
// Sosyal medyada paylaşılmış ihbarları harita üzerinde gösterir

// - afetbilgi.com
// Barınma ve toplanma alanları, bağış yardım noktaları, önemli telefonlar gibi hayati bilgilerini derlenmiştir.

// - beniyiyim.com
// Deprem bölgesindeki insanların durumlarını diğer insanlara bildirme sitesi

// - depremyardim.com
// Yardıma ihtiyacı olan depremzedelerin adreslerinin ayrıntılı bir şekilde girilen site

// - yakinimibul.net
// Ailesinden haber alamayan karın kontrol edilebileceği listelerin oluşturduğu site

// -deprem.io
// Enkaz altında kalan kişilerin bilgilerinin girildiği ve bu bilgilerin dernek ve kurumlarla paylaşıldığı site

// - stream.epctex.com
// Enkaz altında kalanların bildirildiği tweetleri tek yerden takibini sağlayan site

// - deprem.basarsoft.com.tr
// Tüm yardım taleplerini gösteren ve talep girebileceğiniz site

// - depremihtiyac.com
// Deprem bölgesindeki yardımları tek bir platformda toplayan site

// - yikilanbinalar.com.tr
// Yıkılan binaların adres bilgilerinin ve durumlarının girildiği site

// - enkazbildirim.org
// Türkiye'nin güncel enkaz haritasını gösteren site


        $data = [
            [
                "title" => "Afet Harita",
                "url" => "afetharita.com",
                "description" => "Sosyal medyada paylaşılmış ihbarları harita üzerinde gösterir"
            ],
            [
                "title" => "Afet Bilgi",
                "url" => "afetbilgi.com",
                "description" => "Barınma ve toplanma alanları, bağış yardım noktaları, önemli telefonlar gibi hayati bilgilerini derlenmiştir."
            ],
            [
                "title" => "Ben İyiyim",
                "url" => "beniyiyim.com",
                "description" => "Deprem bölgesindeki insanların durumlarını diğer insanlara bildirme sitesi"
            ],
            [
                "title" => "Deprem Yardım",
                "url" => "depremyardim.com",
                "description" => "Yardıma ihtiyacı olan depremzedelerin adreslerinin ayrıntılı bir şekilde girilen site"
            ],
            [
                "title" => "Yakınımı Bul",
                "url" => "yakinimibul.net",
                "description" => "Ailesinden haber alamayan karın kontrol edilebileceği listelerin oluşturduğu site"
            ],
            [
                "title" => "Deprem.io",
                "url" => "deprem.io",
                "description" => "Enkaz altında kalan kişilerin bilgilerinin girildiği ve bu bilgilerin dernek ve kurumlarla paylaşıldığı site"
            ],
            [
                "title" => "Stream",
                "url" => "stream.epctex.com",
                "description" => "Enkaz altında kalanların bildirildiği tweetleri tek yerden takibini sağlayan site"
            ],
            [
                "title" => "Deprem",
                "url" => "deprem.basarsoft.com.tr",
                "description" => "Tüm yardım taleplerini gösteren ve talep girebileceğiniz site"
            ],
            [
                "title" => "Deprem İhtiyaç",
                "url" => "depremihtiyac.com",
                "description" => "Deprem bölgesindeki yardımları tek bir platformda toplayan site"
            ],
            [
                "title" => "Yıkılan Binalar",
                "url" => "yikilanbinalar.com.tr",
                "description" => "Yıkılan binaların adres bilgilerinin ve durumlarının girildiği site"
            ],
            [
                "title" => "Enkaz Bildirim",
                "url" => "enkazbildirim.org",
                "description" => "Türkiye'nin güncel enkaz haritasını gösteren site"
            ],
            [
                "title" => "Afad Acil Çağrı",
                "url" => "https://play.google.com/store/apps/details?id=tr.gov.icisleri.afad",
                "description" => "T.C. İçişleri Bakanlığı Afet ve Acil Durum Yönetimi Başkanlığı Acil Çağrı mobil uygulaması. Toplanma alanlarını görüntüleyebilir ve afet durumunda acil çağrı başlatabilirsiniz."
            ]
            ];

        foreach ($data as $item) {
            UsefulLink::create($item);
        }
        dd('done');

    }
}
