<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Question;
use Carbon\Carbon;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = DB::table('questions')
                    ->where('archived', false)
                    ->where('type', 1)
                    ->orderBy('order', 'asc')
                    ->get();

        $speakers = DB::table('questions')
                    ->where('archived', false)
                    ->where('type', 0)
                    ->orderBy('order', 'asc')
                    ->get();

        return view('admin.questions.index')->with([
            'sessions' => $sessions,
            'speakers' => $speakers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $count = DB::table('questions')->count();
        return view('admin.questions.create')->with('total', $count);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer_type' => 'required',
            'type' => 'required',
            // 'required' => 'required',
            'total' => 'required',
        ]);

        $colname = "";
        $target = "";

        if ($request->type == 1) {
            // Session
            $colname = sprintf("%s%'04d", "TR", $request->total + 1);
            $target = "responsetracks";
        } else {
            // Speaker
            $colname = sprintf("%s%'04d", "SP", $request->total + 1);
            $target = "responsespeakers";
        }

        if ($request->answer_type == 3) {
            Schema::table($target, function (Blueprint $table) use ($colname) {
                $table->integer($colname)->nullable();
            });
        } else if ($request->answer_type == 2) {
            Schema::table($target, function (Blueprint $table) use ($colname) {
                $table->longText($colname)->nullable();
            });
        } else {
            Schema::table($target, function (Blueprint $table) use ($colname) {
                $table->string($colname)->nullable();
            });
        }

        $question = new Question;
        $question->colname = $colname;
        $question->question = $request->question;
        $question->type = $request->type;
        $question->order = $request->total;
        // $question->required = $request->required;
        $question->required = 1;
        $question->answer_type = $request->answer_type;
        $question->created_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $question->updated_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $question->save();

        return redirect()->route('admin.questions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $total = DB::table('questions')->count();
        $question = Question::find($id);
        return view('admin.questions.edit')->with([
            'question' => $question,
            'total' => $total
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required',
            // 'answer_type' => 'required',
            // 'required' => 'required',
            'total' => 'required',
        ]);

        $question = Question::find($id);
        $question->question = $request->question;
        // $question->order = $request->total;
        // $question->required = $request->required;
        // $question->answer_type = $request->answer_type;
        $question->updated_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $question->save();

        return redirect()->route('admin.questions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::find($id);
        $question->archived = true;
        $question->save();

        return redirect()->route('admin.questions.index');
    }
}
