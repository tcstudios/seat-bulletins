<?php

namespace TCStudios\Seat\SeatBulletins\Http\Controllers;

use Illuminate\Http\Request;
use Seat\Web\Http\Controllers\Controller;
use Seat\Web\Models\Acl\Role;
use TCStudios\Seat\SeatBulletins\Models\Bulletin;
use TCStudios\Seat\SeatBulletins\Validation\BulletinValidation;

class BulletinsController extends Controller {
    public function getAboutView() { return view("bulletins::about"); }
    public function getListView() {
        $role_ids = auth()->user()->roles()->pluck('role_id')->toArray();

        $bulletins = Bulletin::whereHas('roles', function($query) use ($role_ids) {
            $query->whereIn('role_id', $role_ids);
        })->orderBy('updated_at', 'DESC')->get();
        return view('bulletins::list', compact('bulletins', 'role_ids'));
    }
    public function getManageView() {
        $characters = auth()->user()->characters;
        $main_character_id = auth()->user()->main_character->character_id;
        $bulletins = Bulletin::all();
        $bulletins->load('roles');
        $roles = Role::all();
        return view('bulletins::manage', compact('bulletins', 'characters', 'main_character_id', 'roles'));
    }
    public function saveBulletin(BulletinValidation $request) {
        if ($request->id > 0) {
            $bulletin = Bulletin::find($request->id);
        } else {
            $bulletin = new Bulletin();
            $bulletin->author_id = auth()->user()->id;
            $bulletin->character_name = $request->character_name;
        }
        $bulletin->title = $request->title;
        $bulletin->text = $request->text;
        $bulletin->save();
        $bulletin->roles()->sync($request->roles);
        $bulletin->save();
        return redirect()->route('bulletins.manage');
    }
    public function deleteBulletin(Request $request) {
        if ($request->id > 0) {
            $bulletin = Bulletin::find($request->id);
            if ($bulletin)
                $bulletin->delete();
        }
        return redirect()->route('bulletins.manage');
    }
}