@extends('layouts.default')

@section('css', '/css/MyService/skill-edit.css')

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
        <form action="{{ route('skill_stars.update', ['userLanguageId' => $userLanguageId]) }}" method="POST">

          @method("put")
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

          @if(isset($abilities))
          <form action="{{ route('skill_abilities.store', ['userLanguageId' => $userLanguageId]) }}" method="POST">

            <div class="skill-middle">

              <h3 class="skill-edit-ttl">できること</h3>

              <!-- エラー処理 -->
              @if ($errors->has('ability'))
              <div class="alert alert-danger mt-3">
                <ul>

                  @foreach($errors->get('ability') as $error)
                  <li>{{ $error }}</li>
                  @endforeach

                </ul>
              </div>
              @endif

              <div class="skill-middle-able">
                <input type="text" name="ability">
              </div><!-- /.skill-middle-list -->

            </div><!-- /.skill-middle -->
            @endif

            @if(isset($abilityEdit))
            <form action="{{ route('skill_abilities.update', ['userLanguageId' => $userLanguageId, 'abilityId' => $abilityId]) }}" method="POST">

              @method("PUT")

              <div class="skill-middle">

                <h3 class="skill-edit-ttl">できること</h3>

                <!-- エラー処理 -->
                @if ($errors->has('ability'))
                <div class="alert alert-danger mt-3">
                  <ul>

                    @foreach($errors->get('ability') as $error)
                    <li>{{ $error }}</li>
                    @endforeach

                  </ul>
                </div>
                @endif

                <div class="skill-middle-able">
                  <input type="text" name="ability" value="{{ $abilityEdit->content }}">
                </div><!-- /.skill-middle-list -->

              </div><!-- /.skill-middle -->
              @endif

              @if(isset($traces))
              <form action="{{ route('skill_traces.store', ['userLanguageId' => $userLanguageId]) }}" method="POST" enctype="multipart/form-data">

                <div class="skill-bottom">
                  <h3 class="skill-edit-ttl">軌跡</h3>

                  <!-- エラー処理 -->
                  @if ($errors->has('trace_img'))
                  <div class="alert alert-danger mt-3">
                    <ul>

                      @foreach($errors->get('trace_img') as $error)
                      <li>{{ $error }}</li>
                      @endforeach

                    </ul>
                  </div>
                  @endif

                  <ul class="skill-trace-list">
                    <li class="skill-trace-item">

                      <input type="file" name="trace_img" id="">

                      <select name="category" id="">
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                      </select>

                      <!-- エラー処理 -->
                      @if ($errors->has('trace'))
                      <div class="alert alert-danger mt-3">
                        <ul>

                          @foreach($errors->get('trace') as $error)
                          <li>{{ $error }}</li>
                          @endforeach

                        </ul>
                      </div>
                      @endif

                      <input type="text" name="trace">

                    </li>
                  </ul><!-- /.skill-trace-list -->

                </div><!-- /.skill-bottom -->
                @endif

                @if(isset($traceEdit))
                <form action="{{ route('skill_traces.update', ['userLanguageId' => $userLanguageId, 'traceId' => $traceId]) }}" method="POST" enctype="multipart/form-data">

                  @method("put")

                  <div class="skill-bottom">
                    <h3 class="skill-edit-ttl">軌跡</h3>

                    <ul class="skill-trace-list">
                      <li class="skill-trace-item">

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

                        <!-- エラー処理 -->
                        @if ($errors->has('trace'))
                        <div class="alert alert-danger mt-3">
                          <ul>

                            @foreach($errors->get('trace') as $error)
                            <li>{{ $error }}</li>
                            @endforeach

                          </ul>
                        </div>
                        @endif

                        <input type="text" name="trace" value="{{ $traceEdit->content }}">

                      </li>
                    </ul><!-- /.skill-trace-list -->

                  </div><!-- /.skill-bottom -->
                  @endif

                  <div class="skill-edit-btn">
                    <input class="btn" type="submit" value="編集完了">
                  </div><!-- /.skill-edit-btn -->

                  @csrf
                </form>
      </div><!-- /.inner -->
    </div><!-- /.skill-wrap -->

  </div><!-- /.skill -->

</div><!-- /.inner -->

@endsection