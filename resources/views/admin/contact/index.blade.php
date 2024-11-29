@extends('admin.admin-layout')

@section('admin-layout')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">

                <div class="row">
                    <div class="col-md-12 d-flex justify-content-between">
                        <h4 class="text-dark">Home Contact</h4>

                        <button class="btn btn-info float-right mb-2" data-toggle="modal"
                                data-target="#exampleModalForm">
                            <span class="mdi mdi-plus-box-outline "></span> Add Contact
                        </button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card bg-light">
                            <div class="card-body">
                                <table id="dataTable" class="table table-striped table-fixed">
                                    <thead>
                                    <tr class="table-success">
                                        <th scope="col">#</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @php($i=1)
                                    @foreach($contacts as $contact)
                                        <tr>
                                            {{--  <th scope="row">{{ $sliders->firstItem()+$loop->index }}</th>--}}
                                            <th scope="row">{{ $i++ }}</th>
                                            <td>{{ $contact->email }}</td>
                                            <td>{{ $contact->phone }}</td>
                                            <td>{{ $contact->address }}</td>
                                            <td>
                                                @if($contact->created_at == NULL)
                                                    <span
                                                        class="text-secondary">No Date issued</span>
                                                @else
                                                    {{ $contact->created_at->diffForHumans() }}
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                <div class="dropdown show d-inline-block widget-dropdown">
                                                    <a class="dropdown-toggle icon-burger-mini" href="" role="button"
                                                       id="dropdown-recent-order1" data-toggle="dropdown"
                                                       aria-haspopup="true" aria-expanded="false"
                                                       data-display="static"></a>
                                                    <ul class="dropdown-menu dropdown-menu-right"
                                                        aria-labelledby="dropdown-recent-order1">
                                                        <li class="dropdown-item">
                                                            <a href="{{url('contact/edit/'.$contact->id)}}"
                                                               class="btn-sm btn-success text-light">Edit</a>
                                                        </li>
                                                        <li class="dropdown-item">
                                                            <a href="{{url('contact/delete/'.$contact->id)}}"
                                                               onclick="return confirm('Are you sure you want to delete this?')"
                                                               class="btn-sm btn-danger text-light">Remove</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal fade" id="exampleModalForm" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalFormTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalFormTitle">Add New Contact</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('save.contact')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-12 col-md-3 text-right">
                                        <label>Email:</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <input name="email" type="email" class="form-control"
                                               placeholder="Enter Address">
                                    </div>
                                    @error('email')
                                    <span class="text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 col-md-3 text-right">
                                        <label>Phone:</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <input name="phone" type="text" class="form-control"
                                               placeholder="Enter Phone Number">
                                    </div>
                                    @error('phone')
                                    <span class="text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 col-md-3 text-right">
                                        <label>Address:</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <textarea name="address" class="form-control"
                                                  rows="3" placeholder="Write Address here"></textarea>
                                    </div>
                                    @error('address')
                                    <span class="text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                            class="mdi mdi-close-circle-outline"></i>Close
                                    </button>
                                    <button type="submit" class="btn btn-success "><i
                                            class=" mdi mdi-checkbox-marked-outline"></i>Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


