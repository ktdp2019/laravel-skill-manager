<?php

namespace App\Http\Controllers;

use App\Constants\ResStatus;
use App\Constants\StringConstant;
use App\Models\TheoryNote;
use App\Traits\AppControllerTrait;
use App\Utils\RequestHelper;
use App\Utils\ResponseHelper;
use Illuminate\Http\Request;

class TheoryNoteController extends Controller
{
    use AppControllerTrait;

    public function index($theoryId)
    {
        $allNote = TheoryNote::where(["theory_id" => $theoryId])->get();
        return ResponseHelper::appResponse([
            "data" => $allNote,
            "status" => 201,
            "msg" => "",
            "success" => true,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rBody = [
            'theory_id' => "required",
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
        $newNote = new TheoryNote();
        $newNote->createNote($request);

        return ResponseHelper::appResponse([
            "data" => ['id' => $newNote->id],
            "status" => 201,
            "msg" => "Theory notes created successfully",
            "success" => true,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(TheoryNote $theoryNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TheoryNote $theoryNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TheoryNote $theoryNote)
    {
        TheoryNote::where(['id' => $theoryNote->id])->delete();
        return $this->appResponse([
            "status" => ResStatus::$Status204,
            "msg" => StringConstant::$NOTE_DELETED,
            "success" => true,
        ]);
    }
}
