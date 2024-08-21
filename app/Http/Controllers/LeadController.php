<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lead\StoreRequest;
use App\Http\Requests\Lead\UpdateRequest;
use App\Http\Requests\Lead\UpdateStatusRequest;
use App\Http\Resources\Lead\LeadResource;
use App\Http\Resources\Status\StatusResource;
use App\Models\Lead;
use App\Models\Status;
use App\Services\LeadService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $meta = LeadService::getMeta();
        $leads = LeadResource::collection(Lead::latest()->get())->additional($meta);
        $statuses = StatusResource::collection(Status::all())->resolve();
        return ($request->expectsJson())
            ? $leads
            : Inertia::render('Lead/Index', compact(['leads', 'statuses']));
    }
    public function edit(Lead $lead)
    {
        $lead = LeadResource::make($lead)->resolve();
        $statuses = StatusResource::collection(Status::all())->resolve();
        return Inertia::render('Lead/Edit', compact(['lead', 'statuses']));
    }
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $lead = Lead::create($data);
        return LeadResource::make($lead)->resolve();
    }
    public function update(Lead $lead, UpdateRequest $request)
    {
        $data = $request->validated();
        $lead->update($data);
        return LeadResource::make($lead)->resolve();
    }
    public function updateStatus(Lead $lead, UpdateStatusRequest $request)
    {
        $data = $request->validated();
        $lead->update($data);
        return LeadResource::make($lead)->resolve();
    }
    public function destroy(Lead $lead)
    {
        $lead->delete();
        return response([], Response::HTTP_NO_CONTENT);
    }
}
