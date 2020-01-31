@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Profile company
                        <button type="button" class="btn btn-danger btn-sm float-right mx-1" data-toggle="modal" data-target="#deleteCompany">
                            Delete company
                        </button>
                        <a href="{{ route('addEmployee') }}" class="btn btn-success btn-sm float-right mx-1">New employee</a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            @if (auth()->user()->url_image)
                                <img src="{{ auth()->user()->url_image }}" class="img-fluid w-50" alt="{{ auth()->user()->name }}">
                            @endif

                            <form method="POST" action="{{ route('storeCompany') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" class="form-control" name="name" value="{{ auth()->user()->name }}" />
                                </div>

                                <div class="form-group input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="image" aria-describedby="image">
                                        <label class="custom-file-label" for="image">Choose image</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea id="description" class="form-control" name="description" rows="3">
                                        {{ auth()->user()->description }}
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>

                        <h5>A list of employees</h5>
                        @if (auth()->user()->users->count())
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Salary</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach (auth()->user()->users as $user)
                                    <tr>
                                        <th scope="row">{{ $user->id }}</th>
                                        <td>{{ $user->full_name }}</td>
                                        <td>{{ $user->position->name }}</td>
                                        <td>{{ $user->position->salary }}</td>
                                        <td class="text-right">
                                            <a href="{{ route('editEmployee', $user->id) }}" class="btn btn-warning btn-sm mx-1">Edit</a>

                                            <form method="POST" action="{{ route('deleteEmployee') }}" class="float-right">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <h5>No employees.</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteCompany" tabindex="-1" role="dialog" aria-labelledby="deleteCompany" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete your company?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <form method="POST" action="{{ route('deleteCompany') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">Confirm deletion</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
