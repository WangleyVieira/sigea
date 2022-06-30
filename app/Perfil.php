<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Perfil extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = ['descricao', 'ativo'];

    protected $guarded = ['id', 'created_at', 'update_at'];

    protected $table = 'perfils';
}
