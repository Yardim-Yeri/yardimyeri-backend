<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\HelpData;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \DB::unprepared(file_get_contents('database/seeders/sehirler_mahalleler_sokaklar.sql'));
        // $this->createHelpData();
    }

    protected function createHelpData()
    {
        $faker = Factory::create('tr_TR');

        for ($i = 0; $i < 10_000; $i++) {
            $sehir = DB::table('sehir')->select([
                'sehir_key',
            ])
                ->whereIn('sehir_title', [
                    'KAHRAMANMARAŞ',
                    'GAZİANTEP',
                    'MALATYA',
                    'DİYARBAKIR',
                    'KİLİS',
                    'ŞANLIURFA',
                    'ADIYAMAN',
                    'HATAY',
                    'OSMANİYE',
                    'ADANA'
                ])
                ->first();

            $ilce = DB::table('ilce')->select([
                'ilce_key',
                'ilce_title',
                'ilce_key'
            ])
                ->where('ilce_sehirkey', '=', $sehir->sehir_key)
                ->inRandomOrder()
                ->first();

            $mahalle = DB::table('mahalle')->select([
                'mahalle_key',
                'mahalle_title',
                'mahalle_ilcekey',
            ])
                ->where('mahalle_ilcekey', '=', $ilce->ilce_key)
                ->inRandomOrder()
                ->first();

            $hd = new HelpData([
                'name' => $faker->name(),
                'tel' => $faker->phoneNumber(),
                'ihtiyac_turu' => $faker->randomElement([
                    'Barınma',
                    'insan_gucu',
                    'Gida',
                    'Su',
                    'Ulaşım',
                    'Kıyafet',
                    'Isınma',
                    'Bebek Ürünleri',
                    'Hijyen',
                    'İlaç',
                    'Şarj',
                    'Aydınlatma',
                    'Kutu / Koli',
                    'Evcil Hayvan',
                    'Diğer',
                ]),
                'ihtiyac_turu_detayi' => $faker->paragraph(5),
                'kac_kisilik' => $faker->randomDigitNotZero(),
                'sehir' => $sehir->sehir_key,
                'ilce_id' => $ilce->ilce_key,
                'mahalle_id' => $mahalle->mahalle_key,
                'sokak_id' => null,
                'apartman' => $faker->buildingNumber(),
                'adres_tarifi' => $faker->paragraph(5),
                'lat' => $faker->latitude(),
                'lng' => $faker->longitude(),
                'help_status' => 'Yardım Bekliyor',
            ]);

            $hd->save();
        }
    }
}
