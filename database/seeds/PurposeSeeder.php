<?php

use Illuminate\Database\Seeder;
use App\Purpose;

class PurposeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Purpose::create(['name' => 'Болеуталяющее']);
        Purpose::create(['name' => 'Снатворное']);
        Purpose::create(['name' => 'Антибиотик']);
        Purpose::create(['name' => 'Пробиотик']);
        Purpose::create(['name' => 'Противогрибковые']);
        Purpose::create(['name' => 'Антисептик']);
    }
}
