@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3>Alege cine crezi ca va castiga Globuri de Aur</h3>
            @foreach ($categories as $category)
            <div class="card mt-2">
                <div class="card-header">
                    <h4>{{$category->name}}</h4>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush pick">
                    @foreach ($category->nominees as $nominee)
                        <li data-category="{{$category->id}}" data-nominee="{{$nominee->id}}" class="list-group-item @if(Auth::user()->hasPick($category->id, $nominee->id, $picks)) bg-success @endif">
                        @if ($category->type == 'person')
                            <strong>{{$nominee->name}}</strong> for <strong><em>{{$nominee->for}}</em></strong>
                        @else
                            <strong>{{$nominee->name}}</strong>
                        @endif
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
