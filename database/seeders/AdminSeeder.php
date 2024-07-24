<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::truncate();

        $adminRole = Role::where('role_name','admin')->first();
        $nvbhRole = Role::where('role_name','Nhân viên bán hàng')->first();
        $nvkRole = Role::where('role_name','Nhân viên kho')->first();
        $nvghRole = Role::where('role_name','Nhân viên giao hàng')->first();

        $admin = Admin::create([
            'admin_name' => 'thu',
            'admin_email' => 'thu@gmail.com',
            'admin_phone' => '0795993732',
            'admin_password' => md5('12345678'),
        ]);

        $nvbh = Admin::create([
            'admin_name' => 'trinh',
            'admin_email' => 'trinh@gmail.com',
            'admin_phone' => '0907159929',
            'admin_password' => md5('12345678'),
        ]);

        $nvk = Admin::create([
            'admin_name' => 'thuy',
            'admin_email' => 'thuy@gmail.com',
            'admin_phone' => '0909893676',
            'admin_password' => md5('12345678'),
        ]);

        $nvgh = Admin::create([
            'admin_name' => 'nghiem',
            'admin_email' => 'nghiem@gmail.com',
            'admin_phone' => '0914548001',
            'admin_password' => md5('12345678'),
        ]);

        $admin->role()->attach($adminRole);
        $nvbh->role()->attach($nvbhRole);
        $nvk->role()->attach($nvkRole);
        $nvgh->role()->attach($nvghRole);
    }
}
