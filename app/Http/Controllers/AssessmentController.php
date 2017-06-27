<?php

namespace App\Http\Controllers;

use App\Assessment;
use App\Examination;
use App\Item;
use App\Mail\AssessmentFinished;
use App\Option;
use App\Technique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $examinationId
     * @return \Illuminate\Http\Response
     */
    public function create($examinationId)
    {
        $assessment = new Assessment;
        $examination = Examination::find($examinationId);
        $options = Option::all();

        $action = array('AssessmentController@mail');

        return response()
            ->view('assessment.edit',
                [
                    'assessment' => $assessment,
                    'action' => $action,
                    'method' => 'POST',
                    'examination' => $examination,
                    'options' => $options,
                ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function mail(Request $request)
    {
        $username = $request->get('name');
        $email = $request->get('email');
        $itemsValue = $request->get('items');
        $itemTechniquesValue = $request->get('item-techniques');
        $itemComments = $request->get('item-comments');
        $generalComments = $request->get('general-comments');

        $items = Item::whereIn('id', array_keys($itemsValue))->pluck('name', 'id');
        $options = Option::all()->pluck('name', 'id');
        if ($itemTechniquesValue) {
            $techniques = Technique::whereIn('item_id', array_keys($itemTechniquesValue))->get()->pluck('name', 'id');
        }
        $itemOptions = [];
        foreach ($items as $id => $name) {
            $itemOptions[$id] = [];
            $itemOptions[$id]['name'] = $name;
            $itemOptions[$id]['value'] = $options[$itemsValue[$id]];
            $itemOptions[$id]['comments'] = $itemComments[$id];
        }
        if ($itemTechniquesValue) {
            foreach ($itemTechniquesValue as $itemId => $techniqueValue) {
                $techniqueNames = [];
                foreach ($techniqueValue as $technique => $required) {
                    $techniqueNames[] = $techniques[$technique];
                }
                $itemOptions[$itemId]['technique'] = $techniqueNames;
            }
        }
        try {
            Mail::to($email)
                ->send(new AssessmentFinished($itemOptions, $username, $generalComments));

            if (count(Mail::failures()) > 0) {
                return response()->json(['success'=>0]);
            } else {
                return response()->json(['success'=>1]);
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            return response()->json(['success'=>0]);
        }

    }
}
