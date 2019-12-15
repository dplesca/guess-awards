@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h4>Users</h4>
            <table class="table table-sm table-bordered">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nume</th>
                    <th scope="col">Alegeri facute</th>
                    <!-- <th scope="col">Alegeri corecte</th> -->
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    @foreach ($users as $user)    
                        <th scope="row">3</th>
                        <td>
                            @if ($user->id == Auth::id())
                            <a href="/">{{$user->name}}</a>
                            @else
                            <a href="/users/{{$user->id}}">{{$user->name}}</a>
                            @endif
                        </td>
                        <td>{{count($user->picks)}}</td>
                        <!-- <td>0</td> -->
                    @endforeach    
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
