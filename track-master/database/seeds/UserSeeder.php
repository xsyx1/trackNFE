<?php


use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $person = Person::create([
            'name' => 'TrackCash',
            'email' => 'track@cash.com',
            'nickname' => 'cash',
            'nif' => '04496906000108',
            'phone' => '6332155400',
            'address' => 'Quadra 606 Sul, Al. Oscar Niemeyer, QI - 02, HM - 06, Lt. 02',
            'zip_code' => '77016524',
            'city_id' => '443'
        ]);

        $user = User::create([
            'person_id' => $person->id,
            'email' => 'track@cash.com',
            'password' => bcrypt('1234567o')
        ]);


        $this->command->info('User ' . $user->name . ' created');
    }
}
