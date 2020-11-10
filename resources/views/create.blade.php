@extends('layout')

@section('content')
	
	<div class="container">
			<div class="form-group">
				{!! Form::open(['method' => 'POST', 'route' => 'crkolvo']) !!}
				<input style="width:250px;" type="text" name="kolvo" placeholder="Сколько строк вывести?">
				<button class="btn">Вывести</button>
				{!! Form::close() !!}
			</div>
			<h3>Созданные объявления</h3>
			<table class="table table-striped">
				<thead>
					<th>ID</th>
					<th>Доска</th>
					<th>Заголовок</th>
					<th>Ссылка</th>
					<th>Дата</th>
				</thead>
				<tbody>
					@foreach($ob as $row)
						<tr>
							<td>{{ $row->num }}</td>
							<td>{{ $row->site }}</td>
							<td>{{ $row->title }}</td>
							<td><a href="{{ $row->link }}">{{ $row->link }}</a></td>
							<td>{{ $row->date }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
	</div>
@endsection