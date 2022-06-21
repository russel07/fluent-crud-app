<?php

namespace FluentCrud\App\Models;

use FluentCrud\Framework\Database\Orm\Model as BaseModel;

class Model extends BaseModel
{
    protected $guarded = ['id', 'ID'];
}