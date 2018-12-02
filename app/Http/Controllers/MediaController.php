<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Media;
use Illuminate\Support\Facades\DB;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = DB::table('articles')
                    // ->where('articles.category', '=', 'article')
                    ->get();

        foreach($articles as $article){
            $article->media = DB::table('media')
                                ->where('media.article_id', '=', $article->article_id)
                                ->get();
        }
        return view('admin.media.index')->with(['articles'=> $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.articles.create');
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
            // 'event_id' => 'required|max:255',
            // 'section' => 'required|max:255',
            // 'filename' => 'required|max:255',
        ]);

       $event = DB::table('events')
                ->where('event_id', '=', $request->event_id)
                ->first();

       $files = $request->file('media');

       // dd($files);
       if($request->hasFile('media')) {
            foreach ($files as $file) {
                $path = $file->store(
                    '/public/'.$event->event_id
                );
                $media = new Media;
                $media->section = $request->section;
                $media->filename = $request->filename;
                $media->path = substr($path, 7);
                $media->event_id = $event->event_id;
                $media->save();
            }
        }

        return redirect()->route('admin.media.show', $event->event_id);
        // return redirect()->route('admin.articles.show', $article->article_id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = DB::table('events')
                    ->where('events.event_id', '=', $id)
                    ->first();

        $media = DB::table('media')
                    ->where('media.event_id', '=', $event->event_id)
                    ->get();

        return view('admin.media.show')
                    ->with(['event' => $event, 'media' => $media]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = DB::table('articles')
                    ->where('articles.article_id', '=', $id)
                    ->first();

        $media = DB::table('media')
                    ->where('media.article_id', '=', $article->article_id)
                    ->get();

        return view('admin.articles.edit')
                    ->with(['article' => $article, 'media' => $media]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $article = Article::find($id);

        $article->title = $request->input('title');
        $article->body = $request->input('body');
        $article->save();

        return redirect()->route('admin.articles.show', $article->article_id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $media = DB::table('media')->where('media_id', $id);
        $media->delete();

        return redirect()->route('admin.events.index');
    }
}
