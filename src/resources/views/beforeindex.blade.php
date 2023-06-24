<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>日付別勤怠ページ（当日以外））</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />

  <style>
*{
    margin: 0;
    padding: 0;
    }

     .header{
    background: #fff;
    height : 50px;
    display : flex;
    justify-content: space-between;
  }
  
  .links{
     margin-top: 30px;
     margin-right: 30px;
  }

  .middle{
    height: 500px;
    width: 100%;
    background: #f5f5f5;
   
  }

  .app_header{
    margin-left: 30px;
  }

  .middle_top{
    padding-top: 30px;
    text-align: center;
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
    
  }
  .content_name{
    height: 40px;
    width: 380px;
    text-align: center;
    display: inline-block;
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

  .error{
     color: red;
  }

 .day__button,.day{
   display: inline-block;
 }

 .day__button{
   color: blue;
   background-color: white;
   border-color: blue;
   width:30px;
   height:20px;
   border-width:1px;
 }

  </style>
</head>
<body>
  <div class="header">
    <h1 class="app_header">Atte</h1>
    <div class="links">
    <a href="/" name="link">ホーム</a>
    <a name="link">日付一覧（まだ）</a>
    <a name="link">勤務時間（まだ）</a>
    </div>
  </div>
  <div class="middle">
    <div class="middle_top">
    <form action="{{route('yesterday')}}" method="POST">
    <input type="hidden" value="{{$day}}"  name="day" >
    @csrf
    <button class="day__button" type="submit"><<</button>
    <input type="hidden" value="{{$day}}"  name="day" >
    </form>

    <p class="day">{{$day->format('Y-m-d')}}</p>

    <form action="{{route('tomorrow')}}" method="POST">
    <input type="hidden" value="{{$day}}"  name="day" >
    @csrf
    <button class="day__button" type="submit">>></button>
    <input type="hidden" value="{{$day}}"  name="day" >
    </form>
    <p class="error">{{$nodata??''}}</p>
   </div>
    <div class="contents_hedders">
    <div class="content_hedder">名前</div>
    <div class="content_hedder">勤務開始</div>
    <div class="content_hedder">勤務終了</div>
    <div class="content_hedder">休憩時間</div>
    <div class="content_hedder">勤務時間</div>
    </div>
    <div class="contents">
    @if (@isset($viewDatas))
    @foreach ($viewDatas->unique('user_id') as $viewData)
    <div class="content">{{$viewData->sumrest()}}</div>
    @endforeach
    @endif
    </div>
    
  <div class="end">
    <h3 class="end_content">Atte,inc.</h3>
  </div>
  
</body>

</html>