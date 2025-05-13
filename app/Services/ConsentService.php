<?php

namespace App\Services;

use App\Models\Consent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class ConsentService 
{
    public function answer(array $data): Consent
    {
        $consent = Consent::create([
            'user_id' => Auth::user()->id(),
            'answer' => $data['consent_answer']
        ]);

        return $consent ?: null;
    }

    public function handleRedirect($model, $action): RedirectResponse
    {
        $role = auth()->user()->getRoleNames()->first();
        $userId = auth()->id();
        $modelName = 'Consent';

        $success = $model ? true : false;
        $message = "$modelName {$action}" . ($success ? ' successfully' : ' failed');

        activity()
            ->performedOn($model)
            ->causedBy(auth()->user())
            ->log("{$modelName} {$action} by user {$userId}");

        return redirect()
            ->route("$role.consent.index")
            ->with($success ? 'success' : 'failed', $message);
    }
}