@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="fw-bold mb-3">Create issue</h4>
                        <form>
                            <div class="row form-group">
                                <div class="col-md-5">
                                    <label for="issueType" class="form-label">Issue type</label>
                                    <select name="type" class="form-select selectpicker" id="issueType">
                                        <option selected>Task</option>
                                        <option>Bug</option>
                                        <option>Request</option>
                                        <option>Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-5">
                                    <label for="issueStatus" class="form-label">Status</label>
                                    <select name="status" class="form-select selectpicker" id="issueStatus">
                                        <option selected>Open</option>
                                        <option>Inprocess</option>
                                        <option>Resovled</option>
                                        <option>Close</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="formGroupExampleInput2" class="form-label">Summary <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="subject" class="form-control" id="formGroupExampleInput2">
                            </div>
                            <div class="mb-3 form-group">
                                <label for="textareaDescription" class="form-label">Description</label>
                                <textarea name="description" class="form-control" id="textareaDescription" rows="5"></textarea>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="assigneeTo" class="form-label">Assignee</label>
                                <select class="form-select" id="assigneeTo">
                                    @foreach ($users as $user)
                                        <option value="{{$user->id}}" selected>{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="formFileMultiple" class="form-label">Multiple files input example</label>
                                <input class="form-control" type="file" id="formFileMultiple" multiple>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
