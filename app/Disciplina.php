<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Disciplina extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'nome',
        'codigo',
        'id_periodo',
        'cadastradoPorUsuario',
        'alteradoPorUsuario',
        'inativadoPorUsuario',
        'dataInativado',
        'motivoInativado',
        'ativo'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'update_at'
    ];

    protected $table = 'disciplinas';

    public function cadastradoPorUsuario()
    {
        return $this->belongsTo(User::class, 'cadastradoPorUsuario');
    }
}

