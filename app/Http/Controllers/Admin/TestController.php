<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Categories;

class TestController extends Controller
{
        // set index page view
    public function index() {
        return view('admin.index');
    }

    // handle fetch all eamployees ajax request
    public function fetchAll() {
        $emps = Categories::all();
        $output = '';
        if ($emps->count() > 0) {
            $output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $emp->id . '</td>
                <td><img src="category/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
              
                <td>' . $emp->name . '</td>
              
                <td>
                  <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editEmployeeModal"><i class="bi-pencil-square h4"></i></a>

                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    // handle insert a new employee ajax request
    public function store(Request $request) {
        $file = $request->file('avatar');
        dd($file);
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move('category/',$filename);

        $empData = ['name' => $request->fname,'image' => $fileName];
        Categories::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    } 
    

    // handle edit an employee ajax request
    public function edit(Request $request) {
        $id = $request->id;
        $emp = Categories::find($id);
        return response()->json($emp);
    }
    // handle update an employee ajax request
    public function update(Request $request) {
        $fileName = '';
        $emp = Categories::find($request->emp_id);
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
           $file->move('category/',$filename);
            if ($emp->avatar) {
                File::delete('uploads/' . $emp->avatar);
            }
        } else {
            $fileName = $request->emp_avatar;
        }

        $empData = ['name' => $request->fname,  'image' => $fileName];

        $emp->update($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle delete an employee ajax request
    public function delete(Request $request) {
        $id = $request->id;
         $Category= Categories::find($id);
            $destination = 'uploads/'.$Category->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $Category->delete();
    }
}
