<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Brands
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header text-secondary bg-warning">
                                All Brands
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr class="table-success">
                                        <th scope="col">#</th>
                                        <th scope="col">Brand Name</th>
                                        <th scope="col">Brand Image</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($brands as $brand)
                                        <tr>
                                            <th scope="row">{{ $brands->firstItem()+$loop->index }}</th>
                                            <td>{{ $brand->name }}</td>
                                            <td><img src="{{ asset($brand->image) }}"
                                                     style="height: 50px; width:60px;"
                                                     alt=""></td>
                                            <td>
                                                @if($brand->created_at == NULL)
                                                    <span
                                                        class="text-secondary">No Date issued</span>
                                                @else
                                                    {{ $brand->created_at->diffForHumans() }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('brand/edit/'.$brand->id) }}"
                                                   class="btn btn-info">Edit</a>
                                                <a href="{{ url('$brand/softDelete/'
                                                .$brand->id) }}"
                                                   class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $brands->links() }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show"
                                 role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close" data-dismiss="alert"
                                        aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="card">
                            <div class="card-header bg-secondary text-light">
                                Add Brand
                            </div>
                            <div class="card-body">
                                <form action="{{ route('save.brand') }}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <input name="name" type="text" class="form-control"
                                               placeholder="Brand Name"/>
                                        @error('name')
                                        <span class="text-danger">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <input name="image" type="file"  class="form-control"
                                               placeholder="Image Select"/>
                                        @error('image')
                                        <span class="text-danger">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="mt-2 btn btn-primary">Add</button>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
</x-app-layout>
