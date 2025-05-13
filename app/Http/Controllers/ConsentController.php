<?php

namespace App\Http\Controllers;

use App\Models\Consent;
use App\Http\Requests\ConsentRequest;
use App\Services\ConsentService;

class ConsentController extends Controller
{
    protected $consentService;

    public function __construct(ConsentService $consentService)
    {
        $this->consentService = $consentService;
    }

    public function index()
    {
        //
    }

    public function store(ConsentRequest $request)
    {
        $answer = $this->consentService->answer($request->validated());

        return $this->consentService->handleRedirect($answer, 'answered');
    }
}
