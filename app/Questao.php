<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Questao extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'codigo_questao',
        'descricao',
        'nivel_dificuldade',
        'id_topico',
        'id_disciplina',
        'titulo_questao',
        'id_atividade',
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

    protected $table = 'questaos';

    public function cad_usuario()
    {
        return $this->belongsTo(User::class, 'cadastradoPorUsuario');
    }

    public function alteradoPorUsuario()
    {
        return $this->belongsTo(User::class, 'alteradoPorUsuario');
    }

    public function topico()
    {
        return $this->belongsTo(Topico::class, 'id_topico', 'id');
    }

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class, 'id_disciplina', 'id');
    }

    public function atividades()
    {
        return $this->belongsTo(Atividade::class, 'id_atividade');
    }
}
