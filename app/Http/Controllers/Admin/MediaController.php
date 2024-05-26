<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Media;
use Validator;
use Str;

class MediaController extends Controller
{
    public function __construct(){
    }

    public function index(Request $request){
        $search = $request->get('search'); // Searching Keywords
        $order = $request->get('order'); // Order by what column?
        $dir = $request->get('dir'); // Order direction: asc or desc
        $parentId = $request->get('folder_id');
        $page_appends = [];
        $data = [];

        if ($order && $dir) {
            $media = Media::orderBy($order, $dir);
        } else {
            $media = Media::orderBy('id', 'desc');
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
            $media = $media->where(function ($query) use ($terms) {
                foreach ($terms as $term) {
                    $query->where('filename', 'LIKE', '%'.trim($term).'%');
                }
            });

            //Tell the Paginator to append the following to the page URL as well
            $page_appends['search'] = $search;
        }

        $media = $media->paginate($deafult_ordering_table_length);

        $data['media'] = $media;
        $data['dir'] = ($dir == 'asc') ? 'desc' : 'asc';
        $data['search'] = $search;
        $data['order'] = $order;
        $data['page_appends'] = $page_appends;
        $data['deafult_ordering_table_length'] = $deafult_ordering_table_length;

        return view('cms.media.index', $data);
    }

    public function create(Request $request){
        if ($request->isMethod('post')) {
            try {
                $validator = Validator::make($request->all(), [
                    'filename' => 'required',
                    'folder_id' => 'required',
                    'media_file' => 'required|mimes:pdf'
                ]);


                if ($validator->passes()) {

                    $destinationPath = "uploads/media";
                    $file = $request->file('media_file');
                    $mimeType = $file->getMimeType();
                    $extention = $file->getClientOriginalExtension();
                    $fileName = str_replace(" ", "_", Str::lower($request->filename)).".".$extention;

                    $file->move($destinationPath,$fileName);

                    $filePath = $destinationPath."/".$fileName;

                    $mediaObj = new Media();
                    $mediaObj->folder_id = $request->folder_id;
                    $mediaObj->filename = $request->filename;
                    $mediaObj->filepath = $filePath;
                    $mediaObj->mime_type = $mimeType;

                    $mediaObj->save();
                    return redirect()->route('admin.media.index')->with('success', "Media Added Successfully");
                } else {
                    return redirect()->back()->with('error', "Provided data is invalid");
                }
            } catch (Exception $ex) {
            }
        }

        $folders = Category::whereNull('parent_id')->get();
        $selected = "";
        $options = view('cms.folders.folder_options', compact('folders', 'selected'))->render();

        return view('cms.media.create', compact('options'));
    }

    public function edit($id, Request $request){
        $mediaObj = Media::find($id);
        if ($request->isMethod('post')) {
            try {
                $validator = Validator::make($request->all(), [
                    'filename' => 'required',
                    'folder_id' => 'required',
                    'media_file' => 'mimes:pdf'
                ]);


                if ($validator->passes()) {

                    if($request->hasFile('media_file')){

                        $destinationPath = "uploads/media";
                        $file = $request->file('media_file');
                        $mimeType = $file->getMimeType();
                        $extention = $file->getClientOriginalExtension();
                        $fileName = str_replace(" ", "_", Str::lower($request->filename)).".".$extention;

                        $file->move($destinationPath,$fileName);

                        $filePath = $destinationPath."/".$fileName;
                        $mediaObj->filepath = $filePath;
                        $mediaObj->mime_type = $mimeType;
                    }

                    $mediaObj->filename = $request->filename;
                    $mediaObj->folder_id = $request->folder_id;

                    $mediaObj->save();
                    return redirect()->route('admin.media.index')->with('success', "Media Updated Successfully");
                } else {
                    return redirect()->back()->with('error', "Provided data is invalid");
                }
            } catch (Exception $ex) {
            }
        }

        $folders = Category::whereNull('parent_id')->get();
        $selected = $mediaObj->folder_id;
        $options = view('cms.folders.folder_options', compact('folders', 'selected'))->render();

        return view('cms.media.edit', compact('mediaObj', 'options'));
    }

    public function delete($id, Request $request){
        try {
            $mediaObj = Media::find($id);
            $filePath = public_path($mediaObj->filepath);
            if(file_exists($filePath)){
                unlink($filePath);
            }
            $mediaObj->delete();
            return redirect()->route('admin.media.index')->with('success', "Media Deleted Successfully");
        } catch (Exception $ex) {
        }
    }
}
