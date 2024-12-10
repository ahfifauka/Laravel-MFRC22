<?php

namespace App\Http\Controllers;

use App\Models\RfidMahasiswa;
use App\Models\TmpCard;
use App\Models\TolRfidCard;
use Illuminate\Http\Request;

class RfidCardController extends Controller
{

    public function index()
    {
        return view('home');
    }

    public function getId(Request $request)
    {
        // Mengambil parameter 'rfid_tag' dari query string
        $rfidTag = $request->query('rfid_tag');
        $data = RfidMahasiswa::where('tag', $rfidTag)->first();

        if ($data) {
            TmpCard::truncate();
            TmpCard::create([
                "tag"   => $data->tag
            ]);
            return response()->json($data);
        }
        return response()->json(null);
    }

    public function showRfidData()
    {
        $tmp = TmpCard::first();
        if ($tmp) {
            $query = RfidMahasiswa::where('tag', $tmp->tag)->first();
            $data = [
                "mahasiswa" => $query->mahasiswa,
                "saldo" => number_format($query->saldo)
            ];
            return response()->json($data);
        } else {
            $data = null;
            return response()->json($data);
        }
    }

    public function truncateData()
    {
        try {
            // Menjalankan truncate untuk tabel TmpCard
            TmpCard::truncate();

            // Mengembalikan respons sukses dalam format JSON
            return response()->json(['success' => true, 'message' => 'Data truncated successfully']);
        } catch (\Exception $e) {
            // Menangani error jika terjadi kesalahan
            return response()->json(['success' => false, 'message' => 'Error truncating data: ' . $e->getMessage()]);
        }
    }
}
