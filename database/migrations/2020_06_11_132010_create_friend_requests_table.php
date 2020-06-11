<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFriendRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friend_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('user_from_id')->nullable()->default(null);
            $table->unsignedBigInteger('user_to_id')  ->nullable()->default(null);
            $table->timestamps();

            $table->primary([
                'user_from_id',
                'user_to_id'
            ]);
        });

        Schema::table('friend_requests', function (Blueprint $table) {
            $table->foreign('user_from_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('user_to_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('friend_requests');
    }
}
