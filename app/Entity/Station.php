<?php

namespace App\Entity;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property integer $station
 * @property string $name
 * @property integer $alert
 * @property integer $lat
 * @property integer $long
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @mixin Eloquent
 */
class Station extends BaseModel
{
//    use HasFactory;

    protected $table = 'stations';

    protected $primaryKey = 'station';

    protected $fillable = ['station', 'name', 'alert', 'lat', 'long'];
}
