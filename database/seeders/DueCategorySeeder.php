<?php

namespace Database\Seeders;

use App\Models\DueCategory;
use Illuminate\Database\Seeder;

class DueCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
            [
                'name_en' => 'Monthly Rent',
                'name_ar' => 'الإيجار الشهري',
            ],
            [
                'name_en' => 'Electric Bill',
                'name_ar' => 'فاتورة الكهرباء',
            ],
            [
                'name_en' => 'Water Bill',
                'name_ar' => 'فاتورة الماء',
            ],
            [
                'name_en' => 'Maintenance',
                'name_ar' => 'الإصلاحات',
            ],
            [
                'name_en' => 'Other',
                'name_ar' => 'أخرى',
            ],
        ];

        $latest_due_category = DueCategory::withoutGlobalScope('ordered')->orderBy('order', 'DESC')->first();
        $next_order = $latest_due_category ? $latest_due_category->order + 1 : 1;

        foreach ($list as $category) {
            DueCategory::create([
                'name' => [
                    'en' => $category['name_en'],
                    'ar' => $category['name_ar'],
                ],
                'order' => $next_order,
            ]);
        }
    }
}