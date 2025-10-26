<?php

namespace Database\Seeders;

use App\Models\Type;
use App\Models\Rank;
use App\Models\Person;
use App\Models\MilitaryInfo;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    public function run(): void
    {
        $types = Type::all();
        $arabicNames = [
            'أحمد محمد علي', 'محمد أحمد حسن', 'علي محمد أحمد', 'حسن علي محمد',
            'عبدالله أحمد علي', 'مصطفى محمد حسن', 'يوسف علي أحمد', 'عمر محمد علي',
            'خالد أحمد محمد', 'طارق علي حسن', 'سامي محمد أحمد', 'وليد عبدالله علي',
            'فاروق محمد حسن', 'عادل أحمد علي', 'نادر علي محمد', 'هشام محمد أحمد',
            'رامي عبدالله حسن', 'ماجد علي محمد', 'باسم أحمد علي', 'عاصم محمد حسن'
        ];

        for ($i = 1; $i <= 1000; $i++) {
            $type = $types->random();
            $ranks = Rank::where('type_id', $type->id)->get();
            $rank = $ranks->random();
            
            $person = Person::create([
                'file_no' => 'F' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'national_no' => '1' . str_pad(rand(100000000, 999999999), 9, '0', STR_PAD_LEFT),
                'name' => $arabicNames[array_rand($arabicNames)],
                'type_id' => $type->id,
                'rank_id' => $rank->id
            ]);

            if ($type->type_name === 'ضابط صف') {
                MilitaryInfo::create([
                    'national_no' => $person->national_no,
                    'military_no' => 'M' . str_pad($i, 6, '0', STR_PAD_LEFT)
                ]);
            }
        }
    }
}
