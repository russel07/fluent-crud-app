<?php

namespace FluentCrud\App\Http\Controllers;
use FluentCrud\App\Models\Author;
use FluentCrud\Framework\Request\Request;


class AuthorController extends Controller
{
    public function index()
    {
        return wp_send_json(Author::where('status', 'Active')->with(['books'])->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'contact_no'    => 'required',
            'address'       => 'required',
        ]);

        $author = Author::create($request->all());

        if($author){
            return [
                'message' => 'Author created successfully'
            ];
        }else{
             throw new \ErrorException('Something went wrong, Try again later');
        }
    }

    public function show($id){
        return wp_send_json(Author::with(['books'])->find($id));
    }

    public function showByName($name){
        return wp_send_json(Author::where('first_name', 'LIKE' , "%$name%")->get());
    }

    public function update(Request $request, $id)
    {
        $update = Author::where('id', $id)->update($request->all());

        if($update){
            return [
                'message' => 'Author updated successfully'
            ];
        }else{
            throw new \ErrorException('Something went wrong, Try again later');
        }
    }

    public function destroy($id)
    {
        $author = Author::find($id);

        if($author->delete()){
            return [
                'message' => 'Author deleted successfully'
            ];
        }else{
            throw new \ErrorException('Something went wrong, Try again later');
        }
    }
}
