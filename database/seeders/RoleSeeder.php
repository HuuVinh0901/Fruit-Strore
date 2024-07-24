<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::truncate(); //nếu có dữ liệu trong bảng thì xóa;
        Role::create(['role_name'=>'admin']);
        Role::create(['role_name'=>'Nhân viên bán hàng']);
        Role::create(['role_name'=>'Nhân viên kho']);
        Role::create(['role_name'=>'Nhân viên giao hàng']);
    }
}
