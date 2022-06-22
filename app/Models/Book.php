<?php

namespace FluentCrud\App\Models;
use FluentCrud\App\Models\Model;

class Book extends Model
{
    protected $table = 'fluent_crud_books';

    public function author()
    {
        $class = __NAMESPACE__ . '\Author';

        return $this->belongsTo(
            $class, 'author_id', 'id'
        );
    }
}
