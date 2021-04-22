<?php

namespace App\Helpers;
use Auth;
use App\Role;


class Helper
{

    /**
     * This function returns all possible email status
     * @return array
     */
    public function getStatuses()
    {
        return [
            'Posted','Sent','Failed'
        ];
    }
}

