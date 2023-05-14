<?php


namespace App\Entity;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public static function boot(): void
    {
        parent::boot();

        static::updating(function ($model) {
            $model->updated_at = Carbon::now();
        });

        static::saving(function ($model) {
            $model->updated_at = Carbon::now();
        });
    }

}
