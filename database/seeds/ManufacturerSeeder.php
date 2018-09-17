<?php

use Illuminate\Database\Seeder;
use App\Manufacturer;

class ManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Manufacturer::create(['name' => 'Alfa pharm']);
        Manufacturer::create(['name' => 'Natali pharm']);
        Manufacturer::create(['name' => 'Pharmacy']);
        Manufacturer::create(['name' => 'Asteria']);
        Manufacturer::create(['name' => 'Tonus-Les']);
    }
}
