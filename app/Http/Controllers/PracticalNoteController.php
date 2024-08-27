<?php

namespace App\Http\Controllers;

use App\Constants\StringConstant;
use App\Models\PracticalNote;
use App\Utils\RequestHelper;
use App\Utils\ResponseHelper;
use Illuminate\Http\Request;

class PracticalNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rBody = [
            'practical_id' => "required",
            'note' => 'required',
        ];
        $validator = RequestHelper::validateRequest($request, $rBody);
        if ($validator->fails()) {
            return ResponseHelper::appResponse([
                "data" => null,
                "status" => 400,
                "error" => $validator->errors(),
                "msg" => StringConstant::$incompletePayload,
            ]);
        }
        $newNote = new PracticalNote();
        $newNote->createNote($request);

        return ResponseHelper::appResponse([
            "data" => ['id' => $newNote->id],
            "status" => 201,
            "msg" => "Practical notes created successfully",
            "success" => true,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PracticalNote $practicalNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PracticalNote $practicalNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PracticalNote $practicalNote)
    {
        //
    }
}
