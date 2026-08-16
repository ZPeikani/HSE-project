<?php
namespace Tests\Feature;
use App\Enums\UserRole; use App\Models\User; use Database\Seeders\DatabaseSeeder; use Illuminate\Foundation\Testing\RefreshDatabase; use Tests\TestCase;
class HseAccessTest extends TestCase { use RefreshDatabase; public function test_guest_is_redirected_to_login():void{$this->get('/')->assertRedirect('/login');} public function test_admin_can_open_user_management():void{$this->seed(DatabaseSeeder::class);$admin=User::where('role',UserRole::Admin->value)->firstOrFail();$this->actingAs($admin)->get('/users')->assertOk();} public function test_inspector_cannot_manage_users():void{$this->seed(DatabaseSeeder::class);$inspector=User::where('role',UserRole::Inspector->value)->firstOrFail();$this->actingAs($inspector)->get('/users')->assertForbidden();} }
