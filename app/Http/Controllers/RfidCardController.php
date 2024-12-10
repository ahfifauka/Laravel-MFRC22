<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RfidCardController extends Controller
{
    public function getId(Request $request)
    {
        // Mengambil parameter 'rfid_tag' dari query string
        $rfidTag = $request->query('rfid_tag');

        // Debugging: Tampilkan UID yang diterima
        return response()->json(['rfid_tag' => $rfidTag]);
    }
}
