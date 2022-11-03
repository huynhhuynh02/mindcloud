@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('wikis.store') }}" method="POST">
                            @csrf
                            <div class="mb-3 form-group">
                                <label for="formGroupExampleInput2" class="form-label">Page name
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror" id="formGroupExampleInput2">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 form-group">
                                <label for="formGroupTextare" class="form-label">Content</label>
                                <textarea class="form-control" name="content" id="formGroupTextare"></textarea>
                            </div>
                            <div class="mb-3 form-group">
                                <input type="hidden" name="project_id" value="{{$project->id}}"
                                    class="form-control">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a type="submit" class="btn btn-secondary">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
