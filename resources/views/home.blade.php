@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">    
                    @if(isset($teachers))
                    <div class="table-responsive" id="users-table-wrapper">    
                        <table class="table table-striped table-borderless">
                            <thead>
                                <th class="min-width-100">Name</th>
                                <th class="min-width-100">Email</th>
                                <th class="min-width-100">Role</th>
                            </thead>
                            <tbody>
                            @foreach($teachers as $teacher)
                            <tr>
                                <td>{{$teacher->name}}</td>
                                <td>{{$teacher->email}}</td>
                                <td>{{$teacher->role}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>    
                    @endif 
                    @if(isset($students))
                    <div class="table-responsive" id="users-table-wrapper">
                        <table class="table table-striped table-borderless">
                            <thead>
                                <th class="min-width-100">Name</th>
                                <th class="min-width-100">Email</th>
                                <th class="min-width-100">Role</th>
                            </thead>
                            <tbody>
                            @foreach($students as $student)
                            <tr>
                                <td>{{$student->name}}</td>
                                <td>{{$student->email}}</td>
                                <td>{{$student->role}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                   @endif    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
