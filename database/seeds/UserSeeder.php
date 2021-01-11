<?php

use App\Employee;
use App\User;
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
        $user = new User();
        $user->login = 'admin';
        $user->email = 'admin@admin';
        $user->Notifications = '1';
        $user->password = bcrypt("123");
        $user->Type_User = 1;
        $user->save();

        $employee = new Employee();
        $employee->Name = 'User';
        $employee->Surname = 'Users';
        $employee->Set_Permission = 1;
        $employee->Man_brought = 1;
        $employee->Fired = 1;
        $employee->users_id = $user->id;
        $employee->save();

    }
}
