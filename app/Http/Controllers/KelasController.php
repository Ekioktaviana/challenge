<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Exceptions\Handler;
use App\Kelas;

class KelasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
*/
public function store(Request $request) {

    // Memvalidasi Field Yang Masuk.
    $this->validate($request, [
        'nama' => 'required',
        'sekolah_id' => 'required',
    ]);

    $insert = Kelas::create([
        'nama' => $request->nama,
        'sekolah_id' => $request->sekolah_id,
    ]);

    $result = array(
        'message' => 'Data Kelas Berhasil di Simpan.',
        'data' => $insert
    );

    return response()->json($result);
}

public function show(Request $request) {
    $siswa = Kelas::get();
    // Inisisasi Variable
    $message = "";

    // Jika Siswa Nya Lebih Dari Kosong;
    if ($siswa->count() > 0) {
        // Set Ulang Variable $message;
        $message = "Berhasil Mengambil Data Kelas.";
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
        $siswa = Kelas::find($id);

        $result = ['message' => "Data Kelas Tidak Ditemukan"];

        if($siswa){
            $siswa->nama = $request->nama;
            $siswa->sekolah_id = $request->sekolah_id;

            $siswa->save();

            $result = array([
                'message' => 'Data Kelas Berhasil di Update',
                'data' => $siswa
            ]);

            return response()->json($result);

        }
    }


    public function delete(Request $request, $id){
        $siswa = Kelas::find($id);

        $result = ['message' => "Data Kelas Tidak Ditemukan"];

        if($siswa){
            $siswa->delete();

            $result = array([
                'message' => 'Data Berhasil di Hapus',
                'data' => $siswa
            ]);

            return response()->json($result);

        }
    }

}