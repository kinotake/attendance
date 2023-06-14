<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログインページ</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />

  <style>
   *{
    margin: 0;
    padding: 0;
    }
  
  .header{
    background: #fff;
    height : 80px;
    
  }
  
  .app_header{
    margin-left: 30px;
  }

  .middle{
  height: 500px;
    width: 100%;
    background: #f5f5f5;
    text-align :center;
 }
  .button-above{
    text-align :center;
  }

  .button-under{
    text-align :center;
  }

  .name{
    padding: 20px 0px 0px 0px;
    text-align :center;
    font-size: 20px;
  }

  .form__button-submit,.form__button{
    width: 450px;
    height:180px;
    background-color: #FFF;
    font-size: 20px;
    border: none;
    margin: 20px 20px 20px 20px;
  }

  .form__button{
    color: #dcdcdc;
  }


  .form{
    display:inline;
  }

  .end{
    text-align: center;
    margin-top : 15px;
  }

  </style>
</head>
<body>
  <div class="header">
    <h1 class="app_header">Atte</h1>
  <div>
  <div class="middle">
  <p class="name">{{$data->user->name}}さんお疲れ様です！</p>
  <div class="button-above">
    
  <button class="form__button" type="submit">勤務開始
         </button>
   <form class="form" action="/end" method="post">
    @csrf
  <button class="form__button-submit" type="submit">勤務終了
         </button>
   </form>
  </div>
  <div class="button-under">
  <button class="form__button" type="submit">休憩開始
         </button>
  <button class="form__button" type="submit">休憩終了
         </button>
  </div>
  </div>
  <div class="end">
    <h3 class="end_content">Atte,inc.</h3>
  </div>
</body>
</body>

</html>