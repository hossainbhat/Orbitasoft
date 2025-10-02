<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use KawsarJoy\RolePermission\Models\Role;
use KawsarJoy\RolePermission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->where('id', '!=', 0)->delete();
        DB::table('permissions')->where('parent_id', '!=', 'NULL')->delete();
        DB::table('permissions')->where('id', '!=', 0)->delete();


        //category
        $categoryP = Permission::firstOrCreate(['name' => 'category_label', 'description' => 'Categories', 'parent_id' => NULL, 'order' => 1]);
        Permission::updateOrCreate(['name' => 'categories.index'], ['description' => 'List', 'parent_id' => $categoryP->id, 'order' => 1]);
        Permission::updateOrCreate(['name' => 'categories.show'], ['description' => 'Show', 'parent_id' => $categoryP->id, 'order' => 2]);
        Permission::updateOrCreate(['name' => 'categories.store'], ['description' => 'Add', 'parent_id' => $categoryP->id, 'order' => 3]);
        Permission::updateOrCreate(['name' => 'categories.update'], ['description' => 'Update', 'parent_id' => $categoryP->id, 'order' => 4]);
        Permission::updateOrCreate(['name' => 'categories.destroy'], ['description' => 'Delete', 'parent_id' => $categoryP->id, 'order' => 5]);
        
        //countries
        $countryP = Permission::firstOrCreate(['name' => 'country_label', 'description' => 'Countries', 'parent_id' => NULL, 'order' => 1]);
        Permission::updateOrCreate(['name' => 'countries.index'], ['description' => 'List', 'parent_id' => $countryP->id, 'order' => 1]);
        Permission::updateOrCreate(['name' => 'countries.show'], ['description' => 'Show', 'parent_id' => $countryP->id, 'order' => 2]);
        Permission::updateOrCreate(['name' => 'countries.store'], ['description' => 'Add', 'parent_id' => $countryP->id, 'order' => 3]);
        Permission::updateOrCreate(['name' => 'countries.update'], ['description' => 'Update', 'parent_id' => $countryP->id, 'order' => 4]);
        Permission::updateOrCreate(['name' => 'countries.destroy'], ['description' => 'Delete', 'parent_id' => $countryP->id, 'order' => 5]);
        
        //cities
        $cityP = Permission::firstOrCreate(['name' => 'city_label', 'description' => 'Cities', 'parent_id' => NULL, 'order' => 1]);
        Permission::updateOrCreate(['name' => 'cities.index'], ['description' => 'List', 'parent_id' => $cityP->id, 'order' => 1]);
        Permission::updateOrCreate(['name' => 'cities.show'], ['description' => 'Show', 'parent_id' => $cityP->id, 'order' => 2]);
        Permission::updateOrCreate(['name' => 'cities.store'], ['description' => 'Add', 'parent_id' => $cityP->id, 'order' => 3]);
        Permission::updateOrCreate(['name' => 'cities.update'], ['description' => 'Update', 'parent_id' => $cityP->id, 'order' => 4]);
        Permission::updateOrCreate(['name' => 'cities.destroy'], ['description' => 'Delete', 'parent_id' => $cityP->id, 'order' => 5]);

        //attributes
        $attributeP = Permission::firstOrCreate(['name' => 'attribute_label', 'description' => 'Attributes', 'parent_id' => NULL, 'order' => 1]);
        Permission::updateOrCreate(['name' => 'attributes.index'], ['description' => 'List', 'parent_id' => $attributeP->id, 'order' => 1]);
        Permission::updateOrCreate(['name' => 'attributes.show'], ['description' => 'Show', 'parent_id' => $attributeP->id, 'order' => 2]);
        Permission::updateOrCreate(['name' => 'attributes.store'], ['description' => 'Add', 'parent_id' => $attributeP->id, 'order' => 3]);
        Permission::updateOrCreate(['name' => 'attributes.update'], ['description' => 'Update', 'parent_id' => $attributeP->id, 'order' => 4]);
        Permission::updateOrCreate(['name' => 'attributes.destroy'], ['description' => 'Delete', 'parent_id' => $attributeP->id, 'order' => 5]);

        //products
        $productP = Permission::firstOrCreate(['name' => 'product_label', 'description' => 'Product', 'parent_id' => NULL, 'order' => 1]);
        Permission::updateOrCreate(['name' => 'products.index'], ['description' => 'List', 'parent_id' => $productP->id, 'order' => 1]);
        Permission::updateOrCreate(['name' => 'products.show'], ['description' => 'Show', 'parent_id' => $productP->id, 'order' => 2]);
        Permission::updateOrCreate(['name' => 'products.store'], ['description' => 'Add', 'parent_id' => $productP->id, 'order' => 3]);
        Permission::updateOrCreate(['name' => 'products.update'], ['description' => 'Update', 'parent_id' => $productP->id, 'order' => 4]);
        Permission::updateOrCreate(['name' => 'products.destroy'], ['description' => 'Delete', 'parent_id' => $productP->id, 'order' => 5]);

        //orders
        $orderP = Permission::firstOrCreate(['name' => 'product_label', 'description' => 'Product', 'parent_id' => NULL, 'order' => 1]);
        Permission::updateOrCreate(['name' => 'orders.index'], ['description' => 'List', 'parent_id' => $orderP->id, 'order' => 1]);
        Permission::updateOrCreate(['name' => 'products.show'], ['description' => 'Show', 'parent_id' => $orderP->id, 'order' => 2]);
        Permission::updateOrCreate(['name' => 'products.destroy'], ['description' => 'Delete', 'parent_id' => $orderP->id, 'order' => 3]);
        
        //roles
        $rolesP = Permission::firstOrCreate(['name' => 'roles_label', 'description' => 'Roles', 'parent_id' => NULL, 'order' => 1]);
        Permission::updateOrCreate(['name' => 'roles.index'], ['description' => 'List', 'parent_id' => $rolesP->id, 'order' => 1]);
        Permission::updateOrCreate(['name' => 'roles.show'], ['description' => 'Show', 'parent_id' => $rolesP->id, 'order' => 2]);
        Permission::updateOrCreate(['name' => 'roles.store'], ['description' => 'Add', 'parent_id' => $rolesP->id, 'order' => 3]);
        Permission::updateOrCreate(['name' => 'roles.update'], ['description' => 'Update', 'parent_id' => $rolesP->id, 'order' => 4]);
        Permission::updateOrCreate(['name' => 'roles.destroy'], ['description' => 'Delete', 'parent_id' => $rolesP->id, 'order' => 5]);
        Permission::updateOrCreate(['name' => 'all_permission'], ['description' => 'All permission', 'parent_id' => $rolesP->id, 'order' => 6]);
        
        //users
        $usersP = Permission::firstOrCreate(['name' => 'users_label', 'description' => 'Users', 'parent_id' => NULL, 'order' => 1]);
        Permission::updateOrCreate(['name' => 'users.index'], ['description' => 'List', 'parent_id' => $usersP->id, 'order' => 1]);
        Permission::updateOrCreate(['name' => 'users.show'], ['description' => 'Show', 'parent_id' => $usersP->id, 'order' => 2]);
        Permission::updateOrCreate(['name' => 'users.store'], ['description' => 'Add', 'parent_id' => $usersP->id, 'order' => 3]);
        Permission::updateOrCreate(['name' => 'users.update'], ['description' => 'Update', 'parent_id' => $usersP->id, 'order' => 4]);
        Permission::updateOrCreate(['name' => 'users.destroy'], ['description' => 'Delete', 'parent_id' => $usersP->id, 'order' => 5]);

        // Permission::updateOrCreate(['name' => 'users.changePassword'], ['description' => 'Users change password', 'parent_id' => $usersP->id, 'order' => 6]);
        // Permission::updateOrCreate(['name' => 'users.updateProfile'], ['description' => 'Users update profile', 'parent_id' => $usersP->id, 'order' => 7]);
        // Permission::updateOrCreate(['name' => 'logout'], ['description' => 'Logout', 'parent_id' => $usersP->id, 'order' => 8]);

        Permission::updateOrCreate(['name' => 'permission'], ['description' => 'Permission', 'parent_id' => $usersP->id, 'order' => 6]);

        //create Role and assign permission to first admin
        $user = User::orderBy('id', 'asc')->first();
        $saRole = Role::updateOrCreate(['name' => 'super-admin'], ['name' => 'super-admin', 'description' => 'Super Admin']);
        $user->roles()->sync([$saRole->id]);
        $saRole->permissions()->sync(Permission::all()->pluck('id')->toArray());
    }
}
