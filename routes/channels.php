<?php

use App\Entity\User;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('stations.{station}', function (User $user, int $stationNumber) {
    return $user->exists && \App\Entity\Station::findOrFail($stationNumber)->exists();
});

Broadcast::channel('stations', function () {
    return true;
});
