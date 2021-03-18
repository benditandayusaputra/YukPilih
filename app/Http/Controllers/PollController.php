<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\Choice;
use Illuminate\Http\Request;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polls = Poll::all();
        return view('poll.index', compact('polls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'date'          => 'required',
            'time'          => 'required',
            'title'         => 'required',
            'description'   => 'required'
        ]);

        $date = explode('/', $request->date);
        $deadline = $date[0].' '.$request->time.':'.'00';

        $data = array_merge($request->only('title', 'description'), ['deadline' => $deadline], ['created_by' => 1]);
        Poll::create($data);

        return redirect()->back()->with('success', 'Polling Berhasil di Tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function show(Poll $poll)
    {
        $choices = Choice::where('poll_id', $poll->id)->get();

        return view('poll.show', compact('poll', 'choices'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function edit(Poll $poll)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poll $poll)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poll $poll)
    {
        Poll::destroy($poll->id);

        return redirect()->back()->with('success', 'Polling Berhasil di Hapus');
    }
}
