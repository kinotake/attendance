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
    margin-top : 420px;
  }

 .pagination{
  text-align: center;
 }

 .pagination li{
  display: inline-block;
 }

  </style>
</head>
<body>
  <div class="header">
    <h1 class="app_header">Atte</h1>
  </div>
  <div class="middle">  
    <div class="middle_top">
   </div>
    
    @foreach ($allTodays as $allToday)
    <form action="{{route('today')}}" method="POST">
    <input type="hidden" value="{{$allToday}}"  name="allToday" >
    @csrf
    <button class="day__button" type="submit">{{$allToday}}</button>
    <input type="hidden" value="{{$allToday}}"  name="allToday" >
    </form>
    @endforeach
    
    {{$allTodays->links()}}
   
    
  <div class="end">
    <h3 class="end_content">Atte,inc.</h3>
  </div>
  
</body>

</html>