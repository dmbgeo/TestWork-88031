@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('notes.list')</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    @if($notes->total())
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notes as $note)
                            <tr>
                                <td>{{ $note->id }}</td>
                                <td>{{ $note->name }}</td>
                                <td style="text-align:right;">
                                    <a href="{{route('detail',['id'=>$note->id])}}" class="btn btn-info">@lang('notes.view')</a>
                                    <a href="{{route('update',['id'=>$note->id])}}" class="btn btn-success">@lang('notes.edit')</a>
                                    <a href="{{route('get.delete',['id'=>$note->id])}}" class="btn btn-danger">@lang('notes.delete')</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @else
                        @lang('notes.notes_empty')
                    @endif
                
                </div>
            </div>
        </div>
    </div>
</div>

@endsection