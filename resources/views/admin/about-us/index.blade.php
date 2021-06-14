@extends('admin.admin-layout')

@section('admin-layout')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">

                <div class="row">
                    <div class="col-md-12 d-flex justify-content-between">
                        <h4 class="text-dark">Home About Us</h4>

                        <button class="btn btn-info float-right mb-2" data-toggle="modal"
                                data-target="#exampleModalForm">
                            <span class="mdi mdi-plus-box-outline "></span> Add About Us
                        </button>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card bg-light">
                            @if(session('success'))
                                <div class="col-md-6 alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{session('success')}}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="card-body">
                                <table id="dataTable" class="table table-striped table-fixed">
                                    <thead>
                                    <tr class="table-success">
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Short Text</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @php($i=1)
                                    @foreach($aboutUss as $aboutUs)
                                        <tr>
                                            {{--                                            <th scope="row">{{ $sliders->firstItem()+$loop->index }}</th>--}}
                                            <th scope="row">{{ $i++ }}</th>
                                            <td>{{ $aboutUs->title }}</td>
                                            <td>{{ $aboutUs->shortText }}</td>
                                            <td>{{ $aboutUs->description }}</td>
                                            <td>
                                                @if($aboutUs->created_at == NULL)
                                                    <span
                                                        class="text-secondary">No Date issued</span>
                                                @else
                                                    {{ $aboutUs->created_at->diffForHumans() }}
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
                                                            <a href="{{url('about-us/edit/'.$aboutUs->id)}}"
                                                               class="btn-sm btn-success text-light">Edit</a>
                                                        </li>
                                                        <li class="dropdown-item">
                                                            <a href="{{url('about-us/delete/'.$aboutUs->id)}}"
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
                            <h5 class="modal-title" id="exampleModalFormTitle">Add New About Us</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('save.aboutUs')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-12 col-md-3 text-right">
                                        <label>Title:</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <input name="title" type="text" class="form-control"
                                               placeholder="Enter Title">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 col-md-3 text-right">
                                        <label>Short Text:</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <input name="shortText" type="text" class="form-control"
                                               placeholder="Enter Short text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 col-md-3 text-right">
                                        <label>Description:</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <textarea name="description" class="form-control"
                                                  rows="3"></textarea>
                                    </div>
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


