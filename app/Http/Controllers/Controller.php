<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Traits\AuthorizationChecker;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, AuthorizationChecker;

    public function setcode($nomor,$leftcode,$lengthcode)
    {
        $code = $leftcode . str_pad((string)$nomor, $lengthcode, '0', STR_PAD_LEFT);
        return $code;
    }
}
