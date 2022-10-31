<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use PeriodoTableSeeder;

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

    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'id_periodo');
    }

    public function topicos()
    {
        return $this->hasMany(Topico::class, 'id_disciplina', 'id')->where('ativo', '=', 1);
    }

    public function questoes()
    {
        return $this->hasMany(Questao::class, 'id_disciplina', 'id')->where('ativo', '=', 1);
    }

    public function atividades()
    {
        return $this->hasMany(Atividade::class, 'id_disciplina', 'id')->where('ativo', '=', 1);
    }

}

