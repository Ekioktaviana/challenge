<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    
    protected $table = 'siswa';
    /**
     * The attributes that are mass assignable.
     *
    //  * @var array
     */
    protected $fillable = [
        'nama', 'email', 'kelas_id', 'gender',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public function kelas() {
        return $this->belongsTo('App\Kelas', 'kelas_id');
    }

    protected $hidden = [ 'created_at', 'updated_at'];
}