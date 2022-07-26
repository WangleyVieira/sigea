<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Atividade extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = ['qtd_questao', 'descricao', 'professor', 'data', 'cadastradoPorUsuario', 'alteradoPorUsuario', 'inativadoPorUsuario', 'dataInativado', 'motivoInativado', 'ativo'];

    protected $guarded = ['id', 'created_at', 'update_at'];

    protected $table = 'atividades';

    public function cadastradoPorUsuario()
    {
        return $this->belongsTo(User::class, 'cadastradoPorUsuario');
    }
}
