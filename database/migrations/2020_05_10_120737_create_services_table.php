<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->constrained()->onDelete('cascade');
            // $table->enum('main_menu', ['Web Hosting', 'Web Design', 'SEO', 'Management Systems', 'School Softwares', 'Whiteboard Video']);
            $table->string('sub_menu')->unique();
            $table->string('title');
            $table->text('content');
            $table->string('image')->nullable();
            // $table->enum('main_menu_slug', ['web-hosting', 'web-design', 'seo', 'management-systems', 'school-softwares', 'whiteboard-video']);
            $table->string('sub_menu_slug')->unique();
            $table->string('button_text')->nullable();
            $table->string('button_link')->nullable();
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
        Schema::dropIfExists('services');
    }
}
