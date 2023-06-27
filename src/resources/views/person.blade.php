<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>個人用勤怠ページ</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />

  <style>
   *{
    margin: 0;
    padding: 0;
    }
  
    .content_name{
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="header">
    <h1 class="app_header">Atte</h1>
  <div>
    <div class="content_name">{{$name->name}}さんの勤怠情報</div>
    <div class="contents_hedders">
    <div class="content_hedder">日付</div>
    <div class="content_hedder">勤務開始</div>
    <div class="content_hedder">勤務終了</div>
    <div class="content_hedder">休憩時間</div>
    <div class="content_hedder">勤務時間</div>
    </div>
    <div class="contents">
    @if (@isset($viewDatas))
    @foreach ($viewDatas as $viewData)
    <div class="content">{{$viewData->datesum()}}</div>
    @endforeach
    {{$viewDatas->links()}}
    @endif
   
    </div>
  <div class="end">
    <h3 class="end_content">Atte,inc.</h3>
  </div>

</body>

</html>