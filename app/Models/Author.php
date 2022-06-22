<?php

namespace FluentCrud\App\Models;
use FluentCrud\App\Models\Model;

class Author extends Model
{
    protected $table = 'fluent_crud_authors';

    public function books()
    {
        $class = __NAMESPACE__ . '\Book';

        return $this->hasMany(
            $class, 'author_id', 'id'
        );
    }
}
