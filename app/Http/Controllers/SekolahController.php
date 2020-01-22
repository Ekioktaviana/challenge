<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Exceptions\Handler;
use App\Sekolah;

class SekolahController extends Controller
{
    public function store(Request $request) {

        // Memvalidasi Field Yang Masuk.
        $this->validate($request, [
            'nama' => 'required',
        ]);
    
        $insert = Sekolah::create([
            'nama' => $request->nama,
        ]);
    
        $result = array(
            'message' => 'Data Sekolah Berhasil di Simpan.',
            'data' => $insert
        );
    
        return response()->json($result);
    }

    
public function show(Request $request) {
    $siswa = Sekolah::get();
    // Inisisasi Variable
    $message = "";

    // Jika Siswa Nya Lebih Dari Kosong;
    if ($siswa->count() > 0) {
        // Set Ulang Variable $message;
        $message = "Berhasil Mengambil Data Sekolah.";
    } else {
        // Set Ulang Variable $message;
        $message = "Data Kosong.";
    }

    $result = array(
        "message" => $message,
        "data" => $siswa
    );

    return response()->json($result);
}


public function update(Request $request, $id)
    {
        $siswa = Sekolah::find($id);

        $result = ['message' => "Data Sekolah Tidak Ditemukan"];

        if($siswa){
            $siswa->nama = $request->nama;

            $siswa->save();

            $result = array([
                'message' => 'Data Sekolah Berhasil di Update',
                'data' => $siswa
            ]);

            return response()->json($result);

        }
    }

    public function delete(Request $request, $id){
        $siswa = Sekolah::find($id);

        $result = ['message' => "Data Sekolah Tidak Ditemukan"];

        if($siswa){
            $siswa->delete();

            $result = array([
                'message' => 'Data Sekolah Berhasil di Hapus',
                'data' => $siswa
            ]);

            return response()->json($result);

        }
    }
}
