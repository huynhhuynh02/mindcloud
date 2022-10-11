@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Project</a></li>
                        <li class="breadcrumb-item"><a href="#">Tapa</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Task 1</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-5">
                    <div class="card-body">
                        <h2 class="fw-bold">{{ $task->subject }}</h2>
                        <div class="task-action mb-3">
                            <button type="button" class="btn btn-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-paperclip" viewBox="0 0 16 16">
                                    <path
                                        d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0V3z" />
                                </svg>
                                Attachment
                            </button>
                            <button type="button" class="btn btn-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-link-45deg" viewBox="0 0 16 16">
                                    <path
                                        d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z" />
                                    <path
                                        d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z" />
                                </svg>
                                Link issues
                            </button>
                            <a href="{{ route('task-edit', [request()->key, request()->task_id]) }}" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                </svg>
                                Edit
                            </a>
                        </div>
                        <h5>Desctiption</h5>
                        {!! $task->description !!}
                    </div>
                </div>
                <p class="fs-6">Comments(3)</p>
                <div class="card">
                    <div class="card-body">
                        <div class="write-comment d-flex">
                            <div class="avatar">
                                <img width="40" height="40" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/2048px-User-avatar.svg.png" class="rounded-circle" alt="">
                            </div>
                            <div class="textarea">
                                <textarea name="" id="textareaDescription" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="action-group mb-3 d-flex justify-content-end">
                            <button type="button" class="btn btn-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-share" viewBox="0 0 16 16">
                                    <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z"/>
                                  </svg>
                                Share
                            </button>
                            <div class="dropdown">
                                <button type="button" class="btn btn-light ms-2" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                        <path
                                            d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                    </svg>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#">Clone issues</a></li>
                                    <li><a class="dropdown-item text-danger" href="#">Delete</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3">Issues type</label>
                            <div class="col-sm-9">
                                <span class="badge {{ $task->getStatusColor() }}">{{ $task->tasktype->name }}</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3">Assignee</label>
                            <div class="col-sm-9">
                                <select name="assignee" class="form-select" id="assigneeTo">
                                    @foreach ($users as $user)
                                        @if (count($task->assignees) > 0)
                                            @foreach ($task->assignees as $assignee)
                                                @if ($user->id == $assignee->id)
                                                    <option selected value="{{ $user->id }}" selected>
                                                        {{ $user->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                        <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3">Label</label>
                            <div class="col-sm-9">

                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3">Created by</label>
                            <div class="col-sm-9">
                                {{ $task->createdby->name }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
