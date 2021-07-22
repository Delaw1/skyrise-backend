<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('type_id')->constrained()->onDelete('cascade');
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('country')->nullable();
            $table->string('price')->nullable();
            $table->integer('condos')->nullable();
            $table->integer('townhouse')->nullable();
            $table->integer('rowhouse')->nullable();
            $table->integer('commercial')->nullable();
            $table->string('floor_size')->nullable();
            $table->string('floor_size2')->nullable();
            $table->string('levels')->nullable();
            $table->string('maintenance_fees')->nullable();
            $table->foreignId('developer_id')->constrained()->onDelete('cascade');
            $table->string('architect')->nullable();
            $table->string('project_website')->nullable();
            $table->string('contact_firstname')->nullable();
            $table->string('contact_lastname')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->boolean('featured')->default(0);
            $table->string('zone')->nullable();
            $table->string('completion')->nullable();
            $table->string('lot')->nullable();
            $table->string('f_d')->nullable();
            $table->longText('amenities')->default('[]');
            $table->longText('floors')->default('[]');
            $table->longText('description')->nullable();
            $table->string('images')->default('[]');
            $table->longText('videos')->default('[]');
            $table->string('feature_sheet')->default('[]');
            $table->string('location')->nullable();
            $table->string('bedrooms')->nullable();
            $table->string('bathrooms')->nullable();
            $table->string('developer')->nullable();
            $table->string('list_by')->nullable();
            $table->string('mls')->nullable();
            $table->string('deposit_terms')->nullable();
            $table->string('agent_comm')->nullable();
            $table->string('completion_mnth')->nullable();
            $table->string('completion_year')->nullable();
            
            $table->string('status')->nullable();
            $table->boolean('published')->default(0);
            $table->string('sales_company')->nullable();
            $table->string('sales_address')->nullable();
            $table->string('designer')->nullable();
            $table->longText('promotions')->default('[]');
            $table->longText('documents')->default('[]');
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
        Schema::dropIfExists('projects');
    }
}
