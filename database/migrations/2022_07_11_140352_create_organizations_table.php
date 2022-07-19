<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name'); //عنوان شرکت
            $table->foreignId('parent_id')->nullable()->constrained('organizations')->onUpdate('cascade')->onDelete('cascade'); //والد سازمان
            $table->string('national_code')->nullable()->unique(); //شناسه سازمان
            $table->foreignId('manager_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade'); //مدیر سازمان
            $table->tinyInteger('inderpent')->default(0); //مستقل
            $table->string('email')->nullable()->unique(); //ایمیل
            $table->string('phone')->nullable()->unique(); //تماس
            $table->string('address')->nullable(); //آدرس دفترکار
            $table->string('fax')->nullable(); //فکس
            $table->string('website')->nullable(); //وبسایت
            $table->text('logo')->nullable(); //لوگو
            $table->string('slug')->nullable()->unique(); // نامک 
            $table->tinyInteger('status')->default(0); //وضعیت 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizations');
    }
};
