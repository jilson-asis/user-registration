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
                            <div class="col-xs-9">
                                <a href="{{ route('viewMessage', ['tid' => $message->thread_id]) }}">{{ $message->subject }}</a>
                            </div>
                            <div class="col-xs-3 text-right">
                                {{ $message->created_at->diffForHumans() }}
                            </div>
                            <div class="clearfix"></div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
