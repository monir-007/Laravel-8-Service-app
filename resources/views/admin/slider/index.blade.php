@extends('admin.admin-layout')

@section('admin-layout')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">

                <div class="row">
                    <div class="col-md-12 d-flex justify-content-between">
                        <h4 class="text-dark">Home Slider</h4>

                        <button class="btn btn-info float-right mb-2" data-toggle="modal"
                                data-target="#exampleModalForm">
                            <span class="mdi mdi-plus-box-outline "></span> Add Slider
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
                                <table class="table table-striped table-fixed">
                                    <thead>
                                    <tr class="table-success">
                                        <th scope="col">#</th>
                                        <th scope="col" width="20%">Title</th>
                                        <th scope="col" width="40%">Description</th>
                                        <th scope="col" width="15%">Image</th>
                                        <th scope="col" width="15%">Created At</th>
                                        <th scope="col" width="10%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @php($i=1)
                                    @foreach($sliders as $slider)
                                        <tr>
{{--                                            <th scope="row">{{ $sliders->firstItem()+$loop->index }}</th>--}}
                                            <th scope="row">{{ $i++ }}</th>
                                            <td>{{ $slider->title }}</td>
                                            <td>{{ $slider->description }}</td>
                                            <td><img src="{{ asset($slider->image) }}"
                                                     style="height: 50px; width:60px;"
                                                     alt=""></td>
                                            <td>
                                                @if($slider->created_at == NULL)
                                                    <span
                                                        class="text-secondary">No Date issued</span>
                                                @else
                                                    {{ $slider->created_at->diffForHumans() }}
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
                                                            {{--                                                            <a href="{{ url('slider/edit/'.$slider->id) }}">Edit</a>--}}
                                                            <button class="btn-sm btn-success" data-toggle="modal"
                                                                    data-target="#sliderEditModal">Edit
                                                            </button>
                                                        </li>
                                                        <li class="dropdown-item">
                                                            <a href="{{ url('slider/delete/'.$slider->id) }}"
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
                            <h5 class="modal-title" id="exampleModalFormTitle">Add New Slider</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('save.slider')}}" method="POST" enctype="multipart/form-data">
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
                                        <label>Description:</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <textarea name="description" class="form-control"
                                                  rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 col-md-3 text-right">
                                        <label>Select Image:</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <input name="image" type="file" class="form-control"
                                               placeholder="Select Image">
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

            <div class="modal fade" id="sliderEditModal" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalFormTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalFormTitle">Edit Slider</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @include('admin.slider.edit')
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
