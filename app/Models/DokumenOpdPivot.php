<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DokumenOpdPivot extends Pivot
{
    protected $table = 'dokumen_opd';

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
    ];
}