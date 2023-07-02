<!DOCTYPE html>
<html>



<head>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-theme.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	<h1 style="text-align:center;" > Search On Technical  Competency</h1>
</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
<style>

	.highlight
	{
		background: yellow;
		font-weight: bold;
	}


</style>
<script>
	myFunction = function() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue, index;
  input = document.getElementById("search");
  filter = input.value.toUpperCase();
  table = document.getElementById("res");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;

      // first clear any previously marked text
      // this strips out the <mark> tags leaving text (actually all tags)
      td.innerHTML = txtValue;

      index = txtValue.toUpperCase().indexOf(filter);
      if (index > -1) {

        // using substring with index and filter.length 
        // nest the matched string inside a <mark> tag
        td.innerHTML = txtValue.substring(0, index) + "<mark>" + txtValue.substring(index, index + filter.length) + "</mark>" + txtValue.substring(index + filter.length);

        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>


<style>
	@media (min-width: 768px) {
  .modal-xl {
    width: 90%;
   max-width:1200px;
  }
}
</style>



<body>
<div class="container-fluid">

	<form action="{{ route('web.search') }}" method="GET"  role="form">
		<div class="form-group">
			<label for="exampleInputEmail1">Masukan kata Kunci Pencarian</label>
			<input type="text" id = "search" name="cari" class="form-control" placeholder="Masukan kata kunci..." >
		</div>

		<div class="form-group">
			<label for="disabledSelect">FIlter Industri</label>
			<div class="form-check form-check-inline">
			@foreach($dfindustri as $p)
			@php
				$checked = [];
				if(isset($_GET['industri']))
				{
					$checked = $_GET['industri'];
					// dd($checked);
				}
			@endphp
				<input type="checkbox" name='industri[]' value='{{$p->pki}}'
				@if(in_array($p->pki, $checked)) checked @endif/>
				<label for="inlineCheckbox1">{{ $p->Industry }}</label>
			@endforeach
			</div>
			
		</div>

		<div class="form-group">
			<label for="disabledSelect">FIlter Skill Group</label>
			
			<select name='Skill[]' id="multiple-checkboxes" class="form-control" multiple="multiple">
				@foreach($dfskillgroup as $p)
				@php
				$checked1 = [];
				if(isset($_GET['Skill']))
				{
					$checked1 = $_GET['Skill'];
					// dd($checked);
				}
				@endphp
					<option value='{{$p->pkg}}' 
						@if (in_array($p->pkg, $checked1))
						selected="selected"
						@endif>
						{{ $p->skillgroup }}
					</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label for="disabledSelect">Filter Sub-Skill Group</label>

			<select name='subskill[]' id="multiple-checkboxes2" class="form-control" multiple="multiple">
				@foreach($dfsubskill as $p)
				@php
				$checked2 = [];
				if(isset($_GET['subskill']))
				{
					$checked2 = $_GET['subskill'];
					// dd($checked);
				}
				@endphp
					<option value='{{$p->pks}}'
						@if (in_array($p->pks, $checked2))
						selected="selected"
						@endif>
						{{ $p->subskillgroup }}
					</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-default">SEARCH</button>
		</div>
	
</form>


<!-- Navbar items -->

<div>

<button class="btn btn-primary m-2" data-toggle="modal" data-target="#demoModal" value = "1">4 level generic</button>
<button class="btn btn-primary m-2" data-toggle="modal" data-target="#demoModal1" value = "1">5 level generic</button>


</div>

<h2> Hasil Pencarian Kalimat : {{ $keyw }}</h2>

<table id = "res" class="table table-bordered">

		<tr>
			<th>Industry</th>
			<th>Skill Group</th>
            <th>Sub Skill Group</th>
			<th>Nama Kompetensi Teknis</th>
			<th>Definisi</th>
			<th>1.(Awareness / Aware)</th>
            <th>2.(Fundamental Application / Novice / Practiced / Knowledgeable)</th>
			<th>3.(Skillfull Application / Intermediate / Competent / Skilled)</th>
            <th>4.(Mastery / Advanced / Proficient)</th>
			<th>5.(Expert)</th>
		</tr>
		@foreach($teccom as $p)
		<tr>
			
			<td> 
				{{ $p->Industry }}
			</td>
			<td>{{ $p->skillgroup }}</td>
			<td>{{ $p->subskillgroup }}</td>
			<td>{{ $p->NamaKompetensiTeknis }}</td>
			<td>{{ $p->Definisi }}</td>
			

			@if ( $p->level1  === "" OR $p->level2  === "" OR $p->level2  === "" OR $p->level3  === "" OR $p->level4  === "" )
				<td class="text-center"> </td>
				<td>{{ $p->level2 }}</td>
				<td>{{ $p->level3 }}</td>
				<td>{{ $p->level4 }}</td>
				<td>{{ $p->level5 }}</td>
			@else
				<td>{{ $p->level1 }}</td>
				<td>{{ $p->level2 }}</td>
				<td>{{ $p->level3 }}</td>
				<td>{{ $p->level4 }}</td>
				<td>{{ $p->level5 }}</td>
			@endif

			
            
		</tr>
		@endforeach

		
</table>

{{ $teccom -> links() }}

<div class="modal fade" id="demoModal">
	<div class="modal-dialog modal-xl">
	<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title">Modal title</h4>
		</div>
		<div class="modal-body">
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th>1.(Awareness / Basic / Foundational)</th>
						<th>2.(Fundamental / Working / Intermediate)</th>
						<th>3.(Skillful / Extensive / Advanced)</th>
						<th>4.(Mastery / Expert / Leader)</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						@foreach($gen4 as $p)
						<tr>
							<td>{{ $p->level1 }}</td>
							<td>{{ $p->level2 }}</td>
							<td>{{ $p->level3 }}</td>
							<td>{{ $p->level4 }}</td>
							<td>{{ $p->Industry }}</td>

						</tr>
						@endforeach

					</tr>
				</tbody>
			</table>
			{{-- {{ $gen4 -> links() }} --}}

		</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>

<div class="modal fade" id="demoModal1">
	<div class="modal-dialog modal-xl">
	<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title">Modal title</h4>
		</div>
		<div class="modal-body">
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th>1.(Awareness)</th>
						<th>2.(Novice / Basic)</th>
						<th>3.(Intermediate)</th>
						<th>4.(Advanced)</th>
						<th>5.(Expert / Master)</th>

					</tr>
				</thead>
				<tbody>
					<tr>
						@foreach($gen5 as $p)
						<tr>
							<td>{{ $p->level1 }}</td>
							<td>{{ $p->level2 }}</td>
							<td>{{ $p->level3 }}</td>
							<td>{{ $p->level4 }}</td>
							<td>{{ $p->level5 }}</td>
							<td>{{ $p->Industry }}</td>

						</tr>
						@endforeach

					</tr>
				</tbody>
			</table>
			{{-- {{ $gen5 -> links() }} --}}

		</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>



<script>
	    $(document).ready(function() {
        $('#multiple-checkboxes').multiselect({
        includeSelectAllOption: true,
        });
		
    });
</script>
<script>
	$(document).ready(function() {
	$('#multiple-checkboxes2').multiselect({
	includeSelectAllOption: true,
	});
});
</script>


</body>
</html>

