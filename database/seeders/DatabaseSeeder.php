<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Contact;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        // create permissions
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'create users']);

        Permission::create(['name' => 'edit pages']);
        Permission::create(['name' => 'delete pages']);
        Permission::create(['name' => 'publish pages']);
        Permission::create(['name' => 'unpublish pages']);
    

        //create roles
        $role_admin = Role::create(['name' => 'admin']);
        $role_user = Role::create(['name' => 'user']);


        //create account
        $account = Account::create(['name' => 'Bali Web Maker Dev']);

        //Add User
        $admin = User::factory()->create([
            'account_id' => $account->id,
            'first_name' => 'Admin',
            'last_name' => 'Dev',
            'email' => 'admin@gmail.com',
            'owner' => true,
            'password' => 'secret',
        ]);

//Assign Role 'admin' to user Admin via spatie table model_has_roles
$admin->assignRole($role_admin->name);

//Add User
$user = User::factory()->create([
    'account_id' => $account->id,
    'first_name' => 'User',
    'last_name' => 'Dev',
    'email' => 'user@gmail.com',
    'owner' => false,
]);

//Assign Role 'user' to user User via spatie table model_has_roles
$user->assignRole($role_user->name);

       //get all permission
       $permissions = Permission::pluck('id','id')->all();
       //give all permission to admin
       $role_admin->syncPermissions($permissions);

        //give Permission To user
        $role_user->givePermissionTo('edit users');

         //Create User from Userfactory
         User::factory(2)
                ->create(['account_id' => $account->id])
                ->each(function ($user) {
                    $user->assignRole('user');
                });

        $organizations = Organization::factory(10)
            ->create(['account_id' => $account->id]);

        Contact::factory(2)
            ->create(['account_id' => $account->id])
            ->each(function ($contact) use ($organizations) {
                $contact->update(['organization_id' => $organizations->random()->id]);
            });
    }
}
