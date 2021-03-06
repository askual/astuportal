	@extends('layouts.employee')


@section('css')
<link href="{{url('bower_components/select2/dist/css/select2.min.css')}}" rel="stylesheet">
@endsection	

@section('content')
@widget('SillyPack',['ckeditor' => true ])
@widget('breadcumb',['header'=>'Create Letter ','sub-header'=>'','link0'=>'Home','link1'=>'Office Automation','link9'=>'Create letter'])
<br>

<section class="content">
	<div class="box box-primary">
			<form action="{{route('officeautomation.employee.submit_letter')}}" method="POST">
				@csrf
            <div class="box-header with-border">
              <h3 class="box-title">Compose New Letter</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- <div class="form-group">
                <input class="form-control" placeholder="To:">
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Subject:">
              </div> -->
              <div class="form-group">
					<label>Category</label>
					<select required name="category" class="form-control">
						@foreach($categories as $c)
						<option  value="{{$c['code']}}">{{$c['name']}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label>To</label>
					<select required name="to" class="form-control">
						@foreach($offices as $c)
						<option  value="{{$c->id}}">{{$c->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label>Cc</label>
					<select multiple name="cc[]"  class="form-control select2">
						@foreach($offices as $c)
						<option  value="{{$c->id}}">{{$c->name}}</option>
						@endforeach
					</select>
				</div>
              <div class="form-group">
                    <textarea id="editor1" name="body" class="form-control" style="height: 300px">
                    </textarea>
              </div>
<!--               <div class="form-group">
                <div class="btn btn-default btn-file">
                  <i class="fa fa-paperclip"></i> Attachment
                  <input type="file" name="attachment">
                </div>
                <p class="help-block">Max. 32MB</p>
              </div>
            </div> -->
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
              	<button type="submit" name="draft" class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>
                <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
              </div>
              <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
            </div>
        </form>
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
</section>




@stop



@section('js')
<script type="text/javascript">
  $( "#officeautomation" ).addClass( "active" );
  $( "#officeautomation-Createletter" ).addClass( "active" );
</script>
<script>
  $(function () {
    CKEDITOR.replace('editor1')
  })
</script>

<script src="{{url('bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script>
  $(function () {
    $('.select2').select2()
    $('#EvaluationTable').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })
  $('#level').on('change', function() {
    // alert( this.value );
    $("#theSelect option:selected").attr('disabled','disabled').siblings().removeAttr('disabled');
  });
</script>
@endsection






@section('js2')
<script type="text/javascript"> 
  $( "#staffevaluation" ).addClass( "active" );
  $( "#staffevaluation-Setting" ).addClass( "active" );
</script>
<script>
  $(function () {
    CKEDITOR.replace('editor1')
    CKEDITOR.replace('editor2')
    CKEDITOR.replace('editor3')
    // $('.textarea').wysihtml5()
  })
</script>
@endsection