@extends('layouts.backend.app')

@section('css')
    <!-- JQuery DataTable Css -->
    <link href="{{asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                
                <a class="btn btn-primary waves-effect" href="{{route('author.post.create')}}">
                    <i class="material-icons">add</i>
                    <span>Add New</span>
                </a>
                
            </div>
            <div class="body">
                <div class="table-responsive">
                    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="dt-buttons"><a class="dt-button buttons-copy buttons-html5" tabindex="0" aria-controls="DataTables_Table_1" href="#"><span>Copy</span></a><a class="dt-button buttons-csv buttons-html5" tabindex="0" aria-controls="DataTables_Table_1" href="#"><span>CSV</span></a><a class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="DataTables_Table_1" href="#"><span>Excel</span></a><a class="dt-button buttons-pdf buttons-html5" tabindex="0" aria-controls="DataTables_Table_1" href="#"><span>PDF</span></a><a class="dt-button buttons-print" tabindex="0" aria-controls="DataTables_Table_1" href="#"><span>Print</span></a></div><div id="DataTables_Table_1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="DataTables_Table_1"></label></div><table class="table table-bordered table-striped table-hover dataTable js-exportable" id="DataTables_Table_1" role="grid" aria-describedby="DataTables_Table_1_info">
                        <thead>
                            <tr >
                                
                                <th class="text-center"  tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="padding-right: 10px;">#</th>
                                <th  class="text-center" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="padding-right: 10px;">Image</th>
                                <th  class="text-center" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="padding-right: 10px;">Title</th>
                                <th  class="text-center" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="padding-right: 10px;">Author</th>
                                <th class="text-center" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="padding-right: 10px;"> <i class="material-icons">visibility</i></th>
                                <th class="text-center" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="padding-right: 10px;">Category</th>
                                <th class="text-center" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="padding-right: 10px;">Tag</th>
                                <th class="text-center" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="padding-right: 10px;">Status</th>
                                <th class="text-center" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="padding-right: 10px;">Is_Approve</th>
                                
                                <th class="text-center" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="3" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="">Action</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($posts as $post)
                        <tr role="row" class="odd"  class="text-center">

                                <td class="text-center" class="sorting_1">{{$i++}}</td>
                                <td class="text-center"><img style="max-width:70px;" class="img-responsive img-thumbnail" src="{{ url('storage/post/'.$post->image) }}" alt=""></td>
                                <td class="text-center">{{$post->title}}</td>
                                <td class="text-center">{{$post->user->name}}</td>
                                <td class="text-center">{{$post->view_count}}</td>
                                <td>@foreach ($post->categories as $postCategory)
                                    <span class="badge badge-pill badge-primary" style="background-color: #28A745;">{{$postCategory->name}}</span>
                                @endforeach</td>
                                <td>@foreach ($post->tags as $postTag)
                                    <span class="badge badge-pill badge-primary" style="background-color: #28A745;">{{$postTag->name}}</span>
                                @endforeach</td>
                                <td class="text-center">
                                    @if ($post->status == 1)
                                        <span class="badge badge-pill badge-primary" style="background-color: #0062CC;">Published</span>
                                    @else
                                        <span class="badge badge-pill badge-info" style="background-color: #BD2130">Pending</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($post->is_approved == 1)
                                        <span class="badge badge-pill badge-primary" style="background-color: #0062CC;">Approved</span>

                                    @else
                                        <span class="badge badge-pill badge-primary" style="background-color: #BD2130;">Pending</span>
                                    @endif
                                </td>
                                
                                <td class="text-center" style="padding-left: 0px; padding-right: 0px; width:57px;"><a href="{{route('author.post.show',[$post->id])}}"><i class="material-icons btn btn-info waves-effect">visibility</i></a></td>
                                <td class="text-center" style="padding-left: 0px; padding-right: 0px; width:57px;"><a href="{{route('author.post.edit',[$post->id])}}"><i class="material-icons btn btn-primary waves-effect">edit</i></a></td>
                                <td class="text-center action_btn" style="padding-left: 0px; padding-right: 0px;  width:57px;">
                                    <form method="POST" action="{{route('author.post.destroy',[$post->id])}}" style="width:50px;">
                                        @csrf
                                       @method('Delete')
                                        <button type="submit" style="border:none; background:none; padding:0px; ">
                                            <i class="material-icons btn btn-danger waves-effect">delete</i>
                                        </button>
                                      </form>
                                </td>

                        </tr>
                        @endforeach
                           </tbody>
                    </table><div class="dataTables_info" id="DataTables_Table_1_info" role="status" aria-live="polite">Total Posts {{$posts->count()}}</div><div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_1_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="DataTables_Table_1_previous"><a href="#" aria-controls="DataTables_Table_1" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="DataTables_Table_1" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="DataTables_Table_1" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button "><a href="#" aria-controls="DataTables_Table_1" data-dt-idx="3" tabindex="0">3</a></li><li class="paginate_button "><a href="#" aria-controls="DataTables_Table_1" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button "><a href="#" aria-controls="DataTables_Table_1" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button "><a href="#" aria-controls="DataTables_Table_1" data-dt-idx="6" tabindex="0">6</a></li><li class="paginate_button next" id="DataTables_Table_1_next"><a href="#" aria-controls="DataTables_Table_1" data-dt-idx="7" tabindex="0">Next</a></li></ul></div></div>
                </div>
            </div>
        </div>
    </div>
</div>


@section('script')
     <!-- Jquery DataTable Plugin Js -->
     <script src="{{asset('backend/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
     <script src="{{asset('backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
     <script src="{{asset('backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
     <script src="{{asset('backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
     <script src="{{asset('backend/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
     <script src="{{asset('backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
     <script src="{{asset('backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
     <script src="{{asset('backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
     <script src="{{asset('backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>

     <script src="{{asset('backend/js/pages/tables/jquery-datatable.js')}}"></script>
@endsection

@endsection