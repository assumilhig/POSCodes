<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ImportAccessCodeRequest;
use App\Services\AccessCodeService;

class ImportAccessCodeController extends Controller
{
    protected $accessCodeService;

    public function __construct()
    {
        $this->accessCodeService = new AccessCodeService;
    }

    public function index()
    {
        return view('access_codes.index');
    }

    public function store(ImportAccessCodeRequest $request)
    {
        $this->accessCodeService->createAccessCodeWithType((string) $request->access_code_file);

        return to_route('access_codes.index');
    }
}
