<?php

namespace FluentCrud\App\Http\Requests;

use FluentCrud\Framework\Foundation\RequestGuard;

class UserRequest extends RequestGuard
{
    public function rules()
    {
        return [];
    }

    public function messages()
    {
        return [];
    }
}
