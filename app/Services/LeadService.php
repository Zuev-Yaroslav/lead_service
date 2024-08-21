<?php

namespace App\Services;

use App\Models\Lead;

class LeadService
{
    public static function getMeta() : array
    {
        $new = Lead::whereRelation('status', 'title', 'new')->count();
        $at_work = Lead::whereRelation('status', 'title', 'at_work')->count();
        $completed = Lead::whereRelation('status', 'title', 'completed')->count();
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
