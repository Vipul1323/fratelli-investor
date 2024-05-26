<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Validator;

class CategoryController extends Controller
{
    public function __construct(){
    }

    public function index(Request $request){
        $search = $request->get('search'); // Searching Keywords
        $order = $request->get('order'); // Order by what column?
        $dir = $request->get('dir'); // Order direction: asc or desc
        $parentId = $request->get('parent_id');
        $page_appends = [];
        $data = [];

        if ($order && $dir) {
            $folders = Category::orderBy($order, $dir);
        } else {
            $folders = Category::orderBy('id', 'desc');
        }

        if(!empty($parentId)){
            $folders = $folders->where('parent_id', $parentId);
        }else{
            $folders = $folders->where(function ($query) {
                $query->whereNull('parent_id')->orWhere('parent_id', '=', 0);
            });
        }

        if ($request->deafult_ordering_table_length) {
            $deafult_ordering_table_length = $request->deafult_ordering_table_length;
        } else {
            $deafult_ordering_table_length = 20;
        }

        $page_appends['order'] = $order;
        $page_appends['dir'] = $dir;
        $page_appends['deafult_ordering_table_length'] = $deafult_ordering_table_length;

        if ($search) {
            $terms = explode(',', $search);
            $folders = $folders->where(function ($query) use ($terms) {
                foreach ($terms as $term) {
                    $query->where('name', 'LIKE', '%'.trim($term).'%');
                }
            });

            //Tell the Paginator to append the following to the page URL as well
            $page_appends['search'] = $search;
        }

        $folders = $folders->paginate($deafult_ordering_table_length);

        $data['folders'] = $folders;
        $data['dir'] = ($dir == 'asc') ? 'desc' : 'asc';
        $data['search'] = $search;
        $data['order'] = $order;
        $data['page_appends'] = $page_appends;
        $data['deafult_ordering_table_length'] = $deafult_ordering_table_length;

        return view('cms.folders.index', $data);
    }

    public function create(Request $request){
        if ($request->isMethod('post')) {
            try {
                $validator = Validator::make($request->all(), [
                    'folder_name' => 'required'
                ]);

                if ($validator->passes()) {
                    $folderObj = new Category();
                    $folderObj->name = $request->folder_name;
                    $folderObj->parent_id = $request->parent_id;
                    $folderObj->save();
                    if(!empty($request->parent_id)){
                        return redirect()->route('admin.folders.index','parent_id='.$request->parent_id)->with('success', "Folder Created Successfully");
                    }
                    return redirect()->route('admin.folders.index')->with('success', "Folder Created Successfully");
                } else {
                    return redirect()->route('admin.folders.index')->with('error', "Provided data is invalid");
                }
            } catch (Exception $ex) {
            }
        }

        $folders = Category::whereNull('parent_id')->get();
        $selected = "";
        $options = view('cms.folders.folder_options', compact('folders', 'selected'))->render();

        return view('cms.folders.create', compact('options'));
    }

    public function loadChildFolder(Request $request){
        $formData = $request->all();
        $parentId = $formData['parent_id'];
        $folders = Category::orderBy('id', 'desc');

        if(!empty($parentId)){
            $folders = $folders->where('parent_id', $parentId);
        }else{
            $folders = $folders->where(function ($query) {
                $query->whereNull('parent_id')->orWhere('parent_id', '=', 0);
            });
        }

        $folders = $folders->pluck('name', 'id');

        if(count($folders) > 0){
            $options = view('cms.folders.options', compact('folders', 'parentId'))->render();
        }else{
            $options = "";
        }


        return response()->json(['options' => $options]);

    }

    public function edit($id, Request $request){
        $folderObj = Category::find($id);
        if ($request->isMethod('post')) {
            try {
                $validator = Validator::make($request->all(), [
                    'folder_name' => 'required'
                ]);

                if ($validator->passes()) {
                    $folderObj->name = $request->folder_name;
                    $folderObj->save();
                    if(!empty($request->parent_id)){
                        return redirect()->route('admin.folders.index','parent_id='.$request->parent_id)->with('success', "Folder Updated Successfully");
                    }
                    return redirect()->route('admin.folders.index')->with('success', "Folder Updated Successfully");
                } else {
                    return redirect()->route('admin.folders.index')->with('error', "Provided data is invalid");
                }
            } catch (Exception $ex) {
            }
        }

        $folders = Category::whereNull('parent_id')->get();
        $selected = $folderObj->parent_id;
        $options = view('cms.folders.folder_options', compact('folders', 'selected'))->render();

        return view('cms.folders.edit', compact('folderObj', 'options'));
    }

    public function delete($id, Request $request){
        try {
            $folderObj = Category::find($id);
            $parentId = $folderObj->parent_id;

            $folderObj->delete();
            if(!empty($parentId)){
                return redirect()->route('admin.folders.index','parent_id='.$parentId)->with('success', "Folder Deleted Successfully");
            }
            return redirect()->route('admin.folders.index')->with('success', "Folder Deleted Successfully");
        } catch (Exception $ex) {
        }
    }
}
