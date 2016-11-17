<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaratrustSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return  void
     */
    public function run()
    {
        $this->truncateLaratrustTables();

        $config = config('laratrust_seeder.role_structure');
        $mapPermission = collect(config('laratrust_seeder.permissions_map'));

        foreach ($config as $key => $modules)
        {
            // Create a new role
            $role = \App\Models\Role::create([
                'name'         => $key,
                'display_name' => studly_case($key),
                'description'  => studly_case($key),
            ]);

            $this->command->info('Creating Role ' . strtoupper($key));

            // Reading role permission modules
            foreach ($modules as $module => $value)
            {
                $permissions = explode(',', $value);

                foreach ($permissions as $p => $perm)
                {
                    $permissionValue = $mapPermission->get($perm);

                    $permission = \App\Models\Permission::firstOrCreate([
                        'name'         => $module . '-' . $permissionValue,
                        'display_name' => studly_case($permissionValue) . ' ' . ucfirst($module),
                        'description'  => studly_case($permissionValue) . ' ' . ucfirst($module),
                    ]);

                    $this->command->info('Creating Permission to ' . $permissionValue . ' for ' . $module);

                    if ( ! $role->hasPermission($permission->name))
                    {
                        $role->attachPermission($permission);
                    } else
                    {
                        $this->command->info($key . ': ' . $p . ' ' . $permissionValue . ' already exist');
                    }
                }
            }

            // Create default user for each role
            $user = \App\Models\Admin::create([
                'name'           => 'Nijat Asadov',
                'role_id'        => $role->id,
                'email'          => $key . '@gmail.com',
                'password'       => 'secret',
                'remember_token' => str_random(10),
            ]);
            $user->attachRole($role);
        }
    }

    /**
     * Truncates all the laratrust tables and the users table
     * @return    void
     */
    public function truncateLaratrustTables()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('permission_role')->truncate();
        DB::table('admin_role')->truncate();
        \App\Models\Admin::truncate();
        \App\Models\Role::truncate();
        \App\Models\Permission::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
