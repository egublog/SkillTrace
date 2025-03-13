# SkillTrace アーキテクチャ

## 全体構成

SkillTrace は、Laravel 6.x を使用した MVC アーキテクチャに基づく Web アプリケーションです。さらに、リポジトリパターンとユースケースパターンを採用して、ビジネスロジックとデータアクセスの分離を実現しています。

## アーキテクチャ概要図

```
+------------------+     +------------------+     +------------------+
|                  |     |                  |     |                  |
|  Presentation    |     |  Application     |     |  Domain          |
|  Layer           |     |  Layer           |     |  Layer           |
|                  |     |                  |     |                  |
|  - Controllers   |     |  - UseCases      |     |  - Models        |
|  - Views         |     |  - Services      |     |  - Repositories  |
|                  |     |                  |     |  - Interfaces    |
+------------------+     +------------------+     +------------------+
```

## レイヤー構成

### プレゼンテーション層

- **Controllers**: ユーザーからのリクエストを受け取り、適切なユースケースやサービスを呼び出す
- **Views**: ユーザーに表示する UI（Blade テンプレート）

### アプリケーション層

- **UseCases**: 特定のユースケースに対応するビジネスロジックを実装
- **Services**: 共通のビジネスロジックを提供

### ドメイン層

- **Models**: データモデルとビジネスルール
- **Repositories**: データアクセスの抽象化
- **Interfaces**: リポジトリやサービスのインターフェース定義

## 主要コンポーネント

### コントローラー

コントローラーは、ユーザーからのリクエストを受け取り、適切なユースケースやサービスを呼び出します。例えば、`SkillController`は、スキル関連の操作（表示、追加、削除など）を処理します。

```php
class SkillController extends Controller
{
    protected $userAuthService;
    protected $userRepository;
    protected $userLanguageRepository;
    // ...

    public function __construct(
        UserAuthServiceInterface $userAuthService,
        UserRepositoryInterface $userRepository,
        UserLanguageRepositoryInterface $userLanguageRepository,
        // ...
    )
    {
        $this->userAuthService = $userAuthService;
        $this->userRepository = $userRepository;
        $this->userLanguageRepository = $userLanguageRepository;
        // ...
    }

    public function show(int $userId, int $skillId)
    {
        // ビジネスロジックの実行
        // ...

        // ビューの返却
        return view('MyService.skill-item', compact('theSkill', 'traces', 'abilities', 'myId', 'account', 'skillId', 'userLanguageId', 'userId'));
    }

    // ...
}
```

### ユースケース

ユースケースは、特定のユースケースに対応するビジネスロジックを実装します。例えば、`SkillAbilityCreateCase`は、スキル能力の作成に関するビジネスロジックを実装します。

```php
class SkillAbilityCreateCase implements SkillAbilityCreateCaseInterface
{
    protected $userAuthService;
    protected $userLanguageRepository;

    public function __construct(
        UserAuthServiceInterface $userAuthService,
        UserLanguageRepositoryInterface $userLanguageRepository
    )
    {
        $this->userAuthService = $userAuthService;
        $this->userLanguageRepository = $userLanguageRepository;
    }

    public function handle(int $userLanguageId)
    {
        // ビジネスロジックの実装
        // ...

        return $result;
    }
}
```

### サービス

サービスは、共通のビジネスロジックを提供します。例えば、`UserAuthService`は、ユーザー認証に関する機能を提供します。

```php
class UserAuthService implements UserAuthServiceInterface
{
    public function getLoginUserId(): int
    {
        return Auth::id();
    }

    // ...
}
```

### リポジトリ

リポジトリは、データアクセスを抽象化します。例えば、`UserLanguageRepository`は、`UserLanguage`モデルに関するデータアクセスを提供します。

```php
class UserLanguageRepository implements UserLanguageRepositoryInterface
{
    public function findById(int $id)
    {
        return UserLanguage::findOrFail($id);
    }

    public function findByUserIdAndLanguageId(int $userId, int $languageId)
    {
        return UserLanguage::where('user_id', $userId)
            ->where('language_id', $languageId)
            ->first();
    }

    // ...
}
```

### モデル

モデルは、データモデルとビジネスルールを定義します。例えば、`UserLanguage`モデルは、ユーザーとプログラミング言語の関連を表します。

```php
class UserLanguage extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'language_id',
        'star_count',
        'updated_at',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(App\Models\User::class);
    }

    public function language()
    {
        return $this->belongsTo(App\Models\Language::class);
    }

    // ...
}
```

## 依存性注入

Laravel のサービスコンテナを使用して、依存性注入を実現しています。例えば、`AppServiceProvider`で、インターフェースと実装クラスの紐付けを行っています。

```php
class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            UserLanguageRepositoryInterface::class,
            UserLanguageRepository::class
        );

        // ...
    }

    // ...
}
```

## ルーティング

ルートは、`routes/web.php`で定義されています。例えば、スキル関連のルートは以下のように定義されています。

```php
Route::group(['middleware' => 'auth', 'prefix' => 'users', 'as' => 'skills.'], function() {
    Route::get('/{userId}/skills/{skillId}', 'SkillController@show')->name('show');
    Route::get('/skills/create', 'SkillController@create')->name('create');
    Route::post('/skills/create', 'SkillController@store')->name('store');
    Route::delete('/skills/{userLanguageId}', 'SkillController@destroy')->name('destroy');
});
```

## フロントエンド

フロントエンドは、Blade テンプレートと Vue.js を使用しています。例えば、フォローボタンは Vue.js コンポーネントとして実装されています。

```html
<follow-button
  :follow-check="{{ json_encode($followCheck) }}"
  :user-id="{{ json_encode($userId) }}"
></follow-button>
```

## 開発環境

開発環境は、Docker Compose を使用して構築されています。`docker-compose.yml`で、PHP、Nginx、MySQL のコンテナを定義しています。
