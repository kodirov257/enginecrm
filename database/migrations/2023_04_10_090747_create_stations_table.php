<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->integer('station')->primary();
            $table->string('name')->nullable(false)->default('');
            $table->tinyInteger('alert')->nullable(false)->default(0);
            $table->string('lat')->nullable(false)->default('0');
            $table->string('long')->nullable(false)->default('0');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        DB::table('stations')->insert([
            'station'           => 1,
            'name'              => 'Station 1',
            'alert'             => 0,
            'lat'               => '41.2995',
            'long'              => '69.2401',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);

        DB::table('stations')->insert([
            'station'           => 2,
            'name'              => 'Station 2',
            'alert'             => 0,
            'lat'               => '41.297521',
            'long'              => '69.252506',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);

        DB::table('stations')->insert([
            'station'           => 3,
            'name'              => 'Station 3',
            'alert'             => 0,
            'lat'               => '41.289267',
            'long'              => '69.283082',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stations');
    }
};
