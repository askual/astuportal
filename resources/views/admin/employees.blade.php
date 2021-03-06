@extends('layouts.admin')

@section('content')

@widget('breadcumb',['header'=>'Employees','link0'=>'Home','link1'=>'Users','link9'=>'students'])



<section class="content">
  <div class="nav-tabs-custom">
      <div class="tab-content">
        <!-- <table id="StudentsTable" class="table table-bordered table-striped"> -->
        <!-- </table> -->
        <table id="simple-datatable-example" class="display" style="width:100%">
          <thead>
              <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Sex</th>
                  <th>Action</th>
              </tr>
          </thead>
      </table>
      </div>
    </div>
</section>



<div class="modal fade" id="modal-edit">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit Student Info</h4>
          </div>
          <form enctype="multipart/form-data" action="{{route('admin.employees.update')}}" method="POST">
            {{ csrf_field() }}
            <div class="modal-body-detail">
              <h5>Name</h5>
              <input name="id" type="number" id="modalId" hidden>
              <input id="modalName" name="name" class="form-control" type="text">
              <h5>Email</h5>
              <input id="modalEmail" name="email" class="form-control" type="text">
              <h5>Sex</h5>
              <select name="sex" id="modalSex" class="form-control">
                <option value="F">Female</option>
                <option value="M">Male</option>
              </select>
              <h5>Group</h5>
              <input name="group" id="modalGroup" class="form-control" type="number">
              <input name="groupid" id="modalGroupId" hidden type="number">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary"  >Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
@endsection


@section('js')


<script src="{{ url('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables/dataTables.select.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables/dataTables.editor.min.js') }}"></script>
<script>
  $(function () {
    $('#modal-edit').on('show.bs.modal', function(e) {
      var obj = $(e.relatedTarget).data('id');
      $("#modalId").val(obj.id);
      $("#modalName").val(obj.name);
      $("#modalEmail").val(obj.email);
      $("#modalSex").val(obj.sex).change();
      console.log(obj)
    });
  });
</script>
 <script>
        $(document).ready(function() {
            $('#simple-datatable-example').DataTable({
                serverSide: true,
                processing: true,
                responsive: true,
                ajax: "{{ route('admin.employees.datatables') }}",
                columns: [
                    { name: 'name' },
                    { name: 'email' },
                   // { name: 'action', orderable: false, searchable: false }
                    // { name: 'batch_year' },
                    { name: 'sex' },
                    // { name: 'laratablesCustomGroup' },
                    // { name: 'gender' },
                    { name: 'action', orderable: false, searchable: false}
                ],
            });
        });
    </script>
<script type="text/javascript">
  $( "#users" ).addClass( "active" );
  $( "#employees" ).addClass( "active" );
</script>
@endsection



@section('content2')
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Import / Export</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      <div class="col-md-6">
      Export:  
        <a class="btn btn-primary btn-sm" href="{{route('admin.employees.export')}}">Export</a> 
      </div>
      <div class="col-md-6"> 
      Import:  
       <form enctype="multipart/form-data" action="{{route('admin.import.employee')}}" method="POST">{{ csrf_field() }}<input type="file" name="thefile" id="thefile" required class=""><button type="submit" class="btn btn-primary btn-sm">Import</button></form>
      </div>
    </div>
    <div class="box-footer">
      <!-- Footer -->
    </div>
  </div>



<div class="nav-tabs-custom">
      <ul class="nav nav-tabs pull-right">
        <li class="pull-left header"><i class="fa fa-th"></i> Employees</li>

        
      </ul>
      @if(null !== session('importResponse'))
      @if(sizeof(session('importResponse')['error'])  > 0 )
      <div class="alert alert-danger alert-dismissible">
          <h4>Error!</h4>
          @foreach(session('importResponse')['error'] as $error)
          <p>{{$error}}</p>
          @endforeach
      </div>
      @endif
      @if(sizeof(session('importResponse')['success'])  > 0 )
      <div class="alert alert-success alert-dismissible">
          <h4>Success!</h4>
          @foreach(session('importResponse')['success'] as $success)
          <p>{{$success}}</p>
          @endforeach
      </div>
      @endif
      @endif
      <div class="tab-content">
        <table id="StudentsTable" class="table table-bordered table-striped">
          <thead>
            <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Sex</th>
            <th>Initial Password</th>
            <th></th>
            </tr>
          </thead>
          <tbody>
              @foreach($employees as $s)
            <tr class="">
              <td>{{$s->name}}</td>
              <td>{{$s->email}}</td>
              <td>{{$s->sex}}</td>
              <td>{{$s->initial_password}}</td>
              <td>
                <button type="button" data-id="{{$s}}" class="edit-staff btn btn-default" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-edit"></i>Edit</button>
                <!-- <a href="" class="btn btn-default" ><i class="fa fa-edit"></i> Edit </a>  -->
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>


    <div class="modal fade" id="modal-edit">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit Student Info</h4>
          </div>
          <form enctype="multipart/form-data" action="@{{route('admin.edit.students')}}" method="POST">
            {{ csrf_field() }}
            <div class="modal-body-detail">
              <h5>Name</h5>
              <input name="id" type="number" id="modalId" hidden>
              <input id="modalName" name="name" class="form-control" type="text">
              <h5>Email</h5>
              <input id="modalEmail" name="email" class="form-control" type="text">
              <h5>Sex</h5>
              <select name="sex" id="modalSex" class="form-control">
                <option value="F">Female</option>
                <option value="M">Male</option>
              </select>
              <h5>Group</h5>
              <input name="group" id="modalGroup" class="form-control" type="number">
              <input name="groupid" id="modalGroupId" hidden type="number">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary"  >Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>


</section>
@endsection



@section('js2')


<script src="{{ url('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables/dataTables.select.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables/dataTables.editor.min.js') }}"></script>
<script>
  $('#modal-edit').on('show.bs.modal', function(e) {
    var obj = $(e.relatedTarget).data('id');
    $("#modalId").val(obj.id);
    $("#modalName").val(obj.name);
    $("#modalEmail").val(obj.email);
    $("#modalGroup").val(obj.enrolls[0].group);
    $("#modalGroupId").val(obj.enrolls[0].id);
    $("#modalSex").val(obj.sex).change();
    // console.log(obj)
  });
  $(function () {
    $('#StudentsTable').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })
</script>
<script type="text/javascript">
  $( "#users" ).addClass( "active" );
  $( "#employees" ).addClass( "active" );
</script>
@endsection