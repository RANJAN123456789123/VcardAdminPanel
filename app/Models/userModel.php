<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userModel extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'name',
        'email',
        'password',
        'user_status',
        'remember_token',
        'remember_token_expires_at',
        'refer_company_id',
        'plain_id',
        'company_name_id',
        'themeimage_id',
        'role_id',
        'profile_pic',
        'table_status',
        'designation',
        'DOB',
        'phone_number',
        'location',

        'icon1',
        'title1',
        'description1',

        'icon2',
        'title2',
        'description2',

        'icon3',
        'title3',
        'description3',

        'icon4',
        'title4',
        'description4',

        'icon5',
        'title5',
        'description5',

        'icon6',
        'title6',
        'description6',

        'videoFile',
        'galleryImage',

        'productimage1',
        'producttitle1',
        'productdescription1',
        'productprice1',

        'productimage2',
        'producttitle2',
        'productdescription2',
        'productprice2',

        'productimage3',
        'producttitle3',
        'productdescription3',
        'productprice3',

        'productimage4',
        'producttitle4',
        'productdescription4',
        'productprice4',

        'productimage5',
        'producttitle5',
        'productdescription5',
        'productprice5',

        'productimage6',
        'producttitle6',
        'productdescription6',
        'productprice6',

        'testmonial1',
        'testimonial_title1',
        'testimonialDescription1',
        'subtitle1',

        'testimonial2',
        'testimonial_title2',
        'testimonialDescription2',
        'subtitle2',

        'mondaystart',
        'mondayend',
        'tuesdaystart',
        'tuesdayend',

        'wednesdaystart',
        'wednesdayend',
        'thursdaystart',
        'thursdayend',

        'fridaystart',
        'fridayend',
        'saturdaystart',
        'saturdayend',

        'websiteURL',
        'instagramURL',
        'youtubeURL',
        'linkedinURL',
        'whatsappURL',

        'gstNumber',
        'bankname',
        'accountnumber',

        'branch',
        'ifsccode',
        'company_name',
        'nfc_id',
        'qr_code'

    ];

    public function rolemodel()
    {
        return $this->belongsTo(roleModel::class, 'role_id', 'id');
    }

    public function vcardmodel()
    {
        return $this->hasMany(vcardAddModel::class);
    }
}
