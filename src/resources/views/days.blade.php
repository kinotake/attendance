<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>日付一覧ページ</title>
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

  .end{
    text-align: center;
    margin-top : 340px;
  }

 .pagination{
  text-align: center;
 }

 .pagination li{
  display: inline-block;
 }

 .day__button{
    width:300px;
    height:100px;
    margin-right : 10px;
    margin-left : 10px;
    font-size : 30px;
    border : none;
    background-color: white;
 }

 .middle_top{
    display : flex;
 }
 .introduce{
  padding-top : 10px;
  text-align: center;
  font-size : 20px;
 }

 .counter{
      font-size : 1px;
      display:block;
      display:none;
    }

  .link{
    text-align: center;
  }

  </style>
</head>
<body>
  <div class="header">
    <h1 class="app_header">Atte</h1>
  </div>
  <div class="middle">
    <p class="introduce">日付別勤怠一覧</p>  
    <div class="middle_top">
    
    @foreach ($allTodays as $allToday)
    <form action="{{route('today')}}" method="POST">
    <input type="hidden" value="{{$allToday}}"  name="allToday" >
    @csrf
    <p class="counter">{{$counter++}}</p>
    @if($counter%4==0)
    <button class="day__button" type="submit">{{$allToday}}</button><br />
    <input type="hidden" value="{{$allToday}}"  name="allToday" >
    </form>
    @else
    <button class="day__button" type="submit">{{$allToday}}</button>
    </form>
    @endif
    @endforeach
    <div class="link">{{$allTodays->links()}}</div>
  </div>
  <div class="end">
    <h3 class="end_content">Atte,inc.</h3>
  </div>
  
</body>

</html>