<?php

namespace App\Http\Controllers;

use App\Constants\ResStatus;
use App\Constants\StringConstant;
use App\Models\Theory;
use App\Traits\AppControllerTrait;
use Illuminate\Http\Request;

class TheoryController extends Controller
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
    public function show(Theory $theory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Theory $theory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Theory $theory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Theory $theory)
    {
        Theory::where(['id' => $theory->id])->delete();
        return $this->appResponse([
            "status" => ResStatus::$Status204,
            "msg" => StringConstant::$THOEORY_DELETED,
            "success" => true,
        ]);
    }
}
