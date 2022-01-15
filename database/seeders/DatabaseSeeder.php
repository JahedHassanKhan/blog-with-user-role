<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\RoleRoute;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         \App\Models\User::factory()->create();
        foreach ($this->users() as $u){
            $user = new User();
//            $user->id = $u['id'];
            $user->type = $u['type'];
            $user->name = $u['name'];
            $user->email = $u['email'];
            $user->password = $u['password'];
            $user->remember_token = $u['remember_token'];
            $user->save();
        }

        foreach ($this->roles() as $u){
            $role = new Role();
            $role->name         =   $u['name'];
            $role->slug         =   Str::slug($u['name']);
            $role->description  =   $u['description'];
            $role->save();
        }
        foreach ($this->roleRoutes() as $u){
            $roleRoute = new RoleRoute();
            $roleRoute->role_id         =   $u['role_id'];
            $roleRoute->role_name         =   $u['role_name'];
            $roleRoute->route_name         =   $u['route_name'];
            $roleRoute->key         =   $u['key'];
            $roleRoute->controller         =   $u['controller'];
            $roleRoute->method         =   $u['method'];
            $roleRoute->save();
        }

    }

    private function users(){
        $users = array(
            array('id' => '0','type' => '1','name' => 'Admin','email' => 'admin@admin.com','email_verified_at' => '2022-01-14 19:45:23','password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','two_factor_secret' => NULL,'two_factor_recovery_codes' => NULL,'status' => '1','remember_token' => 'IugkRcbAzy','created_at' => '2022-01-14 19:45:23','updated_at' => '2022-01-14 19:51:28'),
            array('id' => '1','type' => '0','name' => 'User','email' => 'user@user.com','email_verified_at' => '2022-01-14 19:45:23','password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','two_factor_secret' => NULL,'two_factor_recovery_codes' => NULL,'remember_token' => 'IugkRcbAzy','created_at' => '2022-01-14 19:45:23','updated_at' => '2022-01-14 19:51:28'),
            array('id' => '2','type' => '0','name' => 'Jahed','email' => 'jahed@gmail.com','email_verified_at' => '2022-01-14 19:45:23','password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','two_factor_secret' => NULL,'two_factor_recovery_codes' => NULL,'remember_token' => 'IugkRcbAzy','created_at' => '2022-01-14 19:45:23','updated_at' => '2022-01-14 19:51:28'),
            array('id' => '3','type' => '0','name' => 'Tarun','email' => 'tarun@gmail.com','email_verified_at' => '2022-01-14 19:45:23','password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','two_factor_secret' => NULL,'two_factor_recovery_codes' => NULL,'remember_token' => 'IugkRcbAzy','created_at' => '2022-01-14 19:45:23','updated_at' => '2022-01-14 19:51:28'),
        );
        return $users;
    }

    private function roles(){
        $roles = array(
            array('id' => '1','name' => 'All','slug' => 'all','description' => NULL,'status' => '1','created_by' => '1','updated_by' => NULL,'created_at' => '2022-01-14 20:08:47','updated_at' => '2022-01-14 20:08:47'),
            array('id' => '2','name' => 'Role','slug' => 'role','description' => NULL,'status' => '1','created_by' => '1','updated_by' => NULL,'created_at' => '2022-01-14 20:09:08','updated_at' => '2022-01-14 20:09:08'),
            array('id' => '3','name' => 'User','slug' => 'user','description' => NULL,'status' => '1','created_by' => '1','updated_by' => NULL,'created_at' => '2022-01-14 20:09:22','updated_at' => '2022-01-14 20:09:22')
        );
        return $roles;
    }
    private function roleRoutes(){
        $role_routes = array(
            array('id' => '1','role_id' => '1','role_name' => 'All','route_name' => 'role.index','key' => NULL,'controller' => 'App\\Http\\Controllers\\RoleController','method' => 'index','created_at' => '2022-01-14 20:08:47','updated_at' => '2022-01-14 20:08:47'),
            array('id' => '2','role_id' => '1','role_name' => 'All','route_name' => 'role.create','key' => NULL,'controller' => 'App\\Http\\Controllers\\RoleController','method' => 'create','created_at' => '2022-01-14 20:08:47','updated_at' => '2022-01-14 20:08:47'),
            array('id' => '3','role_id' => '1','role_name' => 'All','route_name' => 'role.store','key' => NULL,'controller' => 'App\\Http\\Controllers\\RoleController','method' => 'store','created_at' => '2022-01-14 20:08:47','updated_at' => '2022-01-14 20:08:47'),
            array('id' => '4','role_id' => '1','role_name' => 'All','route_name' => 'role.show','key' => NULL,'controller' => 'App\\Http\\Controllers\\RoleController','method' => 'show','created_at' => '2022-01-14 20:08:47','updated_at' => '2022-01-14 20:08:47'),
            array('id' => '5','role_id' => '1','role_name' => 'All','route_name' => 'role.edit','key' => NULL,'controller' => 'App\\Http\\Controllers\\RoleController','method' => 'edit','created_at' => '2022-01-14 20:08:47','updated_at' => '2022-01-14 20:08:47'),
            array('id' => '6','role_id' => '1','role_name' => 'All','route_name' => 'role.update','key' => NULL,'controller' => 'App\\Http\\Controllers\\RoleController','method' => 'update','created_at' => '2022-01-14 20:08:47','updated_at' => '2022-01-14 20:08:47'),
            array('id' => '7','role_id' => '1','role_name' => 'All','route_name' => 'role.destroy','key' => NULL,'controller' => 'App\\Http\\Controllers\\RoleController','method' => 'destroy','created_at' => '2022-01-14 20:08:47','updated_at' => '2022-01-14 20:08:47'),
            array('id' => '8','role_id' => '1','role_name' => 'All','route_name' => 'role.status','key' => NULL,'controller' => 'App\\Http\\Controllers\\RoleController','method' => 'status','created_at' => '2022-01-14 20:08:47','updated_at' => '2022-01-14 20:08:47'),
            array('id' => '9','role_id' => '1','role_name' => 'All','route_name' => 'user-list','key' => NULL,'controller' => 'App\\Http\\Controllers\\UserPermissionController','method' => 'getUserList','created_at' => '2022-01-14 20:08:47','updated_at' => '2022-01-14 20:08:47'),
            array('id' => '10','role_id' => '1','role_name' => 'All','route_name' => 'banned-user-list','key' => NULL,'controller' => 'App\\Http\\Controllers\\UserPermissionController','method' => 'getBannedUserList','created_at' => '2022-01-14 20:08:47','updated_at' => '2022-01-14 20:08:47'),
            array('id' => '11','role_id' => '1','role_name' => 'All','route_name' => 'edit-user','key' => NULL,'controller' => 'App\\Http\\Controllers\\UserPermissionController','method' => 'editUser','created_at' => '2022-01-14 20:08:47','updated_at' => '2022-01-14 20:08:47'),
            array('id' => '12','role_id' => '1','role_name' => 'All','route_name' => 'update-user','key' => NULL,'controller' => 'App\\Http\\Controllers\\UserPermissionController','method' => 'updateUser','created_at' => '2022-01-14 20:08:47','updated_at' => '2022-01-14 20:08:47'),
            array('id' => '13','role_id' => '1','role_name' => 'All','route_name' => 'user.status','key' => NULL,'controller' => 'App\\Http\\Controllers\\UserPermissionController','method' => 'status','created_at' => '2022-01-14 20:08:47','updated_at' => '2022-01-14 20:08:47'),
            array('id' => '14','role_id' => '2','role_name' => 'Role','route_name' => 'role.index','key' => NULL,'controller' => 'App\\Http\\Controllers\\RoleController','method' => 'index','created_at' => '2022-01-14 20:09:08','updated_at' => '2022-01-14 20:09:08'),
            array('id' => '15','role_id' => '2','role_name' => 'Role','route_name' => 'role.create','key' => NULL,'controller' => 'App\\Http\\Controllers\\RoleController','method' => 'create','created_at' => '2022-01-14 20:09:08','updated_at' => '2022-01-14 20:09:08'),
            array('id' => '16','role_id' => '2','role_name' => 'Role','route_name' => 'role.store','key' => NULL,'controller' => 'App\\Http\\Controllers\\RoleController','method' => 'store','created_at' => '2022-01-14 20:09:08','updated_at' => '2022-01-14 20:09:08'),
            array('id' => '17','role_id' => '2','role_name' => 'Role','route_name' => 'role.show','key' => NULL,'controller' => 'App\\Http\\Controllers\\RoleController','method' => 'show','created_at' => '2022-01-14 20:09:08','updated_at' => '2022-01-14 20:09:08'),
            array('id' => '18','role_id' => '2','role_name' => 'Role','route_name' => 'role.edit','key' => NULL,'controller' => 'App\\Http\\Controllers\\RoleController','method' => 'edit','created_at' => '2022-01-14 20:09:08','updated_at' => '2022-01-14 20:09:08'),
            array('id' => '19','role_id' => '2','role_name' => 'Role','route_name' => 'role.update','key' => NULL,'controller' => 'App\\Http\\Controllers\\RoleController','method' => 'update','created_at' => '2022-01-14 20:09:08','updated_at' => '2022-01-14 20:09:08'),
            array('id' => '20','role_id' => '2','role_name' => 'Role','route_name' => 'role.destroy','key' => NULL,'controller' => 'App\\Http\\Controllers\\RoleController','method' => 'destroy','created_at' => '2022-01-14 20:09:08','updated_at' => '2022-01-14 20:09:08'),
            array('id' => '21','role_id' => '2','role_name' => 'Role','route_name' => 'role.status','key' => NULL,'controller' => 'App\\Http\\Controllers\\RoleController','method' => 'status','created_at' => '2022-01-14 20:09:08','updated_at' => '2022-01-14 20:09:08'),
            array('id' => '22','role_id' => '3','role_name' => 'User','route_name' => 'user-list','key' => NULL,'controller' => 'App\\Http\\Controllers\\UserPermissionController','method' => 'getUserList','created_at' => '2022-01-14 20:09:22','updated_at' => '2022-01-14 20:09:22'),
            array('id' => '23','role_id' => '3','role_name' => 'User','route_name' => 'banned-user-list','key' => NULL,'controller' => 'App\\Http\\Controllers\\UserPermissionController','method' => 'getBannedUserList','created_at' => '2022-01-14 20:09:22','updated_at' => '2022-01-14 20:09:22'),
            array('id' => '24','role_id' => '3','role_name' => 'User','route_name' => 'edit-user','key' => NULL,'controller' => 'App\\Http\\Controllers\\UserPermissionController','method' => 'editUser','created_at' => '2022-01-14 20:09:22','updated_at' => '2022-01-14 20:09:22'),
            array('id' => '25','role_id' => '3','role_name' => 'User','route_name' => 'update-user','key' => NULL,'controller' => 'App\\Http\\Controllers\\UserPermissionController','method' => 'updateUser','created_at' => '2022-01-14 20:09:22','updated_at' => '2022-01-14 20:09:22'),
            array('id' => '26','role_id' => '3','role_name' => 'User','route_name' => 'user.status','key' => NULL,'controller' => 'App\\Http\\Controllers\\UserPermissionController','method' => 'status','created_at' => '2022-01-14 20:09:22','updated_at' => '2022-01-14 20:09:22')
        );
        return $role_routes;
    }

}
