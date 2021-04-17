@extends('layouts.default')

@section('css', '/css/MyService/activity.css')

@section('title', '通知')

@section('content')

<div class="inner">
    <section class="activity">

        <div class="section-ttl-wrapper">
            <div class="section-ttl">
                <h2>通知</h2>
            </div><!-- /.section-ttl -->
        </div><!-- /.section-ttl-wrapper -->


        <div class="activity-result">
            <ul class="friends-list">

                @forelse($followerAccounts as $followerAccount)

                <?php $friendId = $followerAccount->user_follower->id ?>

                <li class="friends-item">

                    <form name="friend" action="{{ route('home.home', ['userId' => $friendId]) }}" method="get">
                        @csrf

                        @if(count($followerAccounts) == 1)
                        <a href="javascript: friend.submit()">
                            @endif

                            @if(count($followerAccounts) >= 2)
                            <a href="javascript: friend[{{ $loop->iteration - 1 }}].submit()">
                                @endif

                                <div class="friend-img">
                                    @if($followerAccount->user_follower->img == null)
                                    <img src="https://skilltrace-bucket.s3.ap-northeast-1.amazonaws.com/profile_img/no_img.png" alt="各々のトプ画">
                                    @else
                                    <img src="{{ $followerAccount->user_follower->img }}" alt="自分のトプ画">
                                    @endif
                                </div><!-- /.friends-result-img -->

                                <div class="friend-body">

                                    <div class="friend-body-top">
                                        <p>{{ optional($followerAccount->user_follower)->name }}</p>
                                        <span>さんにフォローされました</span>
                                    </div><!-- /.friend-body-top -->

                                    <div class="friend-body-middle">
                                        @if(isset($followerAccount->user_follower->age))
                                        <p>年齢： {{ $followerAccount->user_follower->age }}</p>
                                        @else
                                        <p>年齢： 未登録</p>
                                        @endif

                                        @if(isset($followerAccount->user_follower->area->area))
                                        <p>住所： {{ $followerAccount->user_follower->area->area }}</p>
                                        @else
                                        <p>住所： 未登録</p>
                                        @endif
                                    </div><!-- /.friend-body-middle -->

                                    <div class="friend-body-bottom">
                                        @if(isset($followerAccount->user_follower->history->history))
                                        <p>エンジニア歴： {{ $followerAccount->user_follower->history->history }}</p>
                                        @else
                                        <p>エンジニア歴： 未登録</p>
                                        @endif

                                        @if(isset($followerAccount->user_follower->language->name))
                                        <p>得意言語： {{ $followerAccount->user_follower->language->name }}</p>
                                        @else
                                        <p>得意言語： 未登録</p>
                                        @endif
                                    </div><!-- /.friend-body-bottom -->

                                </div><!-- /.friends-body -->

                            </a>

                    </form>
                </li><!-- /.friend-item -->

                @empty

                <p class="no-hit">見つかりませんでした</p>

                @endforelse

            </ul><!-- /.activity-result-list -->
        </div><!-- /.activity-result -->
    </section><!-- /.activity -->
</div><!-- /.inner -->










@endsection