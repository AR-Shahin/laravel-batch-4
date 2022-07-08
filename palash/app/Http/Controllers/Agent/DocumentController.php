<?php

namespace App\Http\Controllers\Agent;

use App\Models\Document;
use App\Actions\File\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class DocumentController extends Controller
{
    public function index()
    {
        return view('agent.document.index');
    }

    public function getAllData()
    {
        return Document::where('agent_id',auth('agent')->id())->latest()->get();
    }
    function store(Request $request)
    {
        $request->validate([
            "name" => ['required'],
            "description" => ['required'],
            "image" => ['required','mimes:png,jpg,docx,pdf'],
        ]);
        $document =  Document::create([
            'name' => $request->name,
            'description' => $request->description,
            'agent_id' => auth('agent')->id(),
            'image' => File::upload($request->file('image'), 'document')
        ]);
        if ($document) {
            return true;
        }
    }

    public function show(Document $document)
    {
        return $document;
    }

    public function edit(Document $document)
    {
        return $document;
    }

    public function destroy(Document $document)
    {
        $image = $document->image;
        File::deleteFile($image);
        return $document->delete();
    }
    public function update(Request $request, Document $document)
    {

        $request->validate([
            'name' => "required|unique:categories,name,{$document->id}",
        ]);

        if ($request->file('image')) {
            $request->validate([
                'image' => ['required', 'image', 'mimes:png,jpg,jpeg']
            ]);
            $olgImage = $document->image;
            $document =   $document->update([
                'name' => $request->name,
                'slug' => $request->name,
                'image' => File::upload($request->file('image'), 'do$document')
            ]);
            File::deleteFile($olgImage);
        } else {
            $document =   $document->update([
                'name' => $request->name,
                'slug' => $request->name
            ]);
        }

        if ($document) {
            return true;
        } else {
            return false;
        }
    }
}
