<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Perfil extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'descricao',
        'ativo'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    const ADMIN = 1;
    const USUARIO_EXTERNO = 2;

    protected $table = 'perfils';

}
