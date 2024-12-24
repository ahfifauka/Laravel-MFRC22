<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\TmpCard;
use App\Models\TolRfidCard;
use App\Models\Transaksi;
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
        $member = Member::where('tag', $rfidTag)->first();
        $transaksi = Transaksi::where('tag', $rfidTag)->first();

        if ($transaksi) {
            // update jam_keluar when second tapping
            $transaksi->jam_keluar = date('H:i:s');
            $transaksi->save();
            // potong saldo sesuai dengan tarif
            $member->saldo = $member->saldo - 500;
            $member->save();
        } else {
            // first Tapping
            Transaksi::create([
                "tag"   => $rfidTag,
                "jam_masuk" => date('H:i:s')
            ]);
        }

        return response()->json("sukses");
    }

    public function showRfidData()
    {
        $tmp = TmpCard::first();
        if ($tmp) {
            $query = Member::where('tag', $tmp->tag)->first();
            $data = [
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
