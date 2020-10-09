<?php

namespace TCStudios\Seat\SeatBulletins\Http\Controllers;

use Seat\Web\Http\Controllers\Controller;


class BulletinsController extends Controller {
    public function getAboutView() { return view("bulletins::about"); }
}