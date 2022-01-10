<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_agents', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->unique();
            $table->text('browser')->nullable();
            $table->text('browser_version')->nullable();
            $table->text('platform')->nullable();
            $table->text('platform_version')->nullable();
            $table->text('device')->nullable();
            $table->text('device_type')->nullable();
            $table->text('robot')->nullable();
            $table->boolean('is_robot')->default(false);
            $table->boolean('is_mobile')->default(false);
            $table->boolean('is_phone')->default(false);
            $table->boolean('is_tablet')->default(false);
            $table->boolean('is_desktop')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_agents');
    }
}
