<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => \Str::random(10),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {

            $adminRole = Role::firstOrCreate(['name' => 'Admin']);
            $editorRole = Role::firstOrCreate(['name' => 'Editor']);


            $manageContentPermission = Permission::firstOrCreate(['name' => 'manage content']);
            $editArticlesPermission = Permission::firstOrCreate(['name' => 'edit articles']);

            $role = $this->faker->randomElement([$adminRole, $editorRole]);
            $user->assignRole($role);

            if ($role->name === 'Admin') {
                $user->givePermissionTo([$manageContentPermission, $editArticlesPermission]);
            } elseif ($role->name === 'Editor') {
                $user->givePermissionTo($editArticlesPermission);
            }
        });
    }
}
