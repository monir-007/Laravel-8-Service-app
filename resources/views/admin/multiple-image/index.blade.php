<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Images
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card-group">
                            @foreach($images as $image)
                                <div class="col-md-4 mt-5 ">
                                    <div class="card">
                                        <img src="{{ asset($image->image) }}" alt="image">
                                    </div>
                                </div>
                            @endforeach

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
                                Add Images
                            </div>
                            <div class="card-body">
                                <form action="{{ route('save.multiImage') }}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <input name="image[]" type="file" class="form-control"
                                               placeholder="Image Select" multiple=""/>
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
