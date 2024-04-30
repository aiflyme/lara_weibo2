<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        echo 'index';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:140',
        ]);

        $status = Auth::user()->statuses()->create([
            'content' => $request->content,
        ]);

        session()->flash('success', 'You post the new weibo!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Status $status)
    {
        echo 'show';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Status $status)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Status $status)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Status $status)
    {
        $this->authorize('destroy',$status);
        $status->delete();

        session()->flash('success', 'delete the weibo success');
        return redirect()->back();
    }
}
