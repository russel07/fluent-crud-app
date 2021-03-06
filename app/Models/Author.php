<?php

namespace FluentCrud\App\Models;
use FluentCrud\App\Models\Model;

class Author extends Model
{
    protected $table = 'fluent_crud_authors';
    protected $appends = ['full_name'];

    public function getFullNameAttribute() {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    public function books()
    {
        $class = __NAMESPACE__ . '\Book';

        return $this->hasMany(
            $class, 'author_id', 'id'
        );
    }
}
