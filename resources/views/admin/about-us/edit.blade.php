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
                            Edit About Us
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/about-us/update/'.$data->id) }}"
                                  method="POST" >
                                @csrf
                                <div class="form-group">
                                    <label for="titleInput">Title</label>
                                    <input name="title" value="{{ $data->title }}" type="text"
                                           class="form-control" id="titleInput"
                                           placeholder="Update Title"/>
                                    @error('title')
                                    <span class="text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="ShortTextInput">Short Description</label>
                                    <input name="shortText" value="{{ $data->shortText }}" type="text"
                                           class="form-control" id="ShortTextInput"
                                           placeholder="Update Text"/>
                                    @error('shortText')
                                    <span class="text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="descriptionInput">Description</label>
                                    <textarea name="description" id="descriptionInput"
                                              rows="5"
                                              class="form-control" >{{ $data->description }}</textarea>
                                    @error('description')
                                    <span class="text-danger">*{{ $message }}</span>
                                    @enderror
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

