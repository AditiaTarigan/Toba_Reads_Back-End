<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;

class NotifikasiController extends Controller
{
    public function index($id_user)
    {
        return Notifikasi::where('id_user',$id_user)->get();
    }

    public function baca($id)
    {
        $notif = Notifikasi::findOrFail($id);
        $notif->status = 'dibaca';
        $notif->save();

        return $notif;
    }
}
