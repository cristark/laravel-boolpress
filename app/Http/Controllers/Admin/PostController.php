<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        $data = ['posts' => $posts];

        return view('admin.post.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();

        $data = ['tags' => $tags];
        
        return view('admin.post.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // richiesta nuovi dati
        $data = $request->all();

        // Richiamo id utente
        $idUser = Auth::id();

        // form validation
        $request->validate([
            'title' => 'required|unique:posts|max:80',
            'content' => 'required'
        ]);

        // nuova istanza
        $newPost = new Post();

        // Inserisco l'id utente nell'istanza
        $newPost->user_id = $idUser;

        // Creo lo slug dal title del form
        $newPost->slug = Str::slug($data['title']);
        
        // Costruzione percorso immagine
        $coverPath = Storage::put('img', $data['cover']);
        // Associo percorso a campo nella tabella
        $data['cover'] = $coverPath;

        // scorciatoia inserimento campi, necessita l'inserimento del fillable in Model
        $newPost->fill($data);

        // salvataggio e invio a db
        $newPost->save();

        if (array_key_exists('tags', $data)) {
            $newPost->tags()->sync($data['tags']);
        }

        // redirect
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if($post) {
            
            $data = [
                'post' => $post
            ];

            return view('admin.post.show', $data);
        }

        abort('404');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if($post) {

            $tags = Tag::all();
            
            $data = [
                'post' => $post,
                'tags' => $tags
            ];

            return view('admin.post.edit', $data);
        }

        abort('404');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->all();

        // $request->validate([
        //     'title' => 'required|unique:posts|max:80',
        //     'content' => 'required'
        // ]);

        if (array_key_exists('image', $data)) {
            // Sostituzione immagine
            $coverPath = Storage::put('img', $data['cover']);
            $data['cover'] = $coverPath;
        }

        if ($data['title'] != $post->title) {
            // Aggiorno slug se il titolo cambia
            $slug = Str::slug($data['title']);
            $data['slug'] = $slug;
        }

        $post->update($data);

        if (array_key_exists('tags', $data)) {
            $post->tags()->sync($data['tags']);
        }

        return redirect()->route('post.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->tags()->sync([]);
        $post->delete();

        return redirect()->route('post.index')->with('status', 'Articolo eliminato');
    }
}
