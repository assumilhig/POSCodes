<?php

declare(strict_types=1);

use App\Models\AccessType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_codes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AccessType::class)->constrained()->cascadeOnDelete();
            $table->string('codes')->unique();
            $table->string('status')->default(0)->comment('0|available 1|Issued 2|Used 3|Expired');
            $table->string('store_code')->nullable();
            $table->string('transaction_number')->nullable();
            $table->integer('register_no')->nullable();
            $table->integer('issued_by')->nullable();
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
        Schema::dropIfExists('access_codes');
    }
};
