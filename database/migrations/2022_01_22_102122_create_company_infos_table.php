<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_infos', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->text('slogan')->nullable();
            $table->longText('about_blog')->nullable();
            $table->text('logo_one')->nullable();
            $table->text('logo_two')->nullable();
            $table->text('address')->nullable();
            $table->text('phone_one')->nullable();
            $table->text('phone_two')->nullable();
            $table->string('company_color')->nullable();
            $table->string('email')->nullable();
            $table->string('fb_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('linked_link')->nullable();
            $table->string('youtube_link')->nullable();

            $table->longText('vision')->nullable();
            $table->longText('mission')->nullable();

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
        Schema::dropIfExists('company_infos');
    }
}
