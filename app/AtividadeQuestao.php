<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class AtividadeQuestao extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'id_atividade',
        'id_questao'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'update_at'
    ];

    protected $table = 'atividade_questaos';

    public function cad_usuario()
    {
        return $this->belongsTo(User::class, 'cadastradoPorUsuario');
    }

    public function lista_atividades()
    {
        return $this->belongsTo(Atividade::class, 'id_atividade', 'id');
    }

    public function lista_questoes()
    {
        return $this->belongsTo(Questao::class, 'id_questao', 'id');
    }
}
