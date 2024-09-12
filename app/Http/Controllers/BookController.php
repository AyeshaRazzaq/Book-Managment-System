<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function store(Request $request) {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'published_date' => 'required|date',
            'genre' => 'required|max:255',
            'price' => 'required|numeric',
        ]);

        $book = Book::create($validatedData);

        return response()->json([
            'message' => 'Book created successfully',
            'book' => $book,
        ]);
    }

    public function index() {
        $book = Book::all();
        return response()->json([
            'message' => 'Books retrieved successfully',
            'book' => $book,
        ]);
    }

    public function update(Request $request, $id) {

        $book = Book::findOrFail($id);

        $validateData = $request->validate([
            'title' => 'nullable|max:255',
            'author' => 'nullable|max:255',
            'published_date' => 'nullable|date',
            'genre' => 'nullable|max:255',
            'price' => 'nullable|numeric',
        ]);
        $book->update($validateData);

        return response()->json([
            'message' => 'Book Edit successfully',
            'book' => $book,
        ]);
    }

    public function delete($id) {
        $book = Book::findOrFail($id);

        $book->delete();

        return response()->json([
           'message' => 'Book deleted successfully',
            'book' => $book,
        ]);
    }
}
