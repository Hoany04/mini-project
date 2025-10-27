<?php

namespace App\Traits;

use App\Models\AccessLog;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    public static function bootLogsActivity()
    {
        // if (app()->runningInConsole()) {
        //     return;
        // }

        static::created(function ($model) {
            self::maybeCreateLog('create', $model, null, $model->getAttributes());
        });

        static::updating(function ($model) {
            $model->setRelation('oldAttributesForLog', $model->getOriginal());
        });

        static::updated(function ($model) {
            $old = $model->oldAttributesForLog ?? $model->getOriginal();
            $changed = $model->getChanges();
            if (empty($changed)) {
                return;
            }
            $oldSubset = array_intersect_key($old, $changed);
            $newSubset = array_intersect_key($model->getAttributes(), $changed);
            self::maybeCreateLog('update', $model, $oldSubset, $newSubset);
        });

        static::deleted(function ($model) {
            self::maybeCreateLog('delete', $model, $model->getOriginal(), null);
        });
    }

    protected static function maybeCreateLog(string $action, $model, $oldData = null, $newData = null)
    {
        $blacklistModels = [
            // \App\Models\AccessLog::class,
            // \App\Models\SomeSystemModel::class,
        ];
        if (in_array(get_class($model), $blacklistModels, true)) {
            return;
        }

        $sensitive = ['password', 'remember_token', 'api_token', 'secret', 'stripe_id'];

        $sanitize = function ($array) use ($sensitive) {
            if (!is_array($array)) return null;
            foreach ($sensitive as $field) {
                if (array_key_exists($field, $array)) {
                    $array[$field] = '***';
                }
            }
            return $array;
        };

        $oldSan = $sanitize($oldData);
        $newSan = $sanitize($newData);

        $userId = null;
        try {
            $userId = Auth::id();
        } catch (\Throwable $e) {
            $userId = null;
        }

        AccessLog::create([
            'user_id'    => $userId,
            'action'     => $action,
            'table_name' => $model->getTable(),
            'record_id'  => $model->getKey(),
            'old_data'   => $oldSan ? json_encode($oldSan, JSON_UNESCAPED_UNICODE) : null,
            'new_data'   => $newSan ? json_encode($newSan, JSON_UNESCAPED_UNICODE) : null,
        ]);
    }
}
