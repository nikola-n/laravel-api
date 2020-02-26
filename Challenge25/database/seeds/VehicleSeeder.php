<?php

use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = (new \Faker\Factory())::create();
        $faker->addProvider(new \Faker\Provider\Fakecar($faker));

        for($i =0; $i < 50; $i++){
            \DB::table('vehicles')->insert([
                'brand'=>$faker->vehicleBrand,
                'model'=>$faker->vehicleType,
                'plate_number'=>$faker->vehicleRegistration('[A-Z]{2}-[0-9]{5}'),
                'insurance_date'=>$faker->date,
            ]);
        }
    }
}
