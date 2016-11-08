<?php

namespace App\Http\Controllers;

use App\Assessment;
use App\Examination;
use App\Option;
use Illuminate\Http\Request;

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

        $action = array('AssessmentController@store');

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
}
