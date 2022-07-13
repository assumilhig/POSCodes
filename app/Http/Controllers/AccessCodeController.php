<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\AccessType;
use App\Services\AccessCodeService;
use Illuminate\Http\Request;

class AccessCodeController extends Controller
{
    protected $access_code;

    public function __construct()
    {
        $this->access_code = new AccessCodeService;
    }

    public function issue()
    {
        $access_types = AccessType::query()->where('inactive', false)->orderBy('description')->pluck('description');

        return view('access_codes.issue', compact('access_types'));
    }

    public function store(Request $request)
    {
        $request->session()->forget(['type', 'code']);

        $access_code = $this->access_code->getAccessCodeByType($request->type);

        if (! $access_code) {
            $this->error(__('messages.pos_codes.error', ['type' => $request->type]));
        } else {
            $this->access_code->updateIssuedAccessCode($access_code->codes);

            $request->session()->put(['type' => $request->type . ' Code', 'code' => $access_code->codes]);

            $this->success(__('messages.pos_codes.success', ['type' => $request->type, 'code' => $access_code->codes]));
        }

        return to_route('access_codes.issue');
    }
}
