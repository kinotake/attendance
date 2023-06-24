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

    .middle{
    height: 500px;
    width: 100%;
    background: #f5f5f5;
    }
    .end{
    text-align: center;
    margin-top : 20px;
    }
  </style>
</head>
<body>
  <div class="header">
    <h1 class="app_header">Atte</h1>
  <div>
  <div class="middle">
  @foreach($users as $person)  
  <form action="{{route('who')}}" method="POST">
    <input type="hidden" value="{{$person->id}}"  name="id" >
    @csrf
    <button class="who__button" type="submit">{{$person->name}}</button>
  </form>
  @endforeach
  </div>
  
  
  
  <div class="end">
    <h3 class="end_content">Atte,inc.</h3>
  </div>

</body>

</html>
