<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notifikasi;

class NotifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $notifikasi = $user->notifikasi()->orderBy('created_at', 'desc')->get();

        return view('pages.pelamar.notifikasi.index', ['title' => 'Notifikasi'], compact('notifikasi'));
    }

    public function markAsRead(Request $request)
    {
        $user = auth()->user();
        $notifikasi = Notifikasi::find($request->input('notifikasi_id'));

        if ($notifikasi && $notifikasi->user_id === $user->id) {
            $notifikasi->update(['status' => true]);
        }

        return response()->json(['message' => 'Notification marked as read']);
    }

    public function markAllAsRead()
    {
        $user = auth()->user();
        $user->notifikasi->where('status', false)->each->update(['status' => true]);

        return response()->json(['message' => 'All notifications marked as read']);
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
