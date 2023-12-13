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
        Schema::create('user_models', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->default(NULL);
            $table->string('email')->unique()->default(NULL);
            $table->string('password')->nullable();
            $table->enum('user_status', ['active', 'inactive'])->default('active');
            $table->integer('company_name_id')->nullable()->default(NULL);
            $table->integer('plain_id')->nullable()->default(NULL);
            $table->integer('refer_company_id')->nullable()->default(NULL);
            $table->string('remember_token', 100)->nullable()->default(NULL);
            $table->timestamp('remember_token_expires_at')->nullable()->default(NULL);
            $table->string('themeimage_id')->nullable()->default(NULL);
            $table->string('role_id')->nullable()->default(NULL);
            $table->string('profile_pic')->nullable()->default(NULL);
            $table->string('designation')->nullable()->default(NULL);
            $table->string('DOB')->nullable()->default(NULL);
            $table->string('phone_number')->nullable()->default(NULL);
            $table->string('location')->nullable()->default(NULL);
            $table->enum('table_status', ['1', '0'])->default('0');



            $table->text('icon1')->nullable()->default(NULL);
            $table->text('title1')->nullable()->default(NULL);
            $table->text('description1')->nullable()->default(NULL);

            $table->text('icon2')->nullable()->default(NULL);
            $table->text('title2')->nullable()->default(NULL);
            $table->text('description2')->nullable()->default(NULL);

            $table->text('icon3')->nullable()->default(NULL);
            $table->text('title3')->nullable()->default(NULL);
            $table->text('description3')->nullable()->default(NULL);

            $table->text('icon4')->nullable()->default(NULL);
            $table->text('title4')->nullable()->default(NULL);
            $table->text('description4')->nullable()->default(NULL);

            $table->text('icon5')->nullable()->default(NULL);
            $table->text('title5')->nullable()->default(NULL);
            $table->text('description5')->nullable()->default(NULL);

            $table->text('icon6')->nullable()->default(NULL);
            $table->text('title6')->nullable()->default(NULL);
            $table->text('description6')->nullable()->default(NULL);




            $table->text('galleryImage')->nullable()->default(NULL);
            $table->text('videoFile')->nullable()->default(NULL);

            $table->text('productimage1')->nullable()->default(NULL);
            $table->text('producttitle1')->nullable()->default(NULL);
            $table->text('productdescription1')->nullable()->default(NULL);
            $table->text('productprice1')->nullable()->default(NULL);

            $table->text('productimage2')->nullable()->default(NULL);
            $table->text('producttitle2')->nullable()->default(NULL);
            $table->text('productdescription2')->nullable()->default(NULL);
            $table->text('productprice2')->nullable()->default(NULL);

            $table->text('productimage3')->nullable()->default(NULL);
            $table->text('producttitle3')->nullable()->default(NULL);
            $table->text('productdescription3')->nullable()->default(NULL);
            $table->text('productprice3')->nullable()->default(NULL);

            $table->text('productimage4')->nullable()->default(NULL);
            $table->text('producttitle4')->nullable()->default(NULL);
            $table->text('productdescription4')->nullable()->default(NULL);
            $table->text('productprice4')->nullable()->default(NULL);

            $table->text('productimage5')->nullable()->default(NULL);
            $table->text('producttitle5')->nullable()->default(NULL);
            $table->text('productdescription5')->nullable()->default(NULL);
            $table->text('productprice5')->nullable()->default(NULL);

            $table->text('productimage6')->nullable()->default(NULL);
            $table->text('producttitle6')->nullable()->default(NULL);
            $table->text('productdescription6')->nullable()->default(NULL);
            $table->text('productprice6')->nullable()->default(NULL);

            $table->text('mondaystart')->nullable()->default(NULL);
            $table->text('mondayend')->nullable()->default(NULL);
            $table->text('tuesdaystart')->nullable()->default(NULL);
            $table->text('tuesdayend')->nullable()->default(NULL);

            $table->text('wednesdaystart')->nullable()->default(NULL);
            $table->text('wednesdayend')->nullable()->default(NULL);
            $table->text('thursdaystart')->nullable()->default(NULL);
            $table->text('thursdayend')->nullable()->default(NULL);

            $table->text('fridaystart')->nullable()->default(NULL);
            $table->text('fridayend')->nullable()->default(NULL);
            $table->text('saturdaystart')->nullable()->default(NULL);
            $table->text('saturdayend')->nullable()->default(NULL);

            $table->text('testmonial1')->nullable()->default(NULL);
            $table->text('testimonial_title1')->nullable()->default(NULL);
            $table->text('testimonialDescription1')->nullable()->default(NULL);
            $table->text('subtitle1')->nullable()->default(NULL);

            $table->text('testimonial2')->nullable()->default(NULL);
            $table->text('testimonial_title2')->nullable()->default(NULL);
            $table->text('testimonialDescription2')->nullable()->default(NULL);
            $table->text('subtitle2')->nullable()->default(NULL);

            $table->text('websiteURL')->nullable()->default(NULL);
            $table->text('instagramURL')->nullable()->default(NULL);
            $table->text('youtubeURL')->nullable()->default(NULL);
            $table->text('linkedinURL')->nullable()->default(NULL);
            $table->text('whatsappURL')->nullable()->default(NULL);

            $table->text('gstNumber')->nullable()->default(NULL);
            $table->text('bankname')->nullable()->default(NULL);
            $table->text('accountnumber')->nullable()->default(NULL);
            $table->text('branch')->nullable()->default(NULL);
            $table->text('ifsccode')->nullable()->default(NULL);

            $table->text('company_name')->nullable()->default(NULL);

            $table->string('nfc_id')->nullable()->default(NULL);

            $table->string('qr_code')->nullable()->default(NULL);


            $table->timestamps('');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('user_models');
    }
};
