@extends('layouts.default')

@section('css', '/css/MyService/skill_edit.css')

@section('title', 'スキルの編集')

@section('content')

<div class="inner">
  <div class="skill">

    <div class="section-ttl-wrapper">
      <div class="section-ttl">
        <h2>{{ $theSkill->language->name }}</h2>
      </div><!-- /.section-ttl -->
    </div><!-- /.section-ttl-wrapper -->


    <div class="skill-wrap">
      <div class="inner">

        @if(isset($stars))
        <form action="{{ action('SkillController@skill_edit_star') }}" method="POST">
          <div class="skill-top">
            <h3 class="skill-edit-ttl">スキルレベル</h3>

            <div class="skill-top-box">
              <p>自己評価：</p>
              <select name="star_count" id="">
                <option value="1">⭐️</option>
                <option value="2">⭐️⭐️</option>
                <option value="3">⭐️⭐️⭐️</option>
                <option value="4">⭐️⭐️⭐️⭐️</option>
                <option value="5">⭐️⭐️⭐️⭐️⭐️</option>
              </select>
            </div><!-- /.skill-top-box -->
          </div><!-- /.skill-top -->
          @endif

          @if(isset($skillables))
          <form action="{{ action('SkillController@skill_edit_able') }}" method="POST">
            <div class="skill-middle">
              <h3 class="skill-edit-ttl">できること</h3>
              <!-- もしもプラスボタンが押されたら -->
              <div class="skill-middle-able">
                <input type="text" name="able">

              </div><!-- /.skill-middle-list -->

            </div><!-- /.skill-middle -->
            @endif

            @if(isset($skillableEdits))
            <form action="{{ action('SkillController@skillable_edit_redirect') }}" method="POST">
              <div class="skill-middle">
                <h3 class="skill-edit-ttl">できること</h3>
                <!-- もしもプラスボタンが押されたら -->
                <div class="skill-middle-able">
                  <input type="text" name="skill_content" value="{{ $skillableEdits->content }}">

                  <input type="hidden" name="skill_id" value="{{ $skillableEdits->id }}">

                </div><!-- /.skill-middle-list -->

              </div><!-- /.skill-middle -->
              @endif

              @if(isset($skill_traces))
              <form action="{{ action('SkillController@skill_edit_trace') }}" method="POST" enctype="multipart/form-data">
                <div class="skill-bottom">
                  <h3 class="skill-edit-ttl">軌跡</h3>

                  <ul class="skill-trace-list">
                    <li class="skill-trace-item">

                      <input type="file" name="trace_img" id="">

                      <select name="category" id="">
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                      </select>

                      <input type="text" name="skill-trace">

                    </li>
                  </ul><!-- /.skill-trace-list -->

                </div><!-- /.skill-bottom -->
                @endif

                @if(isset($traceEdit))
                <form action="{{ action('SkillController@skill_trace_edit_redirect') }}" method="POST" enctype="multipart/form-data">

                  <div class="skill-bottom">
                    <h3 class="skill-edit-ttl">軌跡</h3>

                    <ul class="skill-trace-list">
                      <li class="skill-trace-item">

                        <!-- 一旦画像は保留 -->
                        <div class="skill-trace-img">
                          @if($traceEdit->img == null)
                          <img src="https://skilltrace-bucket.s3.ap-northeast-1.amazonaws.com/trace_img/no_img.png" alt="各々のトプ画">
                          @else
                          <img src="{{ $traceEdit->img }}" alt="自分のトプ画" width="100px" height="100px">
                          @endif
                        </div>

                        <input type="file" name="trace_img">

                        <select name="category_id" id="">
                          @foreach($categories as $category)
                          <option value="{{ $category->id }}">{{ $category->name }}</option>
                          @endforeach
                        </select>

                        <input type="text" name="trace_content" value="{{ $traceEdit->content }}">
                        <input type="hidden" name="trace_id" value="{{ $traceEdit->id }}">

                      </li>
                    </ul><!-- /.skill-trace-list -->

                  </div><!-- /.skill-bottom -->
                  @endif

                  <div class="skill-edit-btn">
                    <input class="btn" type="submit" value="編集完了">
                  </div><!-- /.skill-edit-btn -->

                  <input type="hidden" name="id" value="{{ $theSkill->id }}">
                  @csrf
                </form>
      </div><!-- /.inner -->
    </div><!-- /.skill_item-wrap -->

  </div><!-- /.skill -->

</div><!-- /.inner -->

@endsection