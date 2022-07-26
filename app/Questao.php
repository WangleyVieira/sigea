<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Questao extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = ['codigo_questao', 'descricao', 'nivel_dificuldade','cadastradoPorUsuario', 'alteradoPorUsuario', 'inativadoPorUsuario', 'dataInativado', 'motivoInativado', 'ativo'];

    protected $guarded = ['id', 'created_at', 'update_at'];

    protected $table = 'questaos';

    public function cadastradoPorUsuario()
    {
        return $this->belongsTo(User::class, 'cadastradoPorUsuario');
    }
}
