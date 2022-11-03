@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h5>Project pages</h5>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('project-page-new', request()->key) }}" class="btn btn-primary btn-sm">Created Page</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tbody>
                                    @foreach ($pages as $page)
                                        <tr onclick="window.location.href= '{{ route('page-show', [request()->key, $page->id]) }}'">
                                            <td class="col">{{ $page->name }}</td>
                                            <td class="col">
                                                {{ $page->user->name }}
                                            </td>
                                            <td class="col">
                                                {{ $page->created_at }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    
@endsection
