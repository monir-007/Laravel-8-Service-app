@extends('admin.admin-layout')
@section('admin-layout')

    <div class="py-12">
            <div class="container">
                <div class="row">

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-secondary text-light">
                                Edit Brand
                            </div>
                            <div class="card-body">
                                <form action="{{ url('brand/update/'.$brands->id) }}"
                                      method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="oldImage" value="{{ $brands->image
                                    }}">
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
@endsection
