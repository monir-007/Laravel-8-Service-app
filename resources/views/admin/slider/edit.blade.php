{{--<form action="{{url('slider/update/')}}" method="POST" id="editForm"--}}
{{--      enctype="multipart/form-data">--}}
{{--    @csrf--}}
{{--    {{method_field('put')}}--}}
{{--    <input type="hidden" name="oldImage" value="{{ $sliders->image }}">--}}
{{--    <div class="form-group row">--}}
{{--        <div class="col-12 col-md-3 text-right">--}}
{{--            <label>Title:</label>--}}
{{--        </div>--}}
{{--        <div class="col-12 col-md-8">--}}
{{--            <input name="title" value="{{$sliders->title}}" id="title" type="text" class="form-control"--}}
{{--                   placeholder="Enter Title">--}}
{{--            @error('title')--}}
{{--            <span class="text-danger">*{{ $message }}</span>--}}
{{--            @enderror--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="form-group row">--}}
{{--        <div class="col-12 col-md-3 text-right">--}}
{{--            <label>Description:</label>--}}
{{--        </div>--}}
{{--        <div class="col-12 col-md-8">--}}
{{--            <textarea name="description" value="{{ $sliders->description }}" id="description" class="form-control"--}}
{{--                                                  rows="3"></textarea>--}}
{{--            @error('description')--}}
{{--            <span class="text-danger">*{{ $message }}</span>--}}
{{--            @enderror--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="form-group row">--}}
{{--        <div class="col-12 col-md-3 text-right">--}}
{{--            <label>Select Image:</label>--}}
{{--        </div>--}}
{{--        <div class="col-12 col-md-8">--}}
{{--            <input name="image" value="{{$sliders->image}}" id="image" type="file" class="form-control"--}}
{{--                   placeholder="Select Image">--}}
{{--            @error('image')--}}
{{--            <span class="text-danger">*{{ $message }}</span>--}}
{{--            @enderror--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="modal-footer">--}}
{{--        <button type="button" class="btn btn-danger" data-dismiss="modal"><i--}}
{{--                class="mdi mdi-close-circle-outline"></i>Close--}}
{{--        </button>--}}
{{--        <button type="submit" class="btn btn-success "><i--}}
{{--                class=" mdi mdi-checkbox-marked-outline"></i>Update--}}
{{--        </button>--}}
{{--    </div>--}}
{{--</form>--}}


@extends('admin.admin-layout')
@section('admin-layout')

    <div class="py-12">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    @if(session('success'))
                    <div class=" alert alert-success alert-dismissible fade show"
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
                    Edit Slider
                </div>
                <div class="card-body">
                    <form action="{{ url('slider/update/'.$sliders->id) }}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="oldImage" value="{{ $sliders->image
                                    }}">
                        <div class="form-group">
                            <input name="title" value="{{ $sliders->title }}" type="text"
                                   class="form-control"
                                   placeholder="Update Title"/>
                            @error('title')
                            <span class="text-danger">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <textarea name="description" value="{{ $sliders->description }}" id="" cols="15" rows="5"
                                      class="form-control"></textarea>

                            @error('description')
                            <span class="text-danger">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <input name="image" type="file" class="form-control"
                                   placeholder="Image Select" value="{{ $sliders->image }}"/>
                            @error('image')
                            <span class="text-danger">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <img src="{{asset($sliders->image)}}" alt="brand"
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

