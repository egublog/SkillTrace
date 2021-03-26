@extends('layouts.default')

@section('css', '/css/MyService/skill_add.css')

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

      <select class="skill-add-select" id="" name="language_id">

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