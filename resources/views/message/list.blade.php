@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">All Messages</div>
            <div class="clearfix"></div>

            <div class="panel panel-default">
                <ul class="list-group">
                    @foreach ($messages as $message)
                        <li class="list-group-item">
                            <a href="{{ route('viewMessage', ['tid' => $message->thread_id]) }}">View</a> |
                            {{ $message->subject }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
