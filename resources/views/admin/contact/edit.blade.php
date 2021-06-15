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
                            Edit Contact
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/contact/update/'.$contact->id) }}"
                                  method="POST" >
                                @csrf
                                <div class="form-group">
                                    <label for="emailInput">Email</label>
                                    <input name="email" value="{{ $contact->email }}" type="email"
                                           class="form-control" id="emailInput"
                                           placeholder="Update Email"/>
                                    @error('email')
                                    <span class="text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phoneInput">Phone</label>
                                    <input name="phone" value="{{ $contact->phone }}" type="text"
                                           class="form-control" id="phoneInput"
                                           placeholder="Update Phone"/>
                                    @error('phone')
                                    <span class="text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="addressInput">Address</label>
                                    <textarea name="address" id="addressInput"
                                              rows="5"
                                              class="form-control" >{{ $contact->address }}</textarea>
                                    @error('address')
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

