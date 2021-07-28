@extends('layouts.admin')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
        </div>
    </div>
</div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col pt-md-12">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Region</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('admin.region.add') }}" class="btn btn-sm btn-primary">Add Region</a>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                                        
                 <div class="table-responsive">
                    <table id="datatable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>                    
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript" src="{{ asset('admin/argon/vendor/datatable/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/argon/vendor/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script type="text/javascript">
    var slno = 0;
    var baseurl = "{{ url('/') }}";

    var view    =   "{{ route('admin.region.view', ['id' => '__id']) }}";
    var edit = "{{ route('admin.region.edit',['id'=>'__id']) }}";
    var deletelink = "{{ route('admin.region.delete',['id'=>'__id']) }}";
    
    var cmsdatatable = $("#datatable").DataTable({
    "pageLength": 25,
    "responsive": true,
    "serverSide": true,
    "ordering": true,
    "aaSorting": [],
    "processing": true,
    "order": [[0, "desc"]],
    "columnDefs": [
        { orderable: false, targets: [0] },
        { "width": "5%", "targets": 0, className: "text-center" },
    ],
    "language": {
        "searchPlaceholder": 'Search...',
        "sSearch": '',
        "infoFiltered": " ",
        'loadingRecords': '&nbsp;',
        'processing': ''
    },
    "ajax": {
        "url": "{{ route('admin.region.paginate') }}",
        "type": "post",
        "data": function (data) {
            data._token = "{{ csrf_token() }}";
            return data;
        }
    },
    "AutoWidth": false,
    "columns": [
        { "data": "slno", "name": "slno", "render": function(data, type, row){
                return ++slno;
            } 
        },
        {"data": "name"},
        { "data": "stat", "name": "stat", "render": function(data,type,row){
            if(row.status==1){
                return "{{ __('Active') }}";
            }else{
                return "{{ __('Inactive') }}";
            }
        }},
        {
            "data": "action", "name": "action", "render": function (data, type, row) {
                action = "<a class='edit btn btn-info' href='"+view.replace("__id",row.id)+"'><i class='fa fa-eye'></i></a>";
                action += "<a class='edit btn btn-info' href='"+edit.replace("__id",row.id)+"'><i class='fa fa-edit'></i></a>";
                action += "<a class='btn btn-danger' onclick='return confirm(\"Are you sure to delete this region? \")' href='"+deletelink.replace("__id",row.id)+"'><i class='fa fa-trash'></i></a>";
                return action;
            }
        }
    ],
    "fnCreatedRow": function (nRow, aData, iDataIndex) {
        //loadingShow();
        var info = this.dataTable().api().page.info();
        var page = info.page;
        var length = info.length;
        var index = (page * length + (iDataIndex + 1));
        $('td:eq(0)', nRow).html(index).addClass('text-center');
    },
    "fnDrawCallback": function (oSettings) {
        var info = this.dataTable().api().page.info();
        var totalRecords = info.recordsDisplay;
        //loadingHide();
        $('[data-toggle="popover"]').popover({ trigger: 'hover' });
        //updateTotalRecordsCount("total-records-orders", totalRecords);
    }
});
    
</script>
@endpush