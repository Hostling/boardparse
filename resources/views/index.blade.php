@extends('layout')

@section('content')
	
	<div class="container">

		<!--
		<div class="form-group">
			{!! Form::open(['method' => 'POST', 'route' => 'kolvo']) !!}
			<input style="width:250px;" type="text" name="kolvo" placeholder="Сколько объявлений вывести?">
			<button class="btn">Вывести</button>
			{!! Form::close() !!}
			
		</div>
		-->

		<?php $boards = new App\Board(); ?>
		{{ $posts->render() }}

		<table class="table table-striped">
			<!--<th>Массовая заливка<br />
			<a href="#" onclick="checkall()">Выбрать все</a>
			</th>-->
		<th>Номер</th><th>Название</th><th>Описание</th><th>Дата</th><th>Ссылка</th><th>Цена</th><th>Картинки</th><th>Загрузка объявления</th>
		@foreach($posts as $tovar)
			<tr>
				<!--<td>
					@foreach($boards->boards as $board)
						
						<p class="forlab">{{ $board }}</p>
						<input type="checkbox" name="{{ $board }}" value="{{ $tovar->ID }}" id="{{ $board.$tovar->ID }}" {{ $boards->isChecked($tovar->ID, $board) }}><label for="{{ $board.$tovar->ID }}"></label>

					@endforeach
				</td>-->
				<td>
					{{ $tovar->ID }}
				</td>
				<td>
					{{ $boards->getTitle($tovar->post_title) }}
				</td>
				<td>
					{{ $boards->getDescr($tovar->post_excerpt) }}
				</td>
				<td>
					{{ $tovar->post_date }}
				</td>
				<td>
					<a href="{{ $tovar->guid }}" target='_blank'>Открыть на сайте</a>
				</td>
				<td>
					{{ $boards->getPrice($tovar->ID) }}
				</td>
				<td>
					<img src="{{ $boards->getImage($tovar->ID) }}" style="max-width:200px;" />
				</td>
				<td>
					@foreach($boards->boards as $board)

						<a href="{{ route('createOb', ['num' => $tovar->ID, 'board' => $board]) }}" class="btn btn-{{ $boards->isChecked($tovar->ID, $board)=="checked"?"danger":"success" }}">{{ $board }}</a>

					@endforeach
				</td>
			</tr>
		@endforeach
		</table>
		{{ $posts->render() }}
	</div>
	<script src="js/board.js"></script>
	<script src="js/jquery.js"></script>
	<script src="js/npm.js"></script>
@endsection