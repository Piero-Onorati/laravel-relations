<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Category;
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
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validazione dati
        $request->validate([
            'title'=>'required|max:100',
            'content'=>'required',
            'category_id'=> 'nullable|exists:categories,id'
        ]);
        
        
        $data =$request->all();
        $new_post = new Post();

        // Calcolo lo slug
        $slug = Str::slug($data['title'], '-');

        // salvo lo slug in una variabile temporanea
        $slug_base = $slug;

        // verifico se lo slug è gia presente
        $slug_ismatching= Post::where('slug', $slug)->first();
        
        // dichiaro una variabile contatore
        $counter=1;

        // fintanto che lo slug è già presente($slug_ismatching == true)...//
        while ($slug_ismatching) {

            // aggiungo allo slug di un trattino e il contatore
            $slug = $slug_base.'-'.$counter;

            // verifico nuovamente se lo slug è gia presente
            $slug_ismatching= Post::where('slug', $slug)->first();

            // Incremento il contatore
            $counter++;
        }

        // $new_post->slug= Str::slug( $data['title'], '-');

        $new_post->slug= $slug;

        $new_post->fill($data);

        $new_post->save();

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $post= Post::find($id);
        return view('admin.posts.edit', compact('post','categories'));
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
        // Validazione dati
        $request->validate([
            'title'=>'required|max:100',
            'content'=>'required',
            'category_id'=> 'nullable|exists:categories,id'
        ]);
        
        $data = $request->all();

        if ($data['title'] != $post->title ) {

            // Calcolo lo slug
            $slug = Str::slug($data['title'], '-');

            // salvo lo slug in una variabile temporanea
            $slug_base = $slug;

            // verifico se lo slug è gia presente
            $slug_ismatching= Post::where('slug', $slug)->first();
            
            // dichiaro una variabile contatore
            $counter=1;

            // fintanto che lo slug è già presente($slug_ismatching == true)...//
            while ($slug_ismatching) {

                // aggiungo allo slug di un trattino e il contatore
                $slug = $slug_base.'-'.$counter;

                // verifico nuovamente se lo slug è gia presente
                $slug_ismatching= Post::where('slug', $slug)->first();

                // Incremento il contatore
                $counter++;
            }

            //in ogni caso assegniamo allo slug il valore ottenuto
            $data['slug'] =$slug;
        }

        $post->update($data);
        return redirect()->route('admin.posts.index')->with('edit','Post n. ' . $post->id . ' has been updated.');
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
        return redirect()->route('admin.posts.index')->with('delete','Post n. ' . $post->id . ' has been deleted.');
    }
}
