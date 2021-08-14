<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Book;
use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::with('books')->paginate(10);

        return view('admin.authors.index')->with([
            'authors' => $authors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $anonBooks = Book::where('author_id', null)->pluck('title', 'id');
        return view('admin.authors.create', [
            'anonBooks' => $anonBooks,
            'ownedBooks' => []
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:authors',
            'bookIds' => 'array',
        ]);
        $author = new Author;
        $author->name = $request->name;
        $author->save();
        if (!empty($request->bookIds)){
            $books = Book::whereIn('id', $request->bookIds)->
                            where('author_id', null)->
                            get();
            $author->books()->saveMany($books);
            $author->save();
        }
        return redirect()->route('admin.authors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = Author::findOrFail($id);
        return view('admin.authors.show', [
            'author' => $author,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ownedBooks = Book::where('author_id', $id)
                ->pluck('title', 'id');
        $anonBooks = Book::where('author_id', null)
                ->pluck('title', 'id');
        return view('admin.authors.edit', [
            'ownedBooks' => $ownedBooks,
            'anonBooks' => $anonBooks,
            'author' => Author::find($id),
        ]);
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
        $validated = $request->validate([
            'name' => [
                'required',
                Rule::unique('authors')->ignore($id),
            ],
            'bookIds' => 'array',
        ]);
        $author = Author::findOrFail($id);
        $author->name = $request->name;
        $author->save();
        Book::setNull($id); //remove old relations
        if (!empty($request->bookIds)){
            $books = Book::whereIn('id', $request->bookIds)
                        ->where('author_id', null)
                        ->orWhere('author_id', $id)
                        ->get();
            
            Book::setNull($id);
            $author->books()->saveMany($books);
            $author->save();
        }
        return redirect()->route('admin.authors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Author::destroy($id);
        return redirect()->route('admin.authors.index');
    }
}
