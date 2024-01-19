<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeselGenderRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Routing\Redirector;

class PeselFormController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function validateForm(PeselGenderRequest $request): Redirector|Application|RedirectResponse
    {
        $request->validated();

        return back()->withInput()->with('status', 'OK');

    }
}
