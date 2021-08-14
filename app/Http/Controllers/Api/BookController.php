<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

use App\Models\Book;
use App\Models\Author;
use App\Http\Resources\BookResource;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BookResource::collection(Book::all());
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
            'title' => 'required|unique:books',
            'text' => 'required',
        ]);
        $book = new Book;
        $book->title = $request->title;
        $book->text = $request->text;
        if ($request->authorId){
            $author = Author::find($request->authorId);
            if ($author) {
                $book->author()->associate($author);
            } else {
                return response([
                    'message' => 'Not Found'
                ], 404);
            }
        }
        $book->save();
        return response()->noContent(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        if ($book) {
            return new BookResource($book);
        }
        return response([
            'message' => 'Not Found'
        ], 404);
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
            'title' => [
                'required',
                'string',
                Rule::unique('books')->ignore($id),
            ],
            'text' => [
                'required',
                'string',
            ]
        ]);

        $book = Book::find($id);
        $newAuthor = Author::find($request->authorId);
        if ($book && $newAuthor){
            $book->title = $request->title;
            $book->text = $request->text;
            $book->author()->dissociate();
            $book->author()->associate($newAuthor);
            $book->save();
            return response()->noContent();
        }
        return response([
            'message' => 'Not Found'
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        if ($book){
            $book->delete();
            return response()->noContent();
        }
        return response([
            'message' => 'Not Found'
        ], 404);
    }
}
