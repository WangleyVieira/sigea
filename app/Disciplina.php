<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Disciplina extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = ['periodo', 'ementa', 'carga_horaria', 'cadastradoPorUsuario', 'alteradoPorUsuario', 'inativadoPorUsuario', 'dataInativado', 'motivoInativado', 'ativo'];

    protected $guarded = ['id', 'created_at', 'update_at'];

    protected $table = 'disciplinas';

    public function cadastradoPorUsuario()
    {
        return $this->belongsTo(User::class, 'cadastradoPorUsuario');
    }
}

