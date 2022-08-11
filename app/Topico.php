<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Topico extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'descricao',
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
}
