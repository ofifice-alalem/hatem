<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RankCategory;
use App\Models\Rank;
use App\Models\EmploymentStatus;
use App\Models\LeaveType;

class BasicDataSeeder extends Seeder
{
    public function run(): void
    {
        // فئات الرتب
        $categories = [
            ['category_name' => 'ضابط'],
            ['category_name' => 'ضابط صف'],
            ['category_name' => 'موظف']
        ];

        foreach ($categories as $category) {
            RankCategory::create($category);
        }

        // الرتب
        $ranks = [
            // رتب الضباط
            ['category_id' => 1, 'rank_name' => 'ملازم'],
            ['category_id' => 1, 'rank_name' => 'ملازم أول'],
            ['category_id' => 1, 'rank_name' => 'نقيب'],
            ['category_id' => 1, 'rank_name' => 'رائد'],
            ['category_id' => 1, 'rank_name' => 'مقدم'],
            ['category_id' => 1, 'rank_name' => 'عقيد'],
            ['category_id' => 1, 'rank_name' => 'عميد'],
            
            // رتب ضباط الصف
            ['category_id' => 2, 'rank_name' => 'عريف'],
            ['category_id' => 2, 'rank_name' => 'عريف أول'],
            ['category_id' => 2, 'rank_name' => 'رقيب'],
            ['category_id' => 2, 'rank_name' => 'رقيب أول'],
            ['category_id' => 2, 'rank_name' => 'مساعد'],
            ['category_id' => 2, 'rank_name' => 'مساعد أول'],
            
            // الموظفين
            ['category_id' => 3, 'rank_name' => 'موظف']
        ];

        foreach ($ranks as $rank) {
            Rank::create($rank);
        }

        // حالات التوظيف
        $statuses = [
            ['status_name' => 'على رأس العمل'],
            ['status_name' => 'إجازة'],
            ['status_name' => 'مكلف'],
            ['status_name' => 'منتدب'],
            ['status_name' => 'متقاعد']
        ];

        foreach ($statuses as $status) {
            EmploymentStatus::create($status);
        }

        // أنواع الإجازات
        $leaveTypes = [
            ['type_name' => 'إجازة سنوية'],
            ['type_name' => 'إجازة مرضية'],
            ['type_name' => 'إجازة بدون راتب'],
            ['type_name' => 'إجازة طارئة'],
            ['type_name' => 'إجازة أمومة']
        ];

        foreach ($leaveTypes as $type) {
            LeaveType::create($type);
        }
    }
}