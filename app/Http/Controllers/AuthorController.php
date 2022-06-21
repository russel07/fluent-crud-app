<?php

namespace FluentCrud\App\Http\Controllers;
use FluentCrud\App\Models\Author;
use FluentCrud\Framework\Request\Request;


class AuthorController extends Controller
{
    public function index()
    {
        return wp_send_json(Author::where('status', 'Active')->get());
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show(Author $author)
    {

    }

    public function edit()
    {

    }

    public function update(Author $author)
    {

    }

    public function destroy(Author $author)
    {

    }
}
