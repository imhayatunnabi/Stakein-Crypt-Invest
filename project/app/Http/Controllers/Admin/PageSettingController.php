<?php

namespace App\Http\Controllers\Admin;
use App\Models\Pagesetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\HomepageSetting;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Support\Str;
use Validator;


class PageSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function update(Request $request)
    {
            $data = Pagesetting::findOrFail(1);
            $input = $request->all();


            if ($file = $request->file('newsletter_photo'))
            {
                $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
                $file->move('assets/images',$name);
                @unlink('assets/images/'.$data->newsletter_photo);
                $input['newsletter_photo'] = $name;
            }

            if ($file = $request->file('about_photo'))
            {
                $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
                $file->move('assets/images',$name);
                @unlink('assets/images/'.$data->about_photo);
                $input['about_photo'] = $name;
            }

            if ($file = $request->file('service_photo'))
            {
                $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
                $file->move('assets/images',$name);
                @unlink('assets/images/'.$data->service_photo);
                $input['service_photo'] = $name;
            }

            if ($file = $request->file('footer_top_photo'))
            {
                $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
                $file->move('assets/images',$name);
                @unlink('assets/images/'.$data->footer_top_photo);
                $input['footer_top_photo'] = $name;
            }


            $data->update($input);
            $msg = 'Data Updated Successfully.';
            return response()->json($msg);
    }


    public function homeupdate(Request $request)
    {
        $data = Pagesetting::findOrFail(1);
        $input = $request->all();

        if ($request->slider == ""){
            $input['slider'] = 0;
        }
        if ($request->service == ""){
            $input['service'] = 0;
        }
        if ($request->featured == ""){
            $input['featured'] = 0;
        }
        if ($request->small_banner == ""){
            $input['small_banner'] = 0;
        }
        if ($request->best == ""){
            $input['best'] = 0;
        }
        if ($request->top_rated == ""){
            $input['top_rated'] = 0;
        }
        if ($request->large_banner == ""){
            $input['large_banner'] = 0;
        }
        if ($request->big == ""){
            $input['big'] = 0;
        }
        if ($request->hot_sale == ""){
            $input['hot_sale'] = 0;
        }
        if ($request->review_blog == ""){
            $input['review_blog'] = 0;
        }
        if ($request->partners == ""){
            $input['partners'] = 0;
        }
        if ($request->bottom_small == ""){
            $input['bottom_small'] = 0;
        }
        if ($request->flash_deal == ""){
            $input['flash_deal'] = 0;
        }
        if ($request->featured_category == ""){
            $input['featured_category'] = 0;
        }

        $data->update($input);
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);
    }
    public function about(){
        $data = Pagesetting::find(1);
        return view('admin.pagesetting.about_section',compact('data'));
    }

    public function topservice(){
        $data = Pagesetting::find(1);
        return view('admin.pagesetting.topservice',compact('data'));
    }

    public function footertop(){
        $data = Pagesetting::find(1);
        return view('admin.pagesetting.footertop',compact('data'));
    }

    public function contact()
    {
        $data = Pagesetting::find(1);
        return view('admin.pagesetting.contact',compact('data'));
    }

    public function customize()
    {
        $data = Pagesetting::find(1);
        return view('admin.pagesetting.customize',compact('data'));
    }

    public function best_seller()
    {
        $data = Pagesetting::find(1);
        return view('admin.pagesetting.best_seller',compact('data'));
    }

    public function big_save()
    {
        $data = Pagesetting::find(1);
        return view('admin.pagesetting.big_save',compact('data'));
    }

    public function herosection()
    {
        $ps = HomepageSetting::findOrFail(1);
        return view('admin.pagesetting.herosection',compact('ps'));
    }
    public function checkouttheme()
    {
        $ps = HomepageSetting::findOrFail(1);
        return view('admin.pagesetting.recent_theme_section',compact('ps'));
    }
    public function featuredtheme()
    {
        $ps = HomepageSetting::findOrFail(1);
        return view('admin.pagesetting.featured_theme_section',compact('ps'));
    }
    public function blogsection()
    {
        $ps = HomepageSetting::findOrFail(1);
        return view('admin.pagesetting.blog_section',compact('ps'));
    }
    public function newsletter()
    {
        $ps = HomepageSetting::findOrFail(1);
        return view('admin.pagesetting.newsletter_section',compact('ps'));
    }


    public function faqupdate($status)
    {
        $page = Pagesetting::findOrFail(1);
        $page->f_status = $status;
        $page->update();
        Session::flash('success', 'FAQ Status Upated Successfully.');
        return redirect()->back();
    }

    public function contactup($status)
    {
        $page = Pagesetting::findOrFail(1);
        $page->c_status = $status;
        $page->update();
        Session::flash('success', 'Contact Status Upated Successfully.');
        return redirect()->back();
    }

    //Upadte Contact Page Section Settings
    public function contactupdate(Request $request)
    {
        $page = Pagesetting::findOrFail(1);
        $input = $request->all();
        $page->update($input);
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);
    }


}
