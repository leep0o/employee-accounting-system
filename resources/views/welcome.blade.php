@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Companies</div>

                    <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($companies->count())
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">The count of employees</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($companies as $company)
                            <tr>
                                <th scope="row">{{ $company->id }}</th>
                                <td>
                                    <img src="{{ $company->url_image }}" style="max-width: 100px" alt="{{ $company->name }}">
                                </td>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->users->count() }}</td>
                                <td>
                                    <a href="{{ route('company', $company->id) }}" class="btn btn-primary btn-sm">Show</a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $companies->links() }}
                    @else
                        <h5>No companies.</h5>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
