<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            DB::statement('ALTER TABLE messages MODIFY conversation_id BIGINT UNSIGNED NULL');
        });
    }

    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            DB::statement('ALTER TABLE messages MODIFY conversation_id BIGINT UNSIGNED NOT NULL');
        });
    }
};
