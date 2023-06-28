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

    .header{
    background: #fff;
    height : 50px;
  }
  
  .links{
     margin-top: 30px;
     margin-right: 30px;
  }

  .middle{
    height: 500px;
    width: 100%;
    background: #f5f5f5;
    text-align: center;
  }

  .app_header{
    margin-left: 30px;
  }

  .middle_top{
    padding-top: 30px;
    display: flex;
    flex-wrap: nowrap;
    justify-content:center; 
  }

  .contents_hedders{
     border:solid;
     border-color:#dcdcdc;
     border-right: transparent;
     border-left: transparent;
     height: 60px;
     text-align :center;
  }

   .content_hedder{
    display: inline-block;
    text-align: center;
    height: 150px;
    width: 220px;
    margin-top: 22px;
  }
  .contents{
    width:100%;
    display: inline-block; 
  }
  .content_name{
    height: 40px;
    width: 100%;
    text-align: center;
  }

  .content_full{
    height: 40px;
    width: 200px;
    display: inline-block;
 
  }
  .end{
    text-align: center;
    margin-top : 15px;
  }
  .content{
    border-bottom:solid 3px #dcdcdc;
    font-size : 25px;
  }
  </style>
</head>
<body>
  <div class="header">
    <h1 class="app_header">Atte</h1>
  </div>
  <div class="middle">
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
      @foreach ($viewDatas->unique('work_start') as $viewData)
        <div class="content">{{$viewData->datesum()}}</div>
  </div>
      @endforeach
        {{$viewDatas->links()}}
    @endif
  </div>
  <div class="end">
    <h3 class="end_content">Atte,inc.</h3>
  </div>
</body>
</html>