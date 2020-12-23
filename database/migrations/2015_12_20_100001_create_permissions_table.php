<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50);
            $table->string('slug')->unique();
            $table->string('resource', 20)->default('System');
            $table->boolean('system')->default(0);
            $table->timestamps();
        });

        if (Schema::hasTable('permissions')) {
            DB::table('permissions')->insert([

                //Permissions
                [
                    'name' => 'View Permissions',
                    'slug' => 'permissions.view',
                    'resource' => 'Permissions',
                    'system' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Create Permissions',
                    'slug' => 'permissions.create',
                    'resource' => 'Permissions',
                    'system' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Update Permissions',
                    'slug' => 'permissions.update',
                    'resource' => 'Permissions',
                    'system' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Delete Permissions',
                    'slug' => 'permissions.delete',
                    'resource' => 'Permissions',
                    'system' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                //Role
                [
                    'name' => 'View Roles',
                    'slug' => 'roles.view',
                    'resource' => 'Roles',
                    'system' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Create Roles',
                    'slug' => 'roles.create',
                    'resource' => 'Roles',
                    'system' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Update Roles',
                    'slug' => 'roles.update',
                    'resource' => 'Roles',
                    'system' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Delete Roles',
                    'slug' => 'roles.delete',
                    'resource' => 'Roles',
                    'system' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Restore Roles',
                    'slug' => 'roles.restore',
                    'resource' => 'Roles',
                    'system' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                //Users
                [
                    'name' => 'View Users',
                    'slug' => 'users.view',
                    'resource' => 'Users',
                    'system' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Create Users',
                    'slug' => 'users.create',
                    'resource' => 'Users',
                    'system' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Update Users',
                    'slug' => 'users.update',
                    'resource' => 'Users',
                    'system' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Delete Users',
                    'slug' => 'users.delete',
                    'resource' => 'Users',
                    'system' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Restore Users',
                    'slug' => 'users.restore',
                    'resource' => 'Users',
                    'system' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                //NotaryTable
                [
                    'name' => 'View NotaryTable',
                    'slug' => 'notary_table.view',
                    'resource' => 'NotaryTable',
                    'system' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Create NotaryTable',
                    'slug' => 'notary_table.create',
                    'resource' => 'NotaryTable',
                    'system' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Update NotaryTable',
                    'slug' => 'notary_table.update',
                    'resource' => 'NotaryTable',
                    'system' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Delete NotaryTable',
                    'slug' => 'notary_table.delete',
                    'resource' => 'NotaryTable',
                    'system' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Restore NotaryTable',
                    'slug' => 'notary_table.restore',
                    'resource' => 'NotaryTable',
                    'system' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                //PrivateBailiff
                [
                    'name' => 'View PrivateBailiff',
                    'slug' => 'private_bailiff.view',
                    'resource' => 'PrivateBailiff',
                    'system' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Create PrivateBailiff',
                    'slug' => 'private_bailiff.create',
                    'resource' => 'PrivateBailiff',
                    'system' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Update PrivateBailiff',
                    'slug' => 'private_bailiff.update',
                    'resource' => 'PrivateBailiff',
                    'system' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Delete PrivateBailiff',
                    'slug' => 'private_bailiff.delete',
                    'resource' => 'PrivateBailiff',
                    'system' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Restore PrivateBailiff',
                    'slug' => 'private_bailiff.restore',
                    'resource' => 'PrivateBailiff',
                    'system' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                //NotariesDirectory
                [
                    'name' => 'View NotariesDirectory',
                    'slug' => 'notaries_directory.view',
                    'resource' => 'NotariesDirectory',
                    'system' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Create NotariesDirectory',
                    'slug' => 'notaries_directory.create',
                    'resource' => 'NotariesDirectory',
                    'system' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Update NotariesDirectory',
                    'slug' => 'notaries_directory.update',
                    'resource' => 'NotariesDirectory',
                    'system' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Delete NotariesDirectory',
                    'slug' => 'notaries_directory.delete',
                    'resource' => 'NotariesDirectory',
                    'system' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Restore NotariesDirectory',
                    'slug' => 'notaries_directory.restore',
                    'resource' => 'NotariesDirectory',
                    'system' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                //Settings_notary
                [
                    'name' => 'View SettingsNotary',
                    'slug' => 'settings_notary.view',
                    'resource' => 'SettingsNotary',
                    'system' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Update SettingsNotary',
                    'slug' => 'settings_notary.update',
                    'resource' => 'SettingsNotary',
                    'system' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
            ]);
        }
    }

    /**
     * Reverse the migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
