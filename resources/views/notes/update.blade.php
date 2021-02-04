@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('notes.update')</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{route('update.post',['id'=>$note->id])}}" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name">name</label>
                            <input type="name" name="name" class="form-control" value="{{ $note->name }}" id="name" placeholder="name">
                        </div>

                        <div class="form-group">
                            <label for="text">note</label>
                            <textarea name="note" class="form-control" id="text" rows="3">{{ $note->note }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">@lang('notes.update')</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection