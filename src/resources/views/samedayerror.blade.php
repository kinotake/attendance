<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>本日は出勤済みです。</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />

  <style>
   *{
    margin: 0;
    padding: 0;
    }

    .contents{
    text-align: center;
    }
  </style>
</head>
<body>
  <div class="contents">
    <p>本日は既に出勤済みです。</p>
    <a href="/attendance" name="link">本日の勤怠情報一覧</a>
  </div>
</body>