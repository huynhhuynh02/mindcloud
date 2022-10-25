@extends('layouts.app')
@section('content')
    <div class="container-fluid board-container">
        <div class="row">
            <div class="col-md-12 vh-100 overflow-scroll">
                <div id="gantt_here" style='width:100%; height:100%;'></div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        gantt.config.date_format = "%Y-%m-%d";
        gantt.config.columns = [
            {name: "text", label: "Subject", tree: true, width: 200, resize: true},
            {name: "duration", label: "Duration", width:80, align: "center", resize: true},
            {name: "start_date", label: "Start Date", width:80, align: "center", resize: true},
            {name: "end_date", label: "Due Date", width:80, align: "center", resize: true}
        ];
        gantt.init("gantt_here");
        gantt.load('{{route('gantt-api', request()->key )}}');
    </script>
@endsection