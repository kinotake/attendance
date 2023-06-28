<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザー一覧ページ</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />

  <style>
   *{
    margin: 0;
    padding: 0;
    }

    .a{
      height: 500px;
      width: 100%;
      background: #f5f5f5;
      }
    .end{
    text-align: center;
    margin-top : 20px;
    }

    .who__button{
    width:295px;
    height:90px;
    margin-right : 10px;
    margin-left : 10px;
    margin-top : 10px;
    font-size : 30px;
    border : none;
    background-color: white;
    }

    .middle{
    display : flex;
    flex-wrap: wrap;
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

    .pagination li{
      display: inline-block;
    }
  </style>
</head>
<body>
  <div class="header">
    <h1 class="app_header">Atte</h1>
  <div>
  <div class="a">
   <p class="introduce">ユーザ一覧</p> 
  <div class="middle">
    @foreach($users as $person)  
      <form action="{{route('who')}}" method="POST">
        <input type="hidden" value="{{$person->id}}"  name="id" >
        @csrf
        <p class="counter">{{$counter++}}</p>
        @if($counter%4==0)
          <button class="who__button" type="submit">{{$person->name}}</button><br />
      </form>
        @else
          <button class="who__button" type="submit">{{$person->name}}</button>
      </form>
        @endif
    @endforeach
  </div>
  <div class="link">{{$users->links()}}</div>
  </div>
  <div class="end">
    <h3 class="end_content">Atte,inc.</h3>
  </div>
</body>
</html>
