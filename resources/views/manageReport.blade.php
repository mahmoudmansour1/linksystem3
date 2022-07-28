<!DOCTYPE html>
<html>
<head>
	<title>Report</title>
    <link href="/css/style.css" rel="stylesheet">

</head>
<body>

<div class="container">


{!! Form::open(['route'=>'search.report']) !!}



<div class="form-group {{ $errors->has('id') ? 'has-error' : '' }}">
  {!! Form::label('department:') !!}
  {!! Form::select('id',$allCategories, old('id'), ['class'=>'form-control', 'placeholder'=>'Select department']) !!}
  <span class="text-danger">{{ $errors->first('id') }}</span>
</div>


<div class="form-group">
  <button class="btn btn-success">submit</button>
</div>
{!! Form::close() !!}

  <table class="responsive-table">
    <thead>
      <tr>
        <th scope="col">employee name</th>
        <th scope="col">employee department</th>

      </tr>
    </thead>

    <tbody>

        @foreach($employees as $employee)
        <tr>
            <th scope="row">{{ $employee->name }}</th>
            <th scope="row">{{ $employee->categories->title }}</th>
        </tr>  
        @endforeach

    </tbody>
  </table>
</div>

</body>
</html>