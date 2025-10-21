<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('dentists', function (Blueprint $table) {
            $table->string('avatar')->nullable()->after('specialty');      // ảnh bác sĩ
            $table->string('degree')->nullable()->after('avatar');         // học vị
            $table->text('bio')->nullable()->after('degree');              // mô tả, tiểu sử
            $table->integer('experience_years')->nullable()->after('bio'); // số năm kinh nghiệm
            $table->string('email')->nullable();
            $table->string('phone')->nullable()->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('dentists', function (Blueprint $table) {
            $table->dropColumn([
                'avatar',
                'degree',
                'bio',
                'experience_years',
                'email',
                'phone',
            ]);
        });
    }
};
