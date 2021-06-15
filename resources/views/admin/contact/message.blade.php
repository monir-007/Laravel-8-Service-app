@extends('admin.admin-layout')

@section('admin-layout')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">

                <div class="row">
                    <div class="col-md-12 d-flex justify-content-between">
                        <h4 class="text-dark mb-3"> Contact Messages</h4>
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
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Message</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @php($i=1)
                                    @foreach($messages as $message)
                                        <tr>
                                            {{--  <th scope="row">{{ $sliders->firstItem()+$loop->index }}</th>--}}
                                            <th scope="row">{{ $i++ }}</th>
                                            <td>{{ $message->name }}</td>
                                            <td>{{ $message->email }}</td>
                                            <td>{{ $message->subject }}</td>
                                            <td>{{ $message->message }}</td>
                                            <td>
                                                @if($message->created_at == NULL)
                                                    <span
                                                        class="text-secondary">No Date issued</span>
                                                @else
                                                    {{ $message->created_at->diffForHumans() }}
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                <a href="{{url('/contact/message/delete/'.$message->id)}}"
                                                   onclick="return confirm('Are you sure you want to delete this?')"
                                                   class="btn-sm btn-danger text-light">Remove</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="pagination pagination-seperated">
                                    {{ $messages->links() }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection


