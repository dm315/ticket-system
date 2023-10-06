<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['title' => 'show-user', 'persian_name' => 'مشاهده کاربران', 'description' => 'میتواند لیست کاربران را تماشا کند.'],
            ['title' => 'delete-user', 'persian_name' => 'حذف کاربران', 'description' => 'میتواند کاربران را حذف کند'],
            ['title' => 'update-user', 'persian_name' => 'ویرایش کاربران', 'description' => 'میتواند کاربران را ویرایش کند'],
            ['title' => 'create-user', 'persian_name' => 'ایجاد کاربران', 'description' => 'میتواند یک کاربر جدید اضافه کند.'],
            ['title' => 'show-tasks', 'persian_name' => 'مشاهده تسک ها', 'description' => 'میتواند تسک ها را تماشا کند.'],
            ['title' => 'delete-tasks', 'persian_name' => 'حذف تسک ها', 'description' => 'میتواند تسک ها را حذف کند.'],
            ['title' => 'update-tasks', 'persian_name' => 'ویرایش تسک ها', 'description' => 'میتواند تسک ها را ویرایش کند.'],
            ['title' => 'create-tasks', 'persian_name' => 'ایجاد تسک ها', 'description' => 'میتواند تسک جدید ایجاد کند.'],
            ['title' => 'show-groups', 'persian_name' => 'مشاهده گروه ها', 'description' => 'میتواند لیست گروه ها را تماشا کند'],
            ['title' => 'delete-groups', 'persian_name' => 'حذف گروه ها', 'description' => 'میتواند گروه ها را حذف کند'],
            ['title' => 'update-groups', 'persian_name' => 'ویرایش گروه ها', 'description' => 'میتواند گروه ها را ویرایش کند'],
            ['title' => 'create-groups', 'persian_name' => 'ایجاد گروه ها', 'description' => 'میتواند گروه جدید ایجاد کند'],
            ['title' => 'create-groups', 'persian_name' => 'ایجاد گروه ها', 'description' => 'میتواند گروه جدید ایجاد کند'],
        ];


    }
}
