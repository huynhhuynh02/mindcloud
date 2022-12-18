@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h5>File manager</h5>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('project-page-new', request()->key) }}" class="btn btn-primary btn-sm">New folder</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tbody>
                                    @foreach ($files as $file)                
                                        <tr>
                                            <td class="col"><a href="http://s3-ap-northeast-1.amazonaws.com/mindcloud/{{$file['name']}}" target="__blank">{{ $file['name'] }}</a></td>
                                            <td class="col">{{ $file['size'] }}</td>
                                            <td class="col">{{ $file['lastModified'] }}</td>
                                        </tr>
                                    @endforeach
                                    @foreach ($folders as $folder)
                                    @php
                                        $folder_arr = explode('/',$folder);
                                        $folder_name = end($folder_arr);
                                    @endphp                           
                                        <tr>
                                            <td class="col" colspan="3">
                                                <i class="fa-solid fa-folder text-warning"></i>
                                                <a href="{{url()->current()}}/?prefix={{$folder}}">{{ $folder_name }}</a>
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