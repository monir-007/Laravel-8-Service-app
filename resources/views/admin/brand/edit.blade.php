<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Brand
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <div class="row">

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
                                Edit Brand
                            </div>
                            <div class="card-body">
                                <form action="{{ url('brand/update/'.$brands->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input name="name" value="{{ $brands->name }}" type="text"
                                               class="form-control"
                                               placeholder="Update Name"/>
                                        @error('name')
                                        <span class="text-danger">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <input name="image" type="file" class="form-control"
                                               placeholder="Image Select" value="{{ $brands->image
                                               }}"/>
                                        @error('image')
                                        <span class="text-danger">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <img src="{{asset($brands->image)}}" alt="brand"
                                             style="width: 400px; height: 200px;">
                                    </div>
                                    <button type="submit" class="mt-2 btn btn-primary">Update
                                    </button>
                                </form>
                            </div>


                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
