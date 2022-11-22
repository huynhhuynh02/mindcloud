@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex mb-3 justify-content-between">
                    <h5>Issues list</h5>
                    <a href="{{ route('task-created', request()->key) }}" class="btn btn-primary">New Issue</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Task type</th>
                                        <th scope="col">Summary</th>
                                        <th scope="col">Assignee</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Due date</th>
                                        <th scope="col">Created by</th>
                                        <th scope="col">Created at</th>
                                        <th scope="col">Attachment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tasks as $task)
                                        <tr onclick="window.location.href= '{{ route('task-show', [request()->key, $task->id]) }}'">
                                            <td class="col"><span class="badge {{ $task->getTypeColor($task->tasktype->name) }}">{{ $task->tasktype->name }}</span>
                                            </td>
                                            <td class="col">{{ $task->text }}</td>
                                            <td class="col">
                                                @if(count($task->assignees) > 0)
                                                    @foreach ($task->assignees as $assignee)
                                                        {{ $assignee->name }}
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="col"><span
                                                    class="{{ $task->getStatusColor() }}">{{ $task->getStatusName($task->status) }}</span>
                                            </td>
                                            <td class="col">{{ $task->end_date}}</td>
                                            <td class="col">{{ $task->createdby->name }}</td>
                                            <td class="col">{{ $task->created_at }}</td>
                                            <td class="col"></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $tasks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    
@endsection
