<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienceUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experience_users', function (Blueprint $table) {
            $table->id();
            // $table->integer('detail_user_id')->nullable();
            $table->foreignId('detail_user_id')->nullable()->index('fk_experience_users_to_detail_users');
            $table->string('role')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('experience_users');
    }
}
