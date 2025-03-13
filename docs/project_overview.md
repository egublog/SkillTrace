# SkillTrace プロジェクト概要

## プロジェクトの目的

SkillTrace は、ユーザーがプログラミングスキルを管理・共有・追跡するための Web アプリケーションです。ユーザーは自分のプログラミング言語スキルを登録し、そのスキルレベルや具体的な能力、学習の軌跡を記録することができます。また、他のユーザーをフォローしたり、メッセージを交換したりすることで、プログラミングコミュニティとの交流も可能です。

## 主要機能

### ユーザー管理

- ユーザー登録・ログイン機能
- プロフィール編集（画像アップロード、年齢、地域など）

### スキル管理

- プログラミング言語の登録
- スキルレベルの設定（星評価）
- スキル能力の登録（できることリスト）
- スキル履歴の記録（学習の軌跡、カテゴリ別）

### ソーシャル機能

- ユーザーフォロー機能
- メッセージ交換機能
- アクティビティ表示
- ユーザー検索機能

## 技術スタック

### バックエンド

- PHP 7.x
- Laravel 6.x
- MySQL

### フロントエンド

- HTML/CSS
- JavaScript
- Vue.js

### インフラ

- Docker
- AWS S3（画像ストレージ）

## データベース構造

### 主要テーブル

1. **users**: ユーザー情報

   - id, name, email, password, img, age, area_id, language_id, history_id

2. **languages**: プログラミング言語マスタ

   - id, name, favicon

3. **user_languages**: ユーザーとプログラミング言語の関連

   - id, user_id, language_id, star_count

4. **abilities**: ユーザーのスキル能力

   - id, user_language_id, content

5. **traces**: ユーザーのスキル履歴

   - id, user_language_id, img, category_id, content

6. **categories**: スキル履歴のカテゴリマスタ

   - id, name

7. **follows**: フォロー関係

   - id, user_id, user_to_id

8. **talks**: メッセージ
   - id, user_id, user_to_id, talk

## アプリケーション構造

### コントローラー

- **HomeController**: ホーム画面表示
- **ProfileController**: プロフィール管理
- **SkillController**: スキル管理
- **SkillStarController**: スキルレベル管理
- **SkillAbilityController**: スキル能力管理
- **SkillTraceController**: スキル履歴管理
- **FollowerController**: フォロワー表示
- **FollowingController**: フォロー管理
- **TalkController**: メッセージ管理
- **SearchController**: ユーザー検索
- **ActivityController**: アクティビティ表示

### モデル

- **User**: ユーザーモデル
- **Language**: 言語モデル
- **UserLanguage**: ユーザー言語関連モデル
- **Ability**: スキル能力モデル
- **Trace**: スキル履歴モデル
- **Category**: カテゴリモデル
- **Follow**: フォロー関係モデル
- **Talk**: メッセージモデル

### ビュー

- **layouts/default.blade.php**: 共通レイアウト
- **MyService/home.blade.php**: ホーム画面
- **MyService/profile.blade.php**: プロフィール画面
- **MyService/skill-item.blade.php**: スキル詳細画面
- **MyService/skill-edit.blade.php**: スキル編集画面
- **MyService/skill-add.blade.php**: スキル追加画面
- **MyService/friends-list.blade.php**: フォロー/フォロワーリスト
- **MyService/talk.blade.php**: メッセージ一覧
- **MyService/talk-show.blade.php**: メッセージ詳細
- **MyService/search.blade.php**: 検索画面
- **MyService/activity.blade.php**: アクティビティ画面

## 開発環境

Docker Compose を使用して、PHP、Nginx、MySQL の環境を構築しています。
