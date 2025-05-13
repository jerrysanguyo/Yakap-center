<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class CmsService
{
    protected string $modelClass;

    public function __construct(string $modelClass)
    {
        $this->modelClass = $modelClass;
    }

    public function cmsStore(array $data): Model
    {
        $model = $this->modelClass::create($data);

        return $model ?: null;
    }

    public function cmsUpdate(array $data, $id): Model
    {
        $model = $this->cmsFindOrFail($id);
        $model->update($data);

        return $model ?: null;
    }

    public function cmsDestroy($id): bool
    {
        $model = $this->cmsFindOrFail($id);
        return $model->delete();
    }

    public function cmsFindOrFail($id): Model
    {
        return $this->modelClass::findOrFail($id);
    }

    public function handleRedirect(
        mixed $modelOrBool,
        string $resource,
        string $action): RedirectResponse
    {
        $role = Auth::user()->getRoleNames()->first();
        $userId = Auth::id();

        $modelName = $modelOrBool instanceof Model
            ? ($modelOrBool->name ?? class_basename($modelOrBool))
            : ucfirst($resource);

        $success = $modelOrBool ? true : false;
        $message = "$modelName {$action}" . ($success ? ' successfully' : ' failed');

        activity()
            ->performedOn($modelOrBool instanceof Model ? $modelOrBool : null)
            ->causedBy(Auth::user())
            ->log("{$modelName} {$action} by user {$userId}");

        return redirect()
            ->route("$role.$resource.index")
            ->with($success ? 'success' : 'failed', $message);
    }
}