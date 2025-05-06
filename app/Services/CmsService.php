<?php

namespace App\Services\Cms;

use Illuminate\Database\Eloquent\Model;

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
}