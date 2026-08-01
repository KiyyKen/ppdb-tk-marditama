<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftarans';

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->kode_pendaftaran)) {
                $year = date('Y');
                $random = strtoupper(substr(uniqid(), -4));
                $model->kode_pendaftaran = "PPDB-{$year}-{$random}";
            }
        });
    }

    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {
            'diterima' => '<span class="badge bg-success" style="background-color:#198754; color:white; padding:4px 8px; border-radius:12px;"><i class="ri-checkbox-circle-line me-1"></i> Diterima</span>',
            'ditolak' => '<span class="badge bg-danger" style="background-color:#dc3545; color:white; padding:4px 8px; border-radius:12px;"><i class="ri-close-circle-line me-1"></i> Ditolak</span>',
            default => '<span class="badge bg-warning text-dark" style="background-color:#ffc107; color:black; padding:4px 8px; border-radius:12px;"><i class="ri-time-line me-1"></i> Pending</span>',
        };
    }
}
