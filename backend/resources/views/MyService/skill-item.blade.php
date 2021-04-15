@extends('layouts.default')

@section('css', '/css/MyService/skill-item.css')

@section('title', 'スキルの中身')

@section('content')

<div class="inner">
  <section class="skill">
  
    <div class="skill-box">
  
  
      <a class="back" href="{{ route('home.home', ['userId' => $userId]) }}"><span>&lt;</span></a>
  
      <div class="section-ttl-wrapper">
        <div class="section-ttl">
          <h2>{{ $theSkill->language->name }}</h2>
        </div><!-- /.section-ttl -->
      </div><!-- /.section-ttl-wrapper -->
  
  
  
    </div><!-- /.skill-box -->
  
    <div class="skill-wrap">
      <div class="inner">
  
        <div class="skill-top">
          <h3 class="skill-ttl">スキルレベル</h3>
  
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
              <form name="skill" action="{{ route('skill_stars.create', ['userLanguageId' => $userLanguageId]) }}" method="get">
                @csrf
                <a href="javascript: skill.submit()">
                  <i class="fas fa-edit"></i>
                </a>
              </form>
            </div><!-- /.edit -->
            @endif
            @endif
  
          </div><!-- /.skill-top-box -->
  
        </div><!-- /.skill-top -->
  
        <div class="skill-middle">
          <h3 class="skill-ttl">できること</h3>

          <ul class="skill-middle-list">
            @forelse($abilities as $ability)

            <?php $abilityId = $ability->id ?>

            <li class="skill-middle-item">
  
              <p class="skill-middle-txt">{{ $ability->content }}</p>
  
              <div class="edit-delete">
  
                @if(isset($account))
                @if($account->id == $myId)
  


                <div class="edit">
                  <form name="ableEdit" action="{{ route('skill_abilities.show', ['userLanguageId' => $userLanguageId, 'abilityId' => $abilityId]) }}" method="get">
                    @csrf
                    @if(count($abilities) == 1)
                    <a href="javascript: ableEdit.submit()">
                      @endif
  
                      @if(count($abilities) >= 2)
                      <a href="javascript: ableEdit[{{ $loop->iteration - 1 }}].submit()">
                        @endif
                        <i class="fas fa-edit"></i>
                      </a>
                  </form>
                </div><!-- /.edit -->
  
                <div class="delete">
                  <form name="ableDelete" action="{{ route('skill_abilities.destroy', ['userLanguageId' => $userLanguageId, 'abilityId' => $abilityId]) }}" method="post">

                    @csrf
                    @method("delete")

                    @if(count($abilities) == 1)
                    <a href="javascript: ableDelete.submit()">
                      @endif
  
                      @if(count($abilities) >= 2)
                      <a href="javascript: ableDelete[{{ $loop->iteration - 1 }}].submit()">
                        @endif
                        <i class="fas fa-trash-alt"></i>
                      </a>

                  </form>
                </div><!-- /.delete -->
  
                @endif
                @endif
  
              </div><!-- /.edit-delete -->
  
            </li>
  
            @empty
  
            <p class="nothing">できることがありません</p>
  
            @endforelse
          </ul><!-- /.skill-middle-list -->
  
          @if(isset($account))
          @if($account->id == $myId)
          
          <div class="skill-add">
            <form name="skillable" action="{{ route('skill_abilities.create', ['userLanguageId' => $userLanguageId]) }}" method="get">
              @csrf
              <a href="javascript: skillable.submit()">
                ＋
              </a>
              <!-- <input type="hidden" name="id" value="{{ $theSkill->id }}"> -->
            </form>
          </div><!-- /.skill-add -->
          @endif
          @endif
  
        </div><!-- /.skill-middle -->
  
        <div class="skill-bottom">
          <h3 class="skill-ttl">軌跡</h3>
  
          <ul class="skill-bottom-list">
  
            @forelse($traces as $trace)

            <?php $traceId = $trace->id ?>
  
            <li class="skill-bottom-item">
  
              <div class="skill-bottom-item-wrap">
                <div class="skill-bottom-img">
                  @if($trace->img == null)
                  <img src="https://skilltrace-bucket.s3.ap-northeast-1.amazonaws.com/trace_img/no_img.png" alt="各々のトプ画">
                  @else
                  <img src="{{ $trace->img }}" alt="自分のトプ画">
                  @endif
                </div><!-- /.skill-bottom-img -->
    
                <div class="skill-bottom-category">
    
                  <p>{{ $trace->category->name }}</p>
    
                </div><!-- /.skill-bottom-category -->
    
                <p class="skill-bottom-txt">{{ $trace->content }}</p>
              </div><!-- /.skill-bottom-item-wrap -->
  
              <div class="edit-delete">
                @if(isset($account))
                @if($account->id == $myId)
                <div class="edit">
                  <form name="traceEdit" action="{{ route('skill_traces.show', ['userLanguageId' => $userLanguageId, 'traceId' => $traceId]) }}" method="get">
                    @csrf
                    @if(count($traces) == 1)
                    <a href="javascript: traceEdit.submit()">
                      @endif
  
                      @if(count($traces) >= 2)
                      <a href="javascript: traceEdit[{{ $loop->iteration - 1 }}].submit()">
                        @endif
                        <i class="fas fa-edit"></i>
                      </a>

                  </form>
                </div><!-- /.edit -->
  
                <div class="delete">
                  <form name="traceDelete" action="{{ route('skill_traces.destroy', ['userLanguageId' => $userLanguageId, 'traceId' => $traceId]) }}" method="post">

                    @csrf
                    @method("delete")

                    @if(count($traces) == 1)
                    <a href="javascript: traceDelete.submit()">
                      @endif
  
                      @if(count($traces) >= 2)
                      <a href="javascript: traceDelete[{{ $loop->iteration - 1 }}].submit()">
                        @endif
                        <i class="fas fa-trash-alt"></i>
                      </a>

                  </form>
                </div><!-- /.delete -->
                @endif
                @endif
              </div><!-- /.edit-delete -->
  
            </li>
  
            @empty
  
            <p class="nothing">軌跡がありません</p>
  
            @endforelse
  
          </ul><!-- /.skill-bottom-list -->
  
          @if(isset($account))
          @if($account->id == $myId)
          <div class="skill-add">
            <form name="trace" action="{{ route('skill_traces.create', ['userLanguageId' => $userLanguageId]) }}" method="get">
              @csrf
              <a href="javascript: trace.submit()">
                ＋
              </a>
            </form>
          </div><!-- /.skill-add -->
          @endif
          @endif
  
        </div><!-- /.skill-bottom -->
  
  
        @if(isset($account))
        @if($account->id == $myId)
        <form class="skill-delete" action="{{ route('skills.destroy', ['userLanguageId' => $userLanguageId]) }}" method="post">
          @csrf
          @method("delete")
          <input class="btn bg-danger" type="submit" value="このスキルを削除する">
        </form>
        @endif
        @endif
  
      </div><!-- /.inner -->
    </div><!-- /.skill-wrap -->
  </section><!-- /.skill -->
</div><!-- /.inner -->



@endsection