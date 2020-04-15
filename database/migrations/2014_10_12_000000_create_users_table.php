<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\User;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('lastname');
            $table->string('identification_number',12)->unique();
            $table->string('type');
            $table->string('status')->default('Activo');
            $table->string('email',100)->unique();
            $table->string('image')->default('public/default.png');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('password_init');
            $table->rememberToken();
            $table->timestamps();
        });

        $now = \Carbon\Carbon::now();
        return User::create([
            'name' => 'Administrador',
            'lastname' => 'Admin',
            'email' => 'admin@admin.com',
            'password' =>  Hash::make('admin'),
            'password_init' => encrypt('admin'),
            'identification_number' => '10000000000',
            'type' => 'Administrador',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
