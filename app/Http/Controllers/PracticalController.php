<?php

namespace App\Http\Controllers;

use App\Constants\ResStatus;
use App\Constants\StringConstant;
use App\Models\Practical;
use App\Traits\AppControllerTrait;
use Illuminate\Http\Request;

class PracticalController extends Controller
{
    use AppControllerTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Practical $practical)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Practical $practical)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Practical $practical)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Practical $practical)
    {
        Practical::where(['id' => $practical->id])->delete();
        return $this->appResponse([
            "status" => ResStatus::$Status204,
            "msg" => StringConstant::$PRACTICAL_DELETED,
            "success" => true,
        ]);
    }
}
