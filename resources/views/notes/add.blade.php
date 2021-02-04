@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('notes.add')</div>

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
                    <form action="{{route('add.put')}}" method="POST">
                        {{ csrf_field() }}
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">name</label>
                            <input type="name" name="name" class="form-control" value="{{ old('name') }}" id="name" placeholder="name">
                        </div>

                        <div class="form-group">
                            <label for="text">note</label>
                            <textarea  name="note" class="form-control" id="text" rows="3">{{ old('note') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">@lang('notes.add')</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection