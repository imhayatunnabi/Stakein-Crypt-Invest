<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Validator;
use Datatables;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function datatables()
    {
         $datas = Slider::orderBy('id','desc');

         return Datatables::of($datas)
                            ->editColumn('photo', function(Slider $data) {
                                $photo = $data->photo ? url('assets/images/'.$data->photo):url('assets/images/noimage.png');
                                return '<img src="' . $photo . '" alt="Image">';
                            })
                            ->editColumn('title', function(Slider $data) {
                                $title = mb_strlen(strip_tags($data->title),'utf-8') > 250 ? mb_substr(strip_tags($data->title),0,250,'utf-8').'...' : strip_tags($data->title);
                                return  $title;
                            })
                            ->addColumn('action', function(Slider $data) {

                                return '<div class="btn-group mb-1">
                                  <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    '.'Actions' .'
                                  </button>
                                  <div class="dropdown-menu" x-placement="bottom-start">
                                    <a href="' . route('admin.slider.edit',$data->id) . '"  class="dropdown-item">'.__("Edit").'</a>
                                    <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="dropdown-item" data-href="'.  route('admin.slider.delete',$data->id).'">'.__("Delete").'</a>
                                  </div>
                                </div>';
  
                              })
                            ->rawColumns(['photo', 'action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    public function index()
    {
        return view('admin.slider.index');
    }

    public function create()
    {
        return view('admin.slider.create');
    }


    public function store(Request $request)
    {
        $rules = [
            'title_text' => 'required|unique:sliders',
            'photo'      => 'required|mimes:jpeg,jpg,png,svg',
          ];

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $data = new Slider();
        $input = $request->all();
        if ($file = $request->file('photo')) 
         {      
            $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
            $file->move('assets/images',$name);           
            $input['photo'] = $name;
        } 
        $data->fill($input)->save();
     
        $msg = 'New Data Added Successfully.'.'<a href="'.route("admin.slider.index").'">View Slider Lists</a>';
        return response()->json($msg);       
    }


    public function edit($id)
    {
        $data = Slider::findOrFail($id);
        return view('admin.slider.edit',compact('data'));
    }


    public function update(Request $request, $id)
    {
        $rules = [
              'title_text' => 'required|unique:sliders,title_text,'.$id,
               'photo'      => 'mimes:jpeg,jpg,png,svg',
          ];

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $data = Slider::findOrFail($id);
        $input = $request->all();
        if ($file = $request->file('photo')) 
        {              
          $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
            $file->move('assets/images',$name);
            @unlink('assets/images/'.$data->photo);            
            $input['photo'] = $name;
        } 
        $data->update($input);
   
        $msg = 'Data Updated Successfully.'.'<a href="'.route("admin.slider.index").'">View Slider Lists</a>';
        return response()->json($msg);               
    }


    public function destroy($id)
    {
        $data = Slider::findOrFail($id);
        @unlink('assets/images/'.$data->photo);  
        $data->delete();

        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);        
    }
}
