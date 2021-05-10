<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Album;

use Illuminate\Support\Facades\Config;

use Str;

use File;



class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        if($request->has('search_keyword') && $request->search_keyword != '')
        {
            $keyword = $request->search_keyword;
        }
        else
        {
            $keyword = '';
        }
        $data = Album::when($request->search_keyword, function($q) use($request){
            $q->where('title', 'like', '%'.$request->search_keyword.'%')
            ->orWhere('id', $request->search_keyword);
        })->sortable('id')->paginate(Config::get('constants.PAGINATION_NUMBER'));

        return view('admin.albums.list',compact('data','keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.albums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'album_cover' => 'image|mimes:jpeg,png,jpg',
        ]);

        try {
            $coverPhoto = '';
            if($request->hasFile('cover_photo'))
            {
                $blogPhoto = $request->file('cover_photo');

                $uploadpath = public_path().'/assets/album/images/';

                    $file = $blogPhoto;
                    $orignlname = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $slug = Str::slug($request->title);
                    $coverPhoto = $slug."-".$orignlname;
                    $image_path = $uploadpath.'/'.$coverPhoto; // Value is not URL but directory file path
                    $file->move($uploadpath, $coverPhoto);
            }
           
            
            $data =[
                'title' => $request->title,
                'album_cover' => $coverPhoto,
            ];
            $record = Album::create($data);
            if($record){
                $routes = ($request->action == 'saveadd') ? 'album.create' : 'album.list';
        		return redirect()->route($routes)->with('status', 'success')->with('message', 'Album '.Config::get('constants.SUCCESS.CREATE_DONE'));
        	}
            return redirect()
                    ->back()->with('status', 'error')
                    ->with('message', Config::get('constants.ERROR.OOPS_ERROR'));
        } catch ( \Exception $e ) {
            return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $album = Album::find($id);

        if(!$album)
            return redirect()->route('albums.list');
    	return view('admin.albums.edit',compact('album'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $postData = $request->all();
        $id = $postData['edit_record_id'];

        $request->validate([
            'title' => '',
            'cover_photo' => 'image|mimes:jpeg,png,jpg',
        ],[
            'cover_photo.mimes' => 'Choose the image jpg,jpeg or png format Only'
        ]);

        try {

            $blogPhoto = $request->cover_photo_old;
            if($request->hasFile('cover_photo'))
            {
                $uploadpath = public_path().'/assets/album/images/';
                $file = $request->file('cover_photo');
                $orignlname = $file->getClientOriginalName();
                $image_path = $uploadpath.'/'.$request->cover_photo_old; // Value is not URL but directory file path
                if(File::exists($image_path))
                {
                    File::delete($image_path);
                }
                $extension = $file->getClientOriginalExtension();
                $slug = Str::slug($request->title);
                $albumPhoto = $slug.'-'.$orignlname;
                $file->move($uploadpath, $albumPhoto);
            }
            $albums = Album::findOrFail($id);
            $albums->title = $postData['title'];
            $albums->album_cover = $albumPhoto;
            $albums->push();

            return redirect()->route('album.list')->with('status', 'success')->with('message', 'Album '.Config::get('constants.SUCCESS.UPDATE_DONE'));
        } catch ( \Exception $e ) {
            return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Album::where('id',$id)->delete();
        	return redirect()->back()->with('status', 'success')->with('message', 'Album details '.Config::get('constants.SUCCESS.DELETE_DONE'));
        }catch(Exception $ex){
            return redirect()->back()->with('status', 'error')->with('message', $ex->getMessage());
        }
    }
}
