<button type="button" data-id="{{$employee}}" class="edit-staff btn btn-default" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-edit"></i>Edit</button>
<a class="edit-staff btn btn-default" href="{{route('login_as_sth',['type'=>'employee','id'=>$employee->id])}}">Login as User</a>