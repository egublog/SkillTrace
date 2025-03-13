# SkillTrace データモデル

## ER 図

```
+---------------+       +---------------+       +---------------+
| users         |       | languages     |       | areas         |
+---------------+       +---------------+       +---------------+
| id            |       | id            |       | id            |
| name          |       | name          |       | name          |
| email         |       | favicon       |       +---------------+
| password      |       +---------------+
| img           |                |
| age           |                |
| area_id       |----------------+
| language_id   |
| history_id    |
+---------------+
      |
      |
      v
+---------------+       +---------------+       +---------------+
| user_languages|       | abilities     |       | traces        |
+---------------+       +---------------+       +---------------+
| id            |       | id            |       | id            |
| user_id       |------>| user_language_id      | user_language_id
| language_id   |       | content       |       | img           |
| star_count    |       +---------------+       | category_id   |
+---------------+                               | content       |
                                                +---------------+
                                                      |
                                                      |
                                                      v
+---------------+       +---------------+       +---------------+
| follows       |       | talks         |       | categories    |
+---------------+       +---------------+       +---------------+
| id            |       | id            |       | id            |
| user_id       |       | user_id       |       | name          |
| user_to_id    |       | user_to_id    |       +---------------+
+---------------+       | talk          |
                        +---------------+
```

## テーブル定義

### users

ユーザー情報を管理するテーブル

| カラム名    | データ型  | 説明                    |
| ----------- | --------- | ----------------------- |
| id          | bigint    | 主キー                  |
| name        | string    | ユーザー名              |
| email       | string    | メールアドレス（一意）  |
| password    | string    | パスワード              |
| img         | string    | プロフィール画像 URL    |
| age         | tinyint   | 年齢                    |
| area_id     | bigint    | 地域 ID（外部キー）     |
| language_id | bigint    | 主要言語 ID（外部キー） |
| history_id  | bigint    | 経歴 ID（外部キー）     |
| created_at  | timestamp | 作成日時                |
| updated_at  | timestamp | 更新日時                |

### languages

プログラミング言語マスタテーブル

| カラム名   | データ型  | 説明             |
| ---------- | --------- | ---------------- |
| id         | bigint    | 主キー           |
| name       | string    | 言語名           |
| favicon    | string    | 言語アイコン URL |
| created_at | timestamp | 作成日時         |
| updated_at | timestamp | 更新日時         |

### user_languages

ユーザーとプログラミング言語の関連テーブル

| カラム名    | データ型  | 説明                    |
| ----------- | --------- | ----------------------- |
| id          | bigint    | 主キー                  |
| user_id     | bigint    | ユーザー ID（外部キー） |
| language_id | bigint    | 言語 ID（外部キー）     |
| star_count  | tinyint   | スキルレベル（星の数）  |
| created_at  | timestamp | 作成日時                |
| updated_at  | timestamp | 更新日時                |

### abilities

ユーザーのスキル能力テーブル

| カラム名         | データ型  | 説明                        |
| ---------------- | --------- | --------------------------- |
| id               | bigint    | 主キー                      |
| user_language_id | bigint    | ユーザー言語 ID（外部キー） |
| content          | string    | 能力内容                    |
| created_at       | timestamp | 作成日時                    |
| updated_at       | timestamp | 更新日時                    |

### traces

ユーザーのスキル履歴テーブル

| カラム名         | データ型  | 説明                        |
| ---------------- | --------- | --------------------------- |
| id               | bigint    | 主キー                      |
| user_language_id | bigint    | ユーザー言語 ID（外部キー） |
| img              | string    | 画像 URL                    |
| category_id      | bigint    | カテゴリ ID（外部キー）     |
| content          | string    | 履歴内容                    |
| created_at       | timestamp | 作成日時                    |
| updated_at       | timestamp | 更新日時                    |

### categories

スキル履歴のカテゴリマスタテーブル

| カラム名   | データ型  | 説明       |
| ---------- | --------- | ---------- |
| id         | bigint    | 主キー     |
| name       | string    | カテゴリ名 |
| created_at | timestamp | 作成日時   |
| updated_at | timestamp | 更新日時   |

### areas

地域マスタテーブル

| カラム名   | データ型  | 説明     |
| ---------- | --------- | -------- |
| id         | bigint    | 主キー   |
| name       | string    | 地域名   |
| created_at | timestamp | 作成日時 |
| updated_at | timestamp | 更新日時 |

### follows

フォロー関係テーブル

| カラム名   | データ型  | 説明                                  |
| ---------- | --------- | ------------------------------------- |
| id         | bigint    | 主キー                                |
| user_id    | bigint    | フォローするユーザー ID（外部キー）   |
| user_to_id | bigint    | フォローされるユーザー ID（外部キー） |
| created_at | timestamp | 作成日時                              |
| updated_at | timestamp | 更新日時                              |

### talks

メッセージテーブル

| カラム名   | データ型  | 説明                        |
| ---------- | --------- | --------------------------- |
| id         | bigint    | 主キー                      |
| user_id    | bigint    | 送信ユーザー ID（外部キー） |
| user_to_id | bigint    | 受信ユーザー ID（外部キー） |
| talk       | string    | メッセージ内容              |
| created_at | timestamp | 作成日時                    |
| updated_at | timestamp | 更新日時                    |

## リレーションシップ

### User

- User belongs to Area
- User belongs to Language
- User belongs to History
- User has many UserLanguages
- User has many Follows (as follower)
- User has many Follows (as followed)
- User has many Talks (as sender)
- User has many Talks (as receiver)

### Language

- Language has many Users
- Language belongs to many Users through UserLanguages

### UserLanguage

- UserLanguage belongs to User
- UserLanguage belongs to Language
- UserLanguage has many Abilities
- UserLanguage has many Traces

### Ability

- Ability belongs to UserLanguage

### Trace

- Trace belongs to UserLanguage
- Trace belongs to Category

### Category

- Category has many Traces

### Area

- Area has many Users

### Follow

- Follow belongs to User (as follower)
- Follow belongs to User (as followed)

### Talk

- Talk belongs to User (as sender)
- Talk belongs to User (as receiver)
