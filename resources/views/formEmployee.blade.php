@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">New employee</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <form method="POST" action="{{ route('storeEmployee') }}">
                                @csrf

                                <input type="hidden" name="id" value="{{ isset($user) ? $user->id : null }}">

                                <div class="form-group">
                                    <label for="first_name">First name</label>
                                    <input type="text" id="first_name" class="form-control" name="first_name" value="{{ isset($user) ? $user->first_name : '' }}" />
                                </div>

                                <div class="form-group">
                                    <label for="last_name">Last name</label>
                                    <input type="text" id="last_name" class="form-control" name="last_name" value="{{ isset($user) ? $user->last_name : '' }}" />
                                </div>

                                @if ($positions->count())
                                    <div class="form-group">
                                        <select class="custom-select" name="position">
                                            @foreach($positions as $id => $name)
                                            <option
                                                value="{{ $id }}"
                                                {{ isset($user) && $user->position->id === $id ? 'selected' : '' }}
                                            >
                                                {{ $name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
