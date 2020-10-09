<?php

namespace TCStudios\Seat\SeatBulletins\Http\Controllers;


class BulletinsController extends Controller {
    public function getAboutView() { return view("bulletins::about"); }
}