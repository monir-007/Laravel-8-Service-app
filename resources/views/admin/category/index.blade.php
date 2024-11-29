@extends('admin.admin-layout')

@section('admin-layout')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Category
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header text-secondary bg-warning">
                                All Category
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr class="table-success">
                                        <th scope="col">#</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Created User</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($categories as $category)
                                        <tr>
                                            <th scope="row">{{ $categories->firstItem()+$loop->index }}</th>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->user->name }}</td>
                                            <td>
                                                @if($category->created_at == NULL)
                                                    <span
                                                        class="text-secondary">No Date issued</span>
                                                @else
                                                    {{ $category->created_at->diffForHumans() }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('category/edit/'.$category->id) }}"
                                                   class="btn btn-info">Edit</a>
                                                <a href="{{ url('category/softDelete/'
                                                .$category->id) }}"
                                                   class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="pagination pagination-seperated pagination-seperated-rounded">
                                    {!! $categories->links() !!}
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-secondary text-light">
                                Add Category
                            </div>
                            <div class="card-body">
                                <form action="{{route('save.category')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input name="name" type="text" class="form-control"
                                               placeholder="Category Name"/>
                                        @error('name')
                                        <span class="text-danger">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="mt-2 btn btn-primary">Add</button>
                                </form>
                            </div>


                        </div>
                    </div>

                </div>

{{--                Delete Section--}}
                <div class="row mt-3">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-header text-light bg-danger">
                                Trash Category
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr class="table-success">
                                        <th scope="col">#</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Created User</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($deleteCategories as $category)
                                        <tr>
                                            <th scope="row">{{ $categories->firstItem()+$loop->index }}</th>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->user->name }}</td>
                                            <td>
                                                @if($category->created_at == NULL)
                                                    <span
                                                        class="text-secondary">No Date issued</span>
                                                @else
                                                    {{ $category->created_at->diffForHumans() }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('category/restore/'.$category->id)
                                                 }}"
                                                   class="btn btn-info">Restore</a>
                                                <a href="{{ url('category/delete/'.$category->id) }}"
                                                   class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="pagination pagination-seperated pagination-seperated-rounded">
                                    {{ $deleteCategories->links() }}
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
