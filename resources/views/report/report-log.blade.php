@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Reports Log
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="accordionExample">
                            @forelse ($logs as $key => $log)
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button {{ $key != 0 ? 'collapsed' : '' }}" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse-{{ $key }}"
                                            aria-expanded="true" aria-controls="collapse-{{ $key }}">
                                            <span>{{ $log->description }}</span> <small
                                                class="text-muted ms-2 pb-1">({{ $log->created_at->diffForHumans() }})</small>
                                        </button>
                                    </h2>
                                    <div id="collapse-{{ $key }}"
                                        class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            @if ($log->event == 'updated')
                                                <ul class="list-group">
                                                    <li class="list-group-item bg-secondary text-white">Old Report</li>
                                                    <li class="list-group-item"><strong>Ticket:</strong>
                                                        {{ $log['properties']['old']['ticket_id'] }}</li>
                                                    <li class="list-group-item"><strong>Title:</strong>
                                                        {{ $log['properties']['old']['title'] }}</li>
                                                    <li class="list-group-item"><strong>Description:</strong>
                                                        {{ $log['properties']['old']['description'] }}</li>
                                                    <li class="list-group-item"><strong>Status:</strong>
                                                        {{ $log['properties']['old']['status'] }}</li>
                                                    <li class="list-group-item bg-secondary text-white">New Report</li>
                                                    <li class="list-group-item"><strong>Ticket:</strong>
                                                        {{ $log['properties']['attributes']['ticket_id'] }}</li>
                                                    <li class="list-group-item"><strong>Title:</strong>
                                                        {{ $log['properties']['attributes']['title'] }}</li>
                                                    <li class="list-group-item"><strong>Description:</strong>
                                                        {{ $log['properties']['attributes']['description'] }}</li>
                                                    <li class="list-group-item"><strong>Status:</strong>
                                                        {{ $log['properties']['attributes']['status'] }}</li>
                                                </ul>
                                            @else
                                                {{ $log->description }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse" aria-expanded="true" aria-controls="collapse">
                                            No activity found.
                                        </button>
                                    </h2>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
