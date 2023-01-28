<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Field;
use App\Models\Inspector;
use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (!User::find(1)) {
            $admin = User::factory()->create([
                'username' => 'admin',
                'rank' => 'Administrator',
                'firstname' => 'Mark Julius',
                'middlename' => 'Relos',
                'lastname' => 'Maravillo',
                'is_admin' => true,
                'password' => bcrypt('!password')
            ]);
        }

        Field::create([
            'name' => 'id_prefix',
            'value' => 'RO5-0104-23'
        ]);

        Field::create([
            'name' => 'io_prefix',
            'value' => 'L2023'
        ]);

        if (!Position::firstWhere('name', 'certificate')?->get()) {
            Position::create([
                'name' => 'certificate',
                'pos' => '{"chief": {"x": "502px", "y": "424px"}, "amount": {"x": "148px", "y": "562px"}, "fsicId": {"x": "183px", "y": "57px"}, "address": {"x": "46px", "y": "293px"}, "marshal": {"x": "520.35px", "y": "466.667px"}, "orNumber": {"x": "135px", "y": "581px"}, "applicant": {"x": "349px", "y": "25px"}, "filledDate": {"x": "715.183px", "y": "127px"}, "validUntil": {"x": "543px", "y": "387px"}, "description": {"x": "355px", "y": "153px"}, "paymentDate": {"x": "128px", "y": "604px"}, "description2": {"x": "74px", "y": "384px"}, "establishment": {"x": "286.7px", "y": "84px"}}'
            ]);
        }

        if (!Position::firstWhere('name', 'inspection')?->get()) {
            Position::create([
                'name' => 'inspection',
                'pos' => '{"ioTo": {"x": "321px", "y": "261px"}, "chief": {"x": "80px", "y": "680px"}, "marshal": {"x": "538px", "y": "680px"}, "proceed": {"x": "319px", "y": "299px"}, "purpose": {"x": "319px", "y": "358px"}, "remarks": {"x": "319px", "y": "421px"}, "duration": {"x": "319px", "y": "387px"}, "ioNumber": {"x": "118px", "y": "160px"}, "processedAt": {"x": "568px", "y": "160px"}}'
            ]);
        }

        Inspector::factory(5)->create();
    }
}
