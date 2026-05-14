<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE members MODIFY COLUMN status ENUM('active', 'inactive', 'expired', 'suspended') DEFAULT 'active'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE members MODIFY COLUMN status ENUM('active', 'inactive') DEFAULT 'active'");
    }
};