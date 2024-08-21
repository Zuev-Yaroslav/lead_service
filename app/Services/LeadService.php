<?php

namespace App\Services;

use App\Models\Lead;

class LeadService
{
    public static function getMeta() : array
    {
        $new = Lead::where('status_id', 1)->count();
        $at_work = Lead::where('status_id', 2)->count();
        $completed = Lead::where('status_id', 3)->count();
        $meta = ['meta' => [
            'total_quantity' => Lead::count(),
            'quantity' => [
                'new' => $new,
                'at_work' => $at_work,
                'completed' => $completed
            ]
        ]];
        return $meta;
    }
}
