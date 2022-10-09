@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="fw-bold mb-3">Organization Settings</h4>
                    <form method="POST" action="{{ route('organization-settings.update',$organization->id)}}">
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="space" class="form-label">Space Key</label>
                                <input type="text" name="key" class="form-control @error('key') is-invalid @enderror" value="{{$organization->key}}" readonly id="space">
                                @error('key')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="organizationName" class="form-label">Organization Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$organization->name}}" id="organizationName">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                @csrf
                                <button type="submit" class="btn btn-primary">
                                    {{__('Update')}}
                                </button>
                            </div>
                        </div>
                    </form>
                    @if (session('status'))
                    <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                            <use xlink:href="#check-circle-fill" />
                        </svg>
                        <div>
                            {{ session('status') }}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection