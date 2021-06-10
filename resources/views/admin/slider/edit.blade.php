<form action="{{url('slider/update/'.$sliders->id)}}" method="POST"
      enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="oldImage" value="{{ $sliders->image }}">
    <div class="form-group row">
        <div class="col-12 col-md-3 text-right">
            <label>Title:</label>
        </div>
        <div class="col-12 col-md-8">
            <input name="title" value="{{$sliders->title}}" type="text" class="form-control"
                   placeholder="Enter Title">
            @error('title')
            <span class="text-danger">*{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-12 col-md-3 text-right">
            <label>Description:</label>
        </div>
        <div class="col-12 col-md-8">
            <textarea name="description" value="{{ $sliders->description }}" class="form-control"
                                                  rows="3"></textarea>
            @error('description')
            <span class="text-danger">*{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-12 col-md-3 text-right">
            <label>Select Image:</label>
        </div>
        <div class="col-12 col-md-8">
            <input name="image" value="{{$sliders->image}}" type="file" class="form-control"
                   placeholder="Select Image">
            @error('image')
            <span class="text-danger">*{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                class="mdi mdi-close-circle-outline"></i>Close
        </button>
        <button type="submit" class="btn btn-success "><i
                class=" mdi mdi-checkbox-marked-outline"></i>Update
        </button>
    </div>
</form>
