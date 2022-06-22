<?php

namespace FluentCrud\App\Http\Controllers;

use FluentCrud\App\Models\Book;
use FluentCrud\Framework\Request\Request;

class BookController
{
    public function index()
    {
        return wp_send_json(Book::where('status', 'Active')->with(['author'])->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'author_id'=> 'required',
            'book_title'=> 'required',
            'book_type'=> 'required',
            'book_description'=> 'required'
        ]);

        $book = Book::create($request->all());

        if($book){
            return [
                'message' => 'Book created successfully'
            ];
        }else{
            throw new \ErrorException('Something went wrong, Try again later');
        }
    }

    public function show($id){
        $book = Book::with(['author'])->find($id);


        return wp_send_json($book);
    }

    public function update(Request $request, $id)
    {
        $update = Book::where('id', $id)->update($request->all());

        if($update){
            return [
                'message' => 'Book updated successfully'
            ];
        }else{
            throw new \ErrorException('Something went wrong, Try again later');
        }
    }

    public function destroy($id)
    {
        $book = Book::find($id);


        if($book->delete()){
            return [
                'message' => 'Book deleted successfully'
            ];
        }else{
            throw new \ErrorException('Something went wrong, Try again later');
        }
    }
}
