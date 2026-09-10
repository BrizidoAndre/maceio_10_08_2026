<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    protected function casts()
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'processed_at' => 'timestamp',
        ];
    }

    public static function calcEffectiveDays($startDate, $endDate)
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $startDate);
        $endDate = Carbon::createFromFormat('Y-m-d', $endDate);
        $period = CarbonPeriod::create($startDate, $endDate);
        $holidays = PublicHoliday::query()->get()->map(function (PublicHoliday $publicHoliday) {
            return $publicHoliday->date->format('Y-m-d');
        })->toArray();
        $effectiveDays = 0;
        foreach ($period as $item) {
            if (!$item->isWeekend() && !in_array($item->format('Y-m-d'), $holidays)) {
                $effectiveDays++;
            }
        }
        return $effectiveDays;
    }

    public function showLabel()
    {
        if ($this->status !== 'approved') {
            return '';
        }
        if ($this->start_date->isBefore(now())) {
            $days = ceil($this->start_date->diffInDays(now()));
            return "Start in {$days} days";
        }
        if ($this->end_date->isBefore(now())) {
            return 'Completed on ' . $this->end_date->format('l, d F Y');
        }
        return 'Ongoing';
    }
}
