<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Skpd;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Administrator',
        //     'email' => 'admin@test.com',
        // ]);

        // $totalUsers = 181;
        // $satkers = Skpd::all();
        // $satkerCount = $satkers->count();
        //     $replacePrefix = function ($text) {
        //         return preg_replace_callback(
        //             '/^(PUSKESMAS|DINAS|BADAN|KELURAHAN|KECAMATAN|BAGIAN)\s+/i',
        //             function ($matches) {
        //                 return match (strtoupper($matches[1])) {
        //                     'PUSKESMAS' => 'puskes ',
        //                     'KELURAHAN' => 'kel ',
        //                     'KECAMATAN' => 'kec ',
        //                     'BAGIAN' => 'bag ',
        //                     default => '',
        //                 };
        //             },
        //             $text
        //         );
        //     };

        //     foreach ($satkers as $satker) {
        //         $nama = $replacePrefix($satker->name_satker);
        //         $shortName = $replacePrefix($satker->short_name_satker ?? $satker->name_satker);
        //           User::updateOrCreate(
        //             [
        //                 'satkers_id' => $satker->kd_satker,
        //             ],
        //             [
        //                 'name' => $nama,
        //                 'username' => Str::of($shortName)->slug('_')->lower(),
        //                 'email' =>  Str::of($satker->short_name_satker ?? $nama)->slug('_') . '@gmail.com',
        //                 'satkers_id' => $satker->kd_satker,
        //                 'password' => bcrypt('password'),
        //                 'kd_satker_str' => $satker->kd_satker_str,
        //                 'kd_satker_lokal' => null,
        //             ]
        //         )->each(function ($user) {
        //             $user->assignRole('opd');
        //         });

        //     }

        $this->call([
            DataSeeders::class
        ]);
    }
}
