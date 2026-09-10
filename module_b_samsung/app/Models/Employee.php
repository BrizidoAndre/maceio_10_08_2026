<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use SoftDeletes;

    const DELETED_AT = 'deactivated_at';

    protected function casts()
    {
        return [
            'employment_start_date' => 'date',
            'deactivated_at' => 'timestamp',
        ];
    }

    function getPhoto()
    {
        if ($this->photo_path) {
            return $this->photo_path;
        }
        return 'placeholder.png';
    }

    public function leaveRequests()
    {
        return $this->hasMany(LeaveRequest::class, 'employee_id');
    }

    public function payslips()
    {
        return $this->hasMany(Payslip::class, 'employee_id');
    }
}
