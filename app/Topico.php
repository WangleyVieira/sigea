<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Topico extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'descricao',
        'id_disciplina',
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

    protected $table = 'topicos';

    public function cadastradoPorUsuario()
    {
        return $this->belongsTo(User::class, 'cadastradoPorUsuario');
    }

    public function alteradoPorUsuario()
    {
        return $this->belongsTo(User::class, 'alteradoPorUsuario');
    }

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class, 'id_disciplina', 'id');
    }

    public function questoes()
    {
        return $this->hasMany(Questao::class, 'id_topico', 'id')->where('ativo', '=', 1);
    }

}
