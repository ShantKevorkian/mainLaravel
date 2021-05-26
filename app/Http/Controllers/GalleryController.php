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
        return view('gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jfif,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
        ]);
        $gallery = Gallery::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
        ]);
        foreach ($request->file('image') as $image) {
            $path = $image->store('galleryImages', 'public');
            GalleryImage::create([
                'gallery_id' => $gallery->id,
                'original_name' => $image->getClientOriginalName(),
                'path' => $path,
            ]);
        }
        return redirect()->route("profile.index", $path);
    }

    public function show(Gallery $gallery)
    {
        return view('gallery.show')
            ->with('gallery',$gallery->load('galleryImages'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jfif,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
        ]);

        $gallery->update([
            'title' => $request->title,
        ]);

        foreach ($request->file('image') as $image) {
            $path = $image->store('galleryImages', 'public');
            GalleryImage::create([
                'gallery_id' => $gallery->id,
                'original_name' => $image->getClientOriginalName(),
                'path' => $path,
            ]);
        }
        return redirect()->route("gallery.show",$gallery->id);
    }

    public function deleteImage(Gallery $gallery, $id)
    {
        $image = GalleryImage::where('id',$id)->first();
        Storage::delete($image->path);
        $image->delete();
        return redirect()->route("gallery.show",$gallery->id);
    }

    public function destroy(Gallery $gallery)
    {
        Storage::delete($gallery->galleryImages()->pluck('path')->toArray());
        $gallery->galleryImages()->delete();
        $gallery->delete();
        return redirect()->route("profile.index");
    }
}
