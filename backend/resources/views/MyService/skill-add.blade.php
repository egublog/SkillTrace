@extends('layouts.default')

@section('css', '/css/MyService/skill-add.css')

@section('title', 'スキルの追加')

@section('content')

<div class="inner">
  <section class="skill-add">

    <div class="section-ttl-wrapper">
      <div class="section-ttl">
        <h2>スキルの追加</h2>
      </div><!-- /.section-ttl -->
    </div><!-- /.section-ttl-wrapper -->

    <form action="{{ route('skills.store') }}" method="POST">
      @csrf

      @if ($errors->has('language_id'))
      <div class="alert alert-danger mt-3 mx-5">
        <ul>

          <li>{{ $errors->first('language_id') }}</li>

        </ul>
      </div>
      @endif

      <select class="skill-add-select" id="" name="language_id">

        <option value="">選択してください</option>
        @foreach($languages as $language)
        <option value="{{ $language->id }}">{{ $language->name }}</option>
        @endforeach

      </select>

      <div class="skill-add-btn">
        <input class="my-5 btn" type="submit" value="追加する">
      </div><!-- /.skill-add-btn -->

    </form>

  </section><!-- /.skill-add -->
</div><!-- /.inner -->

@endsection
