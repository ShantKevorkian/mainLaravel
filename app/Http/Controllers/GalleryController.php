<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function create()
    {
        return view('createGallery');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jfif,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
        ]);
        Gallery::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
        ]);

        foreach ($request->file('image') as $image) {
            $path = $image->store('galleryImages', 'public');
            GalleryImage::create([
                'gallery_id' => DB::table('galleries')->orderBy('id', 'desc')->first()->id,
                'original_name' => $image->getClientOriginalName(),
                'path' => $path,
            ]);
        }
        return redirect()->route("profile.index", $path);
    }

    public function show(Gallery $gallery)
    {
        return view('showGallery')->with('gallery',$gallery->load('galleryImages'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jfif,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
        ]);

        Gallery::where('id',$gallery->id)->update([
            'title' => $request->title,
        ]);

        foreach ($request->file('image') as $image) {
            $path = $image->store('galleryImages', 'public');
            GalleryImage::create([
                'gallery_id' => DB::table('galleries')->orderBy('id', 'desc')->first()->id,
                'original_name' => $image->getClientOriginalName(),
                'path' => $path,
            ]);
        }
        return redirect()->route("gallery.show",$gallery->id);
    }

    public function deleteImage(Gallery $gallery, $id)
    {
        $ImageBuilder = GalleryImage::where('id',$id);
        Storage::delete($ImageBuilder->first()->path);
        $ImageBuilder->delete();
        return redirect()->route("gallery.show",$gallery->id);
    }

    public function destroy(Gallery $gallery)
    {
        Storage::delete(GalleryImage::where('gallery_id',$gallery->id)->pluck('path')->toArray());
        GalleryImage::where('gallery_id',$gallery->id)->delete();
        Gallery::where('id',$gallery->id)->delete();
        return redirect()->route("profile.index");
    }
}
