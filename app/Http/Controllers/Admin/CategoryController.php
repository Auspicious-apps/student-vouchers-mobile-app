<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Categories;

class CategoryController extends Controller
{

    //add category page
    public function index()
    {
        return view('admin.add-category');
    }


    //store category
    public function addcategory(Request $request)
    {  
        $subcategory = $request->subcategory;
        $category = new Categories;
        $category->parent_key = '0';
        $category->name = $request->input('name');
       if($request->hasfile('image')){
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('category',$filename);
            $category->image = $filename;
        }
        
        $category->save();
         if(!empty($subcategory)){
         for($i=0;$i<count($subcategory);$i++){
                $plane_benefits = new Categories;
                $plane_benefits->parent_key = $category->id;
                $plane_benefits->name = $subcategory[$i];
                 $plane_benefits->image  =  $category->image;
                $plane_benefits->save();
            }
        }

       return redirect()->back()->with('status','Category Added Successfully');
    }


    //show category
    public function show(Request $request)
    {   
        $id = $request->input('id');
        $Category= Categories::where('parent_key','0')->get();
       // $category = Categories::find(1);
        return view('admin.category', compact('Category'));
    }


    //edit category
     public function edit($id)
    {    
        // $id = $request->input('id');
        $Category = Categories::find($id);
        $category = Categories::where('parent_key',$id)->get();
       
       return view('admin.edit-category',['Category'=>$Category,'subcategory'=>$category]);
    }


    //update category
    public function update(Request $request, $id)
    {

        $subcategory = $request->subcategory;
        $sub = $request->sub;
    
        $Category= Categories::find($id);
        $Category->name = $request->input('name');
        if($request->hasfile('image')){
            $destination = 'category/'.$Category->image;
             //die($destination);
            if(File::exists($destination))
            {
                File::delete($destination);
            } 
            $file = $request->file('image');
           // die($file);
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('category/',$filename);
            $Category->image = $filename;
        }
        $Category->update();
        $new_values = [];
        if(!empty($subcategory)){
         for($i=0;$i<count($subcategory);$i++){
                $sub_category = new Categories;
                $sub_category->parent_key = $id;
                $sub_category->name = $subcategory[$i];
                 $sub_category->image  =  $Category->image;
                $sub_category->save();
                array_push($new_values,$sub_category->id);
            }
        }
        
        $available_array= Categories::where('parent_key',$id)->get(['id']);
       
         $array=[];
         if(!empty($sub)){
          foreach($sub as $s=>$key){
                
                    foreach($key as $v=>$value){
                        $sub_category = Categories::find($v);
                        $sub_category->name = $value;
                        $sub_category->update();

                    }
                    array_push($array,$v);
                }
            }
        $available_data = array_merge($array,$new_values );

                for($i=0;$i<count($available_array);$i++){
            
                  if(!in_array($available_array[$i]->id,$available_data))
                            {
                                //echo "<pre>"; print($available_array[$i]->id); 
                                Categories::where('id',$available_array[$i]->id)->delete();
                            }
            }

        return redirect()->back()->with('status','Category Updated Successfully');
    }


    //destroy category
    public function destroy($id)
    {
        $Category= Categories::find($id);
        $destination = 'uploads/'.$Category->image;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $Category->delete();
        return redirect()->back()->with('status','Student Image Deleted Successfully');
    } 



}
