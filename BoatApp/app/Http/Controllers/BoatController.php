<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBoatRequest;
use App\Http\Requests\UpdateBoatRequest;
use App\Models\Boat;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class BoatController extends Controller
{

    // VIEW ------------------------------------------------------------------------------------------------------------

    public function list()
    {
        return view('modules.boat.list', [
            'token' => Session::get('token'),
            'boats' => Boat::all(),
        ]);
    }

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
            'boat' => Boat::find($id)
        ]);
    }

    // API -------------------------------------------------------------------------------------------------------------

    public function store(StoreBoatRequest $r)
    {
        $data = $r->validated();
        $data['user_id'] = Auth::id();
        $boat = Boat::create($data);
        return response()->json(['boat' => $boat]);
    }

    public function update(UpdateBoatRequest $r, $id)
    {
        $boat = Boat::find($id);
        if ($boat === null) throw new ModelNotFoundException();
        $boatUpdate = $r->validated();

        $boat->fill($boatUpdate)->save();
        return response()->json([
            'boat' => $boat->fresh(),
        ]);
    }

    public function delete($id)
    {
        $boat = Boat::find($id);
        if ($boat === null) throw new ModelNotFoundException();
        $boat->delete();
        return response()->json([
            'boat' => $boat,
        ]);
    }
}
