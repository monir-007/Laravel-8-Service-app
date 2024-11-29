@extends('admin.admin-layout')

@section('admin-layout')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Category
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <div class="row">

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-secondary text-light">
                                Edit Category
                            </div>
                            <div class="card-body">
                                <form action="{{ url('category/update/'.$categories->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input name="name" value="{{ $categories->name }}" type="text" class="form-control"
                                               placeholder="Update Category"/>
                                        @error('name')
                                        <span class="text-danger">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="mt-2 btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
