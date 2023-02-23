<!DOCTYPE html>
<html>
<head>
	<title>How to upload Multiple Image files with jQuery AJAX and PHP</title>

	<script type="text/javascript" src='jquery-3.4.1.min.js'></script>

	<style type="text/css">
	#preview img{
		margin: 5px;
	}
	</style>
</head>
<body>

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
            @php
                Session::forget('success');
            @endphp
        </div>
     @endif


	<form method='post' action='{{route('image.upload')}}' enctype="multipart/form-data">
        @csrf
		<input type="file" id='files' name="image[]" multiple><br>
		<input type="submit" id="submit" value='Upload'>
	</form>
</body>
</html>