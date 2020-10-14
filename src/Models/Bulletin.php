<?php

namespace TCStudios\Seat\SeatBulletins\Models;

use Illuminate\Database\Eloquent\Model;
use Seat\Web\Models\Acl\Role;

class Bulletin extends Model {
    protected $table = 'seat_bulletin';
    protected $fillable = ['id', 'author_id', 'character_name', 'title', 'text', 'role_id'];

    public function roles() {
        return $this->belongsToMany(Role::class, 'seat_bulletin_role', 'bulletin_id', 'role_id');
    }
}