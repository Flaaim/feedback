@extends('layouts.app')

@section('content')
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                Feedback
            </div>
            <div class="card-body">
                <form action="{{route('application.store')}}" method="POST">
                    @csrf
                    <div class="form-group my-3">
                        <label for="theme">Theme</label>
                        <input type="text" id="theme" class="form-control" name="theme">
                    </div>
                    <div class="form-group my-3">
                        <label for="message">Message</label>
                        <textarea name="message" class="form-control" id="message" cols="30" rows="3"></textarea>
                    </div>
                    <div class="form-group my-3">
                        <input type="file" name="file" class="form-control-file" id="file">
                    </div>
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </div>

@endsection