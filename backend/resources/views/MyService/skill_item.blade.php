@extends('layouts.default')

@section('css', '/css/MyService/skill_item.css')

@section('title', 'スキルの中身')

@section('content')

<section class="skill">

  <div class="skill-box">


    <a class="back" href="{{ action('HomeController@my_home') }}"><span>&lt;</span></a>

    <div class="section-ttl-wrapper">
      <div class="section-ttl">
        <h2>{{ $theSkill->language->name }}</h2>
      </div><!-- /.section-ttl -->
    </div><!-- /.section-ttl-wrapper -->



  </div><!-- /.skill-box -->

  <div class="skill-wrap">
    <div class="inner">

      <div class="skill-top">
        <h3 class="skill-top-ttl">スキルレベル</h3>

        <!-- DBとの連携でその人のその言語に合わせて、⭐️マークの数を変動させたい -->
        <!-- 非同期処理を組み込みたい -->

        <div class="skill-top-box">

          <div class="skill-top-star">
            @for($i = 0; $i < $theSkill->star_count; $i++)
              <span>⭐️</span>
              @endfor
          </div><!-- /.skill-top-star -->

          @if(isset($account))
          @if($account->id == $myId)
          <div class="edit">
            <form name="skill" action="{{ action('SkillController@skill_edit_add_star') }}" method="post">
              @csrf
              <a href="javascript: skill.submit()">
                <i class="fas fa-edit"></i>
              </a>
              <input type="hidden" name="id" value="{{ $theSkill->id }}">
            </form>
          </div><!-- /.edit -->
          @endif
          @endif

        </div><!-- /.skill-top-box -->

      </div><!-- /.skill-top -->

      <div class="skill-middle">
        <h3 class="skill-middle-ttl">できること</h3>

        <!-- DBとの連携でskill_editで書いたことをここに表示させたい -->
        <ul class="skill-middle-list">
          @forelse($skills as $skill)

          <li class="skill-middle-item">{{ $skill->content }}</li>


          @if(isset($account))
          @if($account->id == $myId)

          <div class="edit">
            <form name="ableEdit" action="{{ action('SkillController@skillable_edit') }}" method="post">
              @csrf
              @if(count($skills) == 1)
              <a href="javascript: ableEdit.submit()">
                @endif

                @if(count($skills) >= 2)
                <a href="javascript: ableEdit[{{ $loop->iteration - 1 }}].submit()">
                  @endif
                  <i class="fas fa-edit"></i>
                </a>
                <input type="hidden" name="id" value="{{ $theSkill->id }}">
                <input type="hidden" name="skill_id" value="{{ $skill->id }}">
            </form>
          </div><!-- /.edit -->

          <div class="delete">
            <form name="ableDelete" action="{{ action('SkillController@skillable_delete') }}" method="post">
              @csrf
              @if(count($skills) == 1)
              <a href="javascript: ableDelete.submit()">
                @endif

                @if(count($skills) >= 2)
                <a href="javascript: ableDelete[{{ $loop->iteration - 1 }}].submit()">
                  @endif
                  <i class="fas fa-trash-alt"></i>
                </a>
                <input type="hidden" name="id" value="{{ $theSkill->id }}">
                <input type="hidden" name="skill_id" value="{{ $skill->id }}">
            </form>
          </div><!-- /.delete -->

          @endif
          @endif



          @empty

          <p>skillがありません</p>

          @endforelse
        </ul><!-- /.skill-middle-list -->

        @if(isset($account))
        @if($account->id == $myId)
        <div class="skill-add">
          <form name="skillable" action="{{ action('SkillController@skill_edit_add_able') }}" method="post">
            @csrf
            <a href="javascript: skillable.submit()">
              ＋
            </a>
            <input type="hidden" name="id" value="{{ $theSkill->id }}">
          </form>
        </div><!-- /.skill-add -->
        @endif
        @endif

      </div><!-- /.skill-middle -->

      <div class="skill-bottom">
        <h3 class="skill-bottom-ttl">軌跡</h3>

        <ul class="skill-bottom-list">

          @forelse($traces as $trace)

          <li class="skill-bottom-item">
            <div class="skill-bottom-left">

              <div class="skill-bottom-img">
                @if($trace->img == null)
                <img src="/storage/no_img.png" alt="各々のトプ画">
                @else
                <img src="/storage/trace_images/{{ $trace->img }}" alt="自分のトプ画">
                @endif
              </div><!-- /.skill-bottom-img -->

              <div class="skill-bottom-category">

                <p>{{ $trace->category->name }}</p>

              </div><!-- /.skill-bottom-category -->

            </div><!-- /.skill-bottom-left -->

            <div class="skill-bottom-right">

              <p>{{ $trace->content }}</p>

            </div><!-- /.skill-bottom-right -->
          </li><!-- /.skill-bottom-item -->

          @if(isset($account))
          @if($account->id == $myId)
          <div class="edit">
            <form name="traceEdit" action="{{ action('SkillController@skill_trace_edit') }}" method="post">
              @csrf
              @if(count($traces) == 1)
              <a href="javascript: traceEdit.submit()">
                @endif

                @if(count($traces) >= 2)
                <a href="javascript: traceEdit[{{ $loop->iteration - 1 }}].submit()">
                  @endif
                  <i class="fas fa-edit"></i>
                </a>
                <input type="hidden" name="id" value="{{ $theSkill->id }}">
                <input type="hidden" name="trace_id" value="{{ $trace->id }}">
            </form>
          </div><!-- /.edit -->

          <div class="delete">
            <form name="traceDelete" action="{{ action('SkillController@skill_trace_delete') }}" method="post">
              @csrf
              @if(count($traces) == 1)
              <a href="javascript: traceDelete.submit()">
                @endif

                @if(count($traces) >= 2)
                <a href="javascript: traceDelete[{{ $loop->iteration - 1 }}].submit()">
                  @endif
                  <i class="fas fa-trash-alt"></i>
                </a>
                <input type="hidden" name="id" value="{{ $theSkill->id }}">
                <input type="hidden" name="trace_id" value="{{ $trace->id }}">
            </form>
          </div><!-- /.delete -->
          @endif
          @endif

          @empty

          <p>traceが見つかりませんでした</p>

          @endforelse

        </ul><!-- /.skill-bottom-list -->

        @if(isset($account))
        @if($account->id == $myId)
        <div class="skill-add">
          <form name="trace" action="{{ action('SkillController@skill_edit_add_trace') }}" method="post">
            @csrf
            <a href="javascript: trace.submit()">
              ＋
            </a>
            <input type="hidden" name="id" value="{{ $theSkill->id }}">
          </form>
        </div><!-- /.skill-add -->
        @endif
        @endif

      </div><!-- /.skill-bottom -->


      @if(isset($account))
      @if($account->id == $myId)
      <form class="skill-delete" action="{{ action('SkillController@skill_delete') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $theSkill->id }}">
        <input type="submit" value="このスキルを削除する">
      </form>
      @endif
      @endif

    </div><!-- /.inner -->
  </div><!-- /.skill-wrap -->
</section><!-- /.skill -->



@endsection