<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;

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
        return view('admin.post.create');
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

        // scorciatoia inserimento campi, necessita l'inserimento del fillable in Model
        $newPost->fill($data);

        // salvataggio e invio a db
        $newPost->save();

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
            
            $data = [
                'post' => $post
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

        $request->validate([
            'title' => 'required|unique:posts|max:80',
            'content' => 'required'
        ]);
        
        // $post->slug = Str::slug($data['title']);
        $post->update($data);

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
        $post->delete();

        return redirect()->route('post.index')->with('status', 'Articolo eliminato');
    }
}
