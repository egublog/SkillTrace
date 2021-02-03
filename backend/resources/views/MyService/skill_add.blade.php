@extends('layouts.default')

@section('css', '/css/MyService/skill_add.css')

@section('title', 'スキルの追加')

@section('content')

<section class="skill_add">

  <div class="section-ttl-wrapper">
    <div class="section-ttl">
      <h2>スキルの追加</h2>
    </div><!-- /.section-ttl -->
  </div><!-- /.section-ttl-wrapper -->

  <form action="{{ action('SkillController@skill_add_save') }}" method="POST">
    {{ csrf_field() }}

    <select class="col-8" id="" name="language_id">

    
      
      @foreach($languages as $language)
      <option value="{{ $language->id }}">{{ $language->name }}</option>
     
      @endforeach

      <!-- pluckメソッドでやる方法もある -->

    </select>


    <input type="submit" value="追加する">
  </form>

</section><!-- /.skill_add -->

@endsection