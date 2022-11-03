@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="fw-bold mb-3">Create issue</h4>
                        <form method="POST" action="{{ route('tasks.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row form-group mb-3">
                                <div class="col-md-5">
                                    <label for="issueType" class="form-label">Issue type
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="type" class="form-select" id="issueType">
                                        @foreach ($tasktypes as $type)
                                            <option value="{{ $type->id }}" selected>{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group mb-3">
                                <div class="col-md-5">
                                    <label for="issueStatus" class="form-label">Status
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="status" class="form-select selectpicker" id="issueStatus">
                                        <option value="0" selected>Open</option>
                                        <option value="1">Inprocess</option>
                                        <option value="2">Resovled</option>
                                        <option value="3">Close</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="formGroupExampleInput2" class="form-label">Summary
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="text" value="{{ old('text') }}"
                                    class="form-control @error('text') is-invalid @enderror" id="formGroupExampleInput2">
                                @error('text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 form-group">
                                <label for="textareaDescription" class="form-label">Description</label>
                                <textarea name="description" class="form-control" id="textareaDescription" rows="5"></textarea>
                            </div>
                            <div class="row mb-3 form-group">
                                <div class="col-md-5">
                                    <label for="assigneeTo" class="form-label">Assignee</label>
                                    <select name="assignee" class="form-select" id="assigneeTo">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <a href="#" class="fw-bold">Assign to me</a>
                                </div>
                                <div class="col-md-5">
                                    <label for="dueDate" class="form-label">Due Date</label>
                                    <input type="date" name="end_date" class="form-control" type="hidden" id="dueDate">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="formFileMultiple" class="form-label">Attachment</label>
                                <input class="form-control" name="files[]" type="file" id="formFileMultiple" multiple>
                            </div>
                            <div class="mb-3">
                                <input name="project_id" class="form-control" type="hidden" id="hiddenID"
                                    value="{{ $project->id }}">
                                <button type="submit" class="btn btn-primary">Create</button>
                                <button type="button" class="btn btn-light">Cancel</button>
                            </div>
                        </form>
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
