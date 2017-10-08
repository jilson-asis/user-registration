@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">Compose Message</div>
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
            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('sendMessage') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('to_email') ? ' has-error' : '' }}">
                        <label for="to_email" class="col-md-12">To:</label>

                        <div class="col-md-12">
                            <input id="to_email" type="text" class="form-control" name="to_email" value="{{ old('to_email') }}" required autofocus>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                        <label for="subject" class="col-md-12">Subject:</label>

                        <div class="col-md-12">
                            <input id="subject" type="text" class="form-control" name="subject" value="{{ old('subject') }}" required autofocus>
                        </div>
                    </div>

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
