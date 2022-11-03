@extends('layouts.none-sidebar')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <h4 class="fw-bold mb-3">Projects</h4>
            @if (count($projects) > 0)
            @foreach ($projects as $project)
            <div class="card mb-3">
                <div class="card-header bg-light">
                    <a href="{{route('dashboard', $project->key)}}" class="nav-link link-secondary">{{ $project->name }}</a>
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $project->description }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{route('task-created', $project->key)}}" class="card-link">
                        New issues
                    </a>
                    <a href="{{route('task-lists', $project->key)}}" class="card-link">
                        Issues
                    </a>
                    <a href="{{route('project-board', $project->key)}}" class="card-link">
                        Board
                    </a>
                    <a href="{{route('project-page', $project->key)}}" class="card-link">
                        Wiki
                    </a>
                </div>
            </div>
            @endforeach
            @else
                <img src="/notyet.svg" class="w-100">
                I don't have any records!
            @endif
        </div>
        <div class="col-md-6">
            <h4 class="fw-bold mb-3">Recent Updates</h4>
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">List group item heading</h5>
                        <small>3 days ago</small>
                    </div>
                    <p class="mb-1">Some placeholder content in a paragraph.</p>
                    <small>And some small print.</small>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">List group item heading</h5>
                        <small class="text-muted">3 days ago</small>
                    </div>
                    <p class="mb-1">Some placeholder content in a paragraph.</p>
                    <small class="text-muted">And some muted small print.</small>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">List group item heading</h5>
                        <small class="text-muted">3 days ago</small>
                    </div>
                    <p class="mb-1">Some placeholder content in a paragraph.</p>
                    <small class="text-muted">And some muted small print.</small>
                </a>
            </div>
        </div>
    </div>
</div>
@include('shared.project')
@endsection