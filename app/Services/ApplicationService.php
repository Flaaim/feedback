<?php 

namespace App\Services;

use App\Models\Application;
use App\Events\ApplicationCreate;

class ApplicationService 
{
    public function save($request, $model)
    {
        $user = $request->user();
        $request->merge(['user_id' => $user->id]);
        $model->fill($request->only($model->getFillable()));
        $model->save();
        event(new ApplicationCreate($model));
    }
}

