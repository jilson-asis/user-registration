@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        <div class="panel panel-default">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="panel-heading">{{ $messages->first()->subject }}</div>
            <div class="clearfix"></div>

            @foreach ($messages as $message)
                    <div class="panel-body">
                        <div class="col-xs-12">
                            {{ $message->sender->name }} : ({{ $message->created_at }})
                        </div>
                        <div class="col-xs-12">
                            {{ $message->body }}
                        </div>
                        @if (!is_null($message->attachment))
                            <div class="col-xs-12">
                                File: {{ $message->attachment->filename }}
                            </div>
                        @endif
                    </div>
            @endforeach

            <hr>
            <div class="panel-body">
                <div class="col-xs-12">
                    Reply:
                </div>
            </div>

            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('replyMessage') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="receiver_id" value="{{ $message->sender_id }}">
                    <input type="hidden" name="thread_id" value="{{ $message->thread_id }}">

                    <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                        <label for="message" class="col-md-12">Message:</label>

                        <div class="col-md-12">
                            <textarea id="message" class="form-control" name="message" required autofocus>{{ old('message') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('attachment') ? ' has-error' : '' }}">
                        <div class="col-md-12">
                            <label class="btn btn-default btn-file">
                                Attach File <input type="file" name="attachment" style="display: none;">
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">
                                Send
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
