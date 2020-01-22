<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Exceptions\Handler;
use App\Siswa;
use App\Kelas;
use App\Sekolah;

class SiswaController extends Controller
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
            'email' => 'required|email|unique:siswa',
            'kelas_id' => 'required',
            'gender' => 'required',
        ]);

        $insert = Siswa::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'kelas_id' => $request->kelas_id,
            'gender' => $request->gender,
        ]);

        $result = array(
            'message' => 'Data Siswa Berhasil di Simpan.',
            'data' => $insert
        );

        return response()->json($result);
    }


    public function show(Request $request) {
        $siswa = Siswa::get();
        // Inisisasi Variable
        $message = "";

        // Jika Siswa Nya Lebih Dari Kosong;
        if ($siswa->count() > 0) {
            // Set Ulang Variable $message;
            $message = "Berhasil Mengambil Data Siswa.";
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
        $siswa = Siswa::find($id);

        $result = ['message' => "Data Tidak Ditemukan"];

        if($siswa){
            $siswa->nama = $request->nama;
            $siswa->email = $request->email;
            $siswa->kelas_id = $request->kelas_id;
            $siswa->gender = $request->gender;

            $siswa->save();

            $result = array([
                'message' => 'Data Berhasil di Update',
                'data' => $siswa
            ]);

            return response()->json($result);

        }
    }



    public function delete(Request $request, $id){
        $siswa = Siswa::find($id);

        $result = ['message' => "Data Tidak Ditemukan"];

        if($siswa){
            $siswa->delete();

            $result = array([
                'message' => 'Data Berhasil di Hapus',
                'data' => $siswa
            ]);

            return response()->json($result);

        }
    }



    public function showByRombel(Request $request, $kelas_id){
        $kelas = Kelas::find($kelas_id);
        $siswa = Siswa::where('kelas_id',$kelas_id)->get();

        $data = [];
        $data = $kelas;
        $data['siswa'] = $siswa;
        $result = ['message' => "Data Tidak Ditemukan"];

        if($siswa){
            $result = array([
                'message' => 'Berhasil Mengambil data siswa berdasarkan rombel',
                'data' => $data,
            ]);

            return response()->json($result);

        }
        
        return response()->json($result);

    }


    public function showBySekolah(Request $request, $sekolah_id)
    {
        $kelas = Kelas::where('sekolah_id', $sekolah_id)->get();
        $kelasId = $kelas->pluck('id');  // [1,2,3,4]
        $siswa = Siswa::whereIn('kelas_id', $kelasId)->get();

        $result = array(
            'message' => 'Data Berhasil di Tampilkan.',
            'data' => $siswa
        );
        return response()->json($result);
    
    //     $sekolah = Sekolah::find($sekolah_id);
    //     $kelas = Kelas::where('sekolah_id', $sekolah_id)->get();

    //     $data = [];
    //     foreach ($kelas as $key) {
    //         $siswa = Siswa::where('kelas_id', $key['id'])->get();

    //             foreach ($siswa as $keys) {
    //                 $data[] = $keys;
    //             }
    //     }

    //     $result = ["message" => "data tidak ditemukan"];
    //         if ($siswa){
    //             $result = array(
    //                 "message" => "data ditemukan",
    //                 "data" => $data
    //             );
    //             return response()->json($result);
    //         }
    // return response()->json($result);
    }



    public function sortirKelas(Request $request, $sekolah_id)
    {
        $sekolah = Sekolah::with(['kelas' => function($q){ $q->with('siswa'); }])->find($sekolah_id);
        $kelas = Kelas::with(['siswa'])->where('sekolah_id', $sekolah_id)->get();
        $result = array(
            'message' => 'Data Berhasil di Tampilkan.',
            'data' => $sekolah
        );
        return response()->json($result);


    //     $sekolah = Sekolah::find($sekolah_id);
    //     $kelas = Kelas::where('sekolah_id', $sekolah_id)->get();

    //     $data = [];
    //     // $data = $sekolah;
    //     // $data[] = $kelas;

    //     foreach ($kelas as $class) {
    //         $siswa = Siswa::where('kelas_id', $class['id'])->get();
    //         $data[] = $siswa;
    //     }

    //     $result = ["message" => "data tidak ditemukan"];
    //         if ($siswa){
    //             $result = array(
    //                 "message" => "data ditemukan",
    //                 "data" => $data
    //             );
    //             return response()->json($result);
    //         }
    // return response()->json($result);
    }

    public function belajarArray() {
        $lemari = [
            'kunci 1' => 1,
            'kunci 2' => 2,
        ];
        $array = [1,2,3,4];
        $object = array('kunci' => 'isi', 'kunci2' => 'isi2');
        // unset($object['kunci2']);
        // // array_splice($lemari, 1, 2, 10);
        // // array_shift($lemari);
        // // array_unshift($lemari, 10);
        // $jumlah = array_($lemari);
        $result = array(
            'array' => $array,
            'object' => $object
        );
        return response()->json($result);
    }
}

