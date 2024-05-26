<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class LaratrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $domain = strtolower(str_replace(' ', '', env('APP_NAME')));
        $this->command->info('Truncating User, Role and Permission tables');
        //$this->truncateLaratrustTables();

        $config = config('laratrust_seeder.role_structure');
        $userPermission = config('laratrust_seeder.permission_structure');
        $mapPermission = collect(config('laratrust_seeder.permissions_map'));

        foreach ($config as $key => $modules) {

            // Create a new role
            $role = \App\Models\Role::firstOrCreate([
                'name' => $key,
                'display_name' => ucwords(str_replace('_', ' ', $key)),
                'description' => ucwords(str_replace('_', ' ', $key)),
            ]);
            $permissions = [];

            $this->command->info('Creating Role '.strtoupper($key));

            // Reading role permission modules
            foreach ($modules as $module => $value) {
                foreach (explode(',', $value) as $p => $perm) {
                    $permissionValue = $mapPermission->get($perm);

                    $permissions[] = \App\Models\Permission::firstOrCreate([
                        'name' => 'admin.'.$permissionValue.'-'.$module,
                        'display_name' => ucfirst($permissionValue).' '.ucfirst($module),
                        'description' => ucfirst($permissionValue).' '.ucfirst($module),
                    ])->id;

                    $this->command->info('Creating Permission to '.$permissionValue.' for '.$module);
                }
            }

            // Attach all permissions to the role
            $role->permissions()->sync($permissions);

            $this->command->info("Creating '{$key}' user");

            // Create default user for each role
            if ($key == 'user') {
                $user = \App\Models\User::where('email', $key.'@'.$domain.'.com')->first();
                if (empty($user)) {
                    $user = \App\Models\User::create([
                        'first_name' => ucwords(str_replace('_', ' ', $key)),
                        'email' => $key.'@'.$domain.'.com',
                        'password' => bcrypt('password'),
                    ]);
                }
            } else {
                $user = \App\Models\Admin::where('email', $key.'@'.$domain.'.com')->first();
                if (empty($user)) {
                    $user = \App\Models\Admin::create([
                        'first_name' => ucwords(str_replace('_', ' ', $key)),
                        'email' => $key.'@'.$domain.'.com',
                        'password' => bcrypt('password'),
                    ]);
                }
            }

            $user->roles()->sync([$role->id]);
            $user->permissions()->sync($permissions);
            $user->role_id = $role->id;
            $user->save();
        }

        // Creating user with permissions
        if (! empty($userPermission)) {
            foreach ($userPermission as $key => $modules) {
                foreach ($modules as $module => $value) {

                    // Create default user for each permission set
                    if ($key == 'user') {
                        $user = \App\Models\User::where('email', $key.'@'.$domain.'.com')->first();
                        if (empty($user)) {
                            $user = \App\Models\User::create([
                                'first_name' => ucwords(str_replace('_', ' ', $key)),
                                'email' => $key.'@'.$domain.'.com',
                                'password' => bcrypt('password'),
                                'remember_token' => Str::random(10),
                            ]);
                        }
                    } else {
                        $user = \App\Models\Admin::where('email', $key.'@'.$domain.'.com')->first();
                        if (empty($user)) {
                            $user = \App\Models\Admin::create([
                                'first_name' => ucwords(str_replace('_', ' ', $key)),
                                'email' => $key.'@'.$domain.'.com',
                                'password' => bcrypt('password'),
                                'remember_token' => Str::random(10),
                            ]);
                        }
                    }
                    $permissions = [];

                    foreach (explode(',', $value) as $p => $perm) {
                        $permissionValue = $mapPermission->get($perm);

                        $permissions[] = \App\Models\Permission::firstOrCreate([
                            'name' => 'admin.'.$permissionValue.'-'.$module,
                            'display_name' => ucfirst($permissionValue).' '.ucfirst($module),
                            'description' => ucfirst($permissionValue).' '.ucfirst($module),
                        ])->id;

                        $this->command->info('Creating Permission to '.$permissionValue.' for '.$module);
                    }
                }

                // Attach all permissions to the user
                $user->permissions()->sync($permissions);
            }
        }
    }

    /**
     * Truncates all the laratrust tables and the users table
     *
     * @return    void
     */
    public function truncateLaratrustTables()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('permission_role')->truncate();
        \App\Models\Role::truncate();
        \App\Models\Permission::truncate();
        Schema::enableForeignKeyConstraints();
    }
}
