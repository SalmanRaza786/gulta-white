<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\PermissionModule;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $products_module = PermissionModule::updateOrCreate(['title' => 'Products'], ['title' =>'Products']);
        $product_code_module = PermissionModule::updateOrCreate(['title' => 'Product Codes'], ['title' =>'Product Codes']);
        $product_code_attempts_module = PermissionModule::updateOrCreate(['title' => 'Code Attempts'], ['title' =>'Code Attempts']);
        $messages = PermissionModule::updateOrCreate(['title' => 'Messages'], ['title' =>'Messages']);
        $faqs = PermissionModule::updateOrCreate(['title' => 'FAQs'], ['title' =>'FAQs']);
        $roles = PermissionModule::updateOrCreate(['title' => 'Roles'], ['title' =>'Roles']);
        $users = PermissionModule::updateOrCreate(['title' => 'Users'], ['title' =>'Users']);
        $pages = PermissionModule::updateOrCreate(['title' => 'Pages'], ['title' =>'Pages']);
        $reviews = PermissionModule::updateOrCreate(['title' => 'Reviews'], ['title' =>'Reviews']);
        $contact = PermissionModule::updateOrCreate(['title' => 'Contact Us'], ['title' =>'Contact Us']);



        Permission::upsert([


            //role
            ['name' => 'admin-product-view', 'module_id' =>$products_module->id, 'guard_name' => 'admin'],
            ['name' => 'admin-product-code-view', 'module_id' =>$product_code_module->id, 'guard_name' => 'admin'],
            ['name' => 'admin-code-attempts-view', 'module_id' =>$product_code_attempts_module->id, 'guard_name' => 'admin'],
            ['name' => 'admin-message-view', 'module_id' =>$messages->id, 'guard_name' => 'admin'],
            ['name' => 'admin-faq-view', 'module_id' =>$faqs->id, 'guard_name' => 'admin'],
            ['name' => 'admin-roles-view', 'module_id' =>$roles->id, 'guard_name' => 'admin'],
            ['name' => 'admin-users-view', 'module_id' =>$users->id, 'guard_name' => 'admin'],
            ['name' => 'admin-pages-view', 'module_id' =>$pages->id, 'guard_name' => 'admin'],
            ['name' => 'admin-reviews-view', 'module_id' =>$reviews->id, 'guard_name' => 'admin'],
            ['name' => 'admin-contact-view', 'module_id' =>$contact->id, 'guard_name' => 'admin'],

        ], ['name']);

    }
}
