<?php

namespace App\Http\Controllers;

use App\Http\Requests\Author\AuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        $authors = Author::all();
        if (!$request->ajax()) return view('authors.index', compact('authors'));
        return response()->json(['authors' => $authors], 200);
    }

    public function create()
    {

        //
    }

    public function store(AuthorRequest $request)
    {
        $author = Author::create($request->all());
        if (!$request->ajax()) return back()->with('success', 'Author created');
        return response()->json(['status' => 'Author created', 'author' => $author], 201);
    }

    public function show(Request $request, Author $author)
    {
        if (!$request->ajax()) return view('authors.show', compact('author'));
        return response()->json(['author' => $author], 200);
    }

    public function edit(Author $author)
    {
        //
    }

    public function update(AuthorRequest $request, Author $author)
    {
        $author->update($request->all());
        if (!$request->ajax()) return back()->with('success', 'Author updated');
        return response()->json(['status' => 'Author updated', 'author' => $author], 200);
    }

    public function destroy(Request $request, Author $author)
    {
        $author->delete();
        if (!$request->ajax()) return back()->with('success', 'Author deleted');
        return response()->json([], 204);
    }
}
