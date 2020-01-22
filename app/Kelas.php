<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    
    protected $table = 'kelas';
    /**
     * The attributes that are mass assignable.
     *
    //  * @var array
     */
    protected $fillable = [
        'nama', 'sekolah_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public function sekolah() {
        return $this->belongsTo('App\Sekolah', 'sekolah_id');
    }

    public function siswa(){
        return $this->hasMany('App\Siswa', 'kelas_id');
    }
}