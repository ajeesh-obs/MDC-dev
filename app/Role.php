<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Role extends Model {

    use Sortable;

    protected $table = 'roles';
    protected $fillable = [
        'name', 'is_service_provider'
    ];
    public $sortable = ['name'];

}
