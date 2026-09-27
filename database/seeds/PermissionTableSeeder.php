<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     Maker Checker Mechanism
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
          //Projects Permissions
           'projects.index',
           'project.create',
           'projects.edit',
           'projects.show',

           'reviews.index',
           'programs.index',
           'programs.create',
           //Logframe Permissions
           'logframe.index',
           'logframe.create',
           'logframe.edit',
           'logframe.view',

           'accounts.index',
           'currenty.index',
           'fiscalyear.index',
           'mne.index',
           'security.index',
           'structure.index',
           'staff.index'
        ];


        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
