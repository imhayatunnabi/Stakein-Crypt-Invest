<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagesetting extends Model
{
    protected $fillable = ['contact_success','contact_email','contact_title','contact_text','street','phone','fax','email','site','side_title','side_text','slider','service','featured','small_banner','best','top_rated','large_banner','big','hot_sale','review_blog','pricing_plan','video_subtitle','video_title','video_text','video_link','video_image','video_background','service_subtitle','service_title','service_text','portfolio_subtitle','portfolio_title','portfolio_text','p_subtitle','p_title','p_text','team_subtitle','team_title','team_text','review_subtitle','review_title','review_text','blog_subtitle','blog_title','blog_text','banner_title','banner_text','banner_link1','banner_link2','t_big_title','t_title','t_subtitle','t_text','c_background','c_title','c_text','about_photo','about_title','about_text','about_link','service_photo','service_video','footer_top_photo','footer_top_title','footer_top_text'];

    public $timestamps = false;

    public function upload($name,$file,$oldname)
    {
                $file->move('assets/images',$name);
                if($oldname != null)
                {
                    if (file_exists(public_path().'/assets/images/'.$oldname)) {
                        unlink(public_path().'/assets/images/'.$oldname);
                    }
                }  
    }

}
