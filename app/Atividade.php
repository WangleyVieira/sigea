<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Atividade extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'descricao',
        'titulo_atividade',
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

    protected $table = 'atividades';

    public function cad_usuario()
    {
        return $this->belongsTo(User::class, 'cadastradoPorUsuario');
    }
    public function alt_usuario()
    {
        return $this->belongsTo(User::class, 'alteradoPorUsuario');
    }
    public function questoes()
    {
        return $this->belongsTo(Questao::class, 'id_topico', 'id');
    }

    public function temAtividade(Questao $questao)
    {
        $temSim = AtividadeQuestao::where('id_questao', '=', $this->id)
            ->where('id_atividade', '=', $questao->id)
            ->where('ativo', '=', 1)
            ->first();

        if(!$temSim){
            return false;
        }
        return true;
    }

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class, 'id_disciplina', 'id');
    }
}
