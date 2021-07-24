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
                            <h3 class="mb-0">Roles</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="#" onclick="return addrole()" class="btn btn-sm btn-primary">Add New Role</a>
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
<div id="addModal" class="modal fade" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:1250px;">
        <div class="modal-content">
            <div class="row">
                <div class="col pt-md-12">
            <form method="post" id="createrole" action="{{ route('admin.roles.create') }}" autocomplete="off">
                @csrf
                <div class="pl-lg-4">
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                        <input type="text" value="" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}"  autofocus>
                        <span class="invalid-feedback" role="alert">
                            <strong></strong>
                        </span>
                    </div>
                </div>
                <div class="pl-lg-4">
                    <div class="form-group{{ $errors->has('status')? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-status">{{ __('Status') }}</label>
                        <select name="status" id="input-status" class="form-control form-control-alternative{{ $errors->has('status') ? ' is-invalid' : '' }}" >
                            <option>Select</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        <span class="invalid-feedback" role="alert">
                            <strong></strong>
                        </span>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success mt-4">{{ __('Create') }}</button>
                    <a href="{{ route('admin.roles') }}" class="btn mt-4">Cancel</a>
                </div>
            </form>      
        </div>
    </div>
        </div>
    </div>
</div>
<div id="editModal" class="modal fade" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:1250px;">
        <div class="modal-content">
            <div class="row">
                <div class="col pt-12">
                    
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

    var edit = "{{ route('admin.roles.edit',['id'=>'__id']) }}";
    var deletelink = "{{ route('admin.roles.delete',['id'=>'__id']) }}";
    
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
        "url": "{{ route('admin.roles.paginate') }}",
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
        { "data": "name"},
        { "data": "stat", "name": "stat", "render": function(data,type,row){
            if(row.status==1){
                return "{{ __('Active') }}";
            }else{
                return "{{ __('Inactive') }}";
            }
        }},
        {
            "data": "action", "name": "action", "render": function (data, type, row) {
                action = "";
                action += "<a class='edit btn btn-info' href='"+edit.replace("__id",row.id)+"'><i class='fa fa-edit'></i></a>";
                action += "<a class='btn btn-danger' onclick='return confirm(\"Are you sure to delete this material? \")' href='"+deletelink.replace("__id",row.id)+"'><i class='fa fa-trash'></i></a>";
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
    function addrole()
    {
        $("#addModal").modal("show");
        return false;
    }
    $(document).ready(function(){
        $("#createrole").submit(function(){
             $("#createrole").find('span.invalid-feedback').find('strong').html('');
            var formdata    =   $(this).serialize();
            var url         =   $(this).attr('action');
            $.ajax({
                url : url,
                type: 'post',
                data: formdata,
                dataType: 'json'
            }).done(function(data){
                if(data.status==1)
                {
                    alert("Role created successfully");
                    window.location.reload();
                }else{
                    alert("Something went wrong");
                }
            }).fail(function(data){ 
                if(data.responseJSON.errors){
                    $.each(data.responseJSON.errors, function(key, val){
                        $("#createrole").find('[name="'+key+'"]').closest('div').find('span.invalid-feedback').find('strong').html(val[0]);
                    });
                }
            });
            return false;
        });

    });

    $(document).on("click", ".edit", function(){
        var url = $(this).attr('href');
        $.ajax({
            url : url
        }).done(function(data){
            $("#editModal").find('div.modal-content').html(data);
            $("#editModal").modal("show");
        })
        return false;
    });

    $(document).on("submit", "#updaterole", function(){
        var formdata = $(this).serialize();
        var url = $(this).attr("action");
        $("#updaterole").find('span.invalid-feedback').find('strong').html('');
        $.ajax({
            url : url,
            type: 'post',
            dataType: 'json',
            data: formdata
        }).done(function(data){
            if(data.status==1)
            {
                alert("Role updated successfully");
                window.location.reload();
            }else{
                alert("Something went wrong");
            }
        }).fail(function(data){ 
            if(data.responseJSON.errors){
                $.each(data.responseJSON.errors, function(key, val){
                    $("#updaterole").find('[name="'+key+'"]').closest('div').find('span.invalid-feedback').find('strong').html(val[0]);
                });
            }
        });
        return false;
    });

    $(document).on("click", ".deletemenu", function(){
        var url = $(this).attr('href');
        var r = confirm("Are you sure to delete this menu item?");
        if(r)
        {
            $.ajax({
                url : url,
                dataType: 'json'
            }).done(function(data){
                if(data.status==1)
                {
                    alert("Menu deleted successfully");
                    window.location.reload();
                }else{
                    alert("Something went wrong");
                }
            }).fail(function(data){
                alert("Something went wrong");
            });
        }
        return false;
    })
</script>
@endpush