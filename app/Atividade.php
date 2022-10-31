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

    // public function questaoAtividades()
    // {
    //     return $this->belongsToMany(Questao::class);
    // }

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class, 'id_disciplina', 'id');
    }
}
