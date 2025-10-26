<?php

namespace Database\Seeders;

use App\Models\Type;
use App\Models\Rank;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // إنشاء الأنواع
        $officer = Type::create(['type_name' => 'ضابط']);
        $nco = Type::create(['type_name' => 'ضابط صف']);
        $employee = Type::create(['type_name' => 'موظف']);

        // إنشاء الرتب للضباط
        Rank::create(['rank_name' => 'ملازم', 'type_id' => $officer->id]);
        Rank::create(['rank_name' => 'ملازم أول', 'type_id' => $officer->id]);
        Rank::create(['rank_name' => 'نقيب', 'type_id' => $officer->id]);
        Rank::create(['rank_name' => 'رائد', 'type_id' => $officer->id]);
        Rank::create(['rank_name' => 'مقدم', 'type_id' => $officer->id]);

        // إنشاء الرتب لضباط الصف
        Rank::create(['rank_name' => 'عريف', 'type_id' => $nco->id]);
        Rank::create(['rank_name' => 'عريف أول', 'type_id' => $nco->id]);
        Rank::create(['rank_name' => 'رقيب', 'type_id' => $nco->id]);
        Rank::create(['rank_name' => 'رقيب أول', 'type_id' => $nco->id]);
        Rank::create(['rank_name' => 'مساعد', 'type_id' => $nco->id]);

        // إنشاء الرتب للموظفين
        Rank::create(['rank_name' => 'موظف درجة أولى', 'type_id' => $employee->id]);
        Rank::create(['rank_name' => 'موظف درجة ثانية', 'type_id' => $employee->id]);
        Rank::create(['rank_name' => 'موظف درجة ثالثة', 'type_id' => $employee->id]);
    }
}
