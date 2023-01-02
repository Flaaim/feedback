@extends('layouts.app')

@section('content')
    <div class="col-12">
        <table class="table">
            <thead>
                <th>Id</th>
                <th>Theme</th>
                <th>Message</th>
                <th>Name</th>
                <th>Email</th>
                <th>File</th>
                <th>Date</th>
            </thead>
            <tbody>
                @foreach($applications as $application)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$application->theme}}</td>
                        <td>{{$application->message}}</td>
                        <td>{{$application->user->name}}</td>
                        <td>{{$application->user->email}}</td>
                        <td>{{$application->file}}</td>
                        <td>{{$application->created_at}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection