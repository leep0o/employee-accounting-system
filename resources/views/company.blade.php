@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ $company->name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($company->url_image)
                        <img src="{{ $company->url_image }}" class="img-fluid w-50" alt="{{ $company->name }}">
                    @endif

                        <h3>{{ $company->description }}</h3>

                        <h5>A list of employees</h5>
                    @if ($company->users->count())
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Position</th>
                                <th scope="col">Salary</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($company->users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->full_name }}</td>
                                    <td>{{ $user->position->name }}</td>
                                    <td>{{ $user->position->salary }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <h5>No employees.</h5>
                    @endif

                    @auth
                        <form method="POST" action="{{ route('addComment') }}">
                            @csrf
                            <input type="hidden" name="company_id" value="{{ $company->id }}">
                            <div class="form-group">
                                <label for="comment">Add comment</label>
                                <textarea id="comment" class="form-control" name="comment" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Add comment</button>
                            </div>
                        </form>

                        @if ($company->comments->count())
                            <hr>
                            <h2>Comments</h2>
                            <ul>
                                @foreach ($company->comments as $comment)
                                <li>{{ $comment->body }}</li>
                                @endforeach
                            </ul>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
