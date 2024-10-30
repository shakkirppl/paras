<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OfferCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $offers = [
            ['code' => Str::slug('Discount Offer'), 'name' => 'Discount Offer'],
            ['code' => Str::slug('Exchange Offer'), 'name' => 'Exchange Offer'],
            ['code' => Str::slug('Bundle Offer'), 'name' => 'Bundle Offer'],
            ['code' => Str::slug('Buy One Get One'), 'name' => 'Buy One Get One'],
            ['code' => Str::slug('Buy Two Get One'), 'name' => 'Buy Two Get One'],
            ['code' => Str::slug('Buy Three Get One'), 'name' => 'Buy Three Get One'],
            ['code' => Str::slug('Percentage Offer 10'), 'name' => 'Percentage Offer 10%'],
            ['code' => Str::slug('Percentage Offer 20'), 'name' => 'Percentage Offer 20%'],
            ['code' => Str::slug('Percentage Offer 30'), 'name' => 'Percentage Offer 30%'],
            ['code' => Str::slug('Percentage Offer 40'), 'name' => 'Percentage Offer 40%'],
            ['code' => Str::slug('Percentage Offer 50'), 'name' => 'Percentage Offer 50%'],
            ['code' => Str::slug('Percentage Offer 60'), 'name' => 'Percentage Offer 60%'],
            ['code' => Str::slug('Percentage Offer 70'), 'name' => 'Percentage Offer 70%'],
            ['code' => Str::slug('Percentage Offer 80'), 'name' => 'Percentage Offer 70%'],
            ['code' => Str::slug('Percentage Offer 90'), 'name' => 'Percentage Offer 70%'],
            ['code' => Str::slug('Half Price'), 'name' => 'Half Price'],
            ['code' => Str::slug('Cash Back'), 'name' => 'Cash Back'],
            ['code' => Str::slug('Free Shipping'), 'name' => 'Free Shipping'],
            ['code' => Str::slug('Festival Offer'), 'name' => 'Festival Offer'],
            ['code' => Str::slug('Holiday Offer'), 'name' => 'Holiday Offer'],
            ['code' => Str::slug('Weekend Offer'), 'name' => 'Weekend Offer'],
            ['code' => Str::slug('Gift Offer'), 'name' => 'Gift Offer'],
        ];

        DB::table('offer_categories')->insert($offers);
    }
}
