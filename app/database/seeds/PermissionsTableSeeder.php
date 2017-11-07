<?php

class PermissionsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('permissions')->delete();

        $permissions = array(
            array( // 1
                'name'         => 'manage_testimonials',
                'display_name' => 'manage testimonials'
            ),
            array( // 2
                'name'         => 'manage_users',
                'display_name' => 'manage users'
            )
        );

        DB::table('permissions')->insert( $permissions );

        DB::table('permission_role')->delete();

        $role_id_admin = Role::where('name', '=', 'admin')->first()->id;

        $permission_base = (int)DB::table('permissions')->first()->id - 1;

        $permissions = array(
            array(
                'role_id'       => $role_id_admin,
                'permission_id' => $permission_base + 1
            ),
            array(
                'role_id'       => $role_id_admin,
                'permission_id' => $permission_base + 2
            ),
        );

        DB::table('permission_role')->insert( $permissions );
    }

}