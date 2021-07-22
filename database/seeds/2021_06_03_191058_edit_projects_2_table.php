<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditProjects2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('deposit_terms')->nullable();
            $table->string('agent_comm')->nullable();
            $table->string('completion_mnth')->nullable();
            $table->string('completion_year')->nullable();
            $table->integer('rowhouse')->nullable();
            $table->boolean('status')->default(0)->change();
            $table->string('sales_company')->nullable();
            $table->string('sales_address')->nullable();
            $table->string('designer')->nullable();
            $table->longText('promotions')->default('[]');
            $table->longText('documents')->default('[]');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
