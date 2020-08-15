<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BoatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // VIEW ------------------------------------------------------------------------------------------------------------

    public function create()
    {
        return $this->getView('create');
    }

    public function show($id)
    {
        return $this->getView('show', $id);
    }

    public function edit($id)
    {
        return $this->getView('edit', $id);
    }

    private function getView($mode, $id = null)
    {
        return view('modules.boat.boat')->with([
            'mode' => $mode,
            'id' => $id,
        ]);
    }

    // API -------------------------------------------------------------------------------------------------------------

    // TODO
    public function store()
    {

    }

    // TODO
    public function update()
    {

    }

    // TODO
    public function delete()
    {

    }
}
