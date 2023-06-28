<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>日付別勤怠ページ</title>
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
    text-align: center;
    border-bottom:solid 3px #dcdcdc;
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
 .pagination{
  text-align: center;
 }

 .pagination li{
  display: inline-block;
 }

 .content{
  text-align: center;
  height:40px;
  margin-top : 15px;
  font-size : 25px;
  margin-left: -50px
 }

 .paginationWrap {
    display: flex;
    justify-content: center;
    margin-top: 38px;
    margin-bottom: 40px;
}

.paginationWrap ul.pagination {
    display: inline-block;
    padding: 0;
    margin: 0;
}

.paginationWrap ul.pagination li {
  display: inline;
  margin-right: 4px;
}

.paginationWrap ul.pagination li a {
    color: #2f3859;
    padding: 8px 14px;
    text-decoration: none;
}

.paginationWrap ul.pagination li a.active {
    background-color: #4b90f6;
    color: white;
    border-radius: 40px;
    width: 38px;
    height: 38px;
}

.paginationWrap ul.pagination li a:hover:not(.active) {
    background-color: #e1e7f0;
    border-radius: 40px;
}

.paginationWrap {
    display: flex;
    justify-content: center;
    margin-top: 38px;
    margin-bottom: 40px;
}

.paginationWrap ul.pagination {
    display: inline-block;
    padding: 0;
    margin: 0;
}

.paginationWrap ul.pagination li {
  display: inline;
  margin-right: 4px;
}

.paginationWrap ul.pagination li a {
    color: #2f3859;
    padding: 8px 14px;
    text-decoration: none;
}

.paginationWrap ul.pagination li a.active {
    background-color: #4b90f6;
    color: white;
    width: 38px;
    height: 38px;
}

.paginationWrap ul.pagination li a:hover:not(.active) {
    background-color: #e1e7f0;
}

.link,.dropdown-item{
color : black;
text-decoration: none;
}
  </style>
</head>
<body>
  <div class="header">
    <h1 class="app_header">Atte</h1>
    <div class="links">
    <a href="/" name="link" class="link">ホーム</a>
    <a href="/days" name="link" class="link">日付一覧</a>
    <a href="/users" name="link" class="link">ユーザー一覧</a>
    <a class="dropdown-item" href="{{ route('logout') }}"
    onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
    {{ __('Logout') }}
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
    </form>
</div>
  </div>
  <div class="middle">  
    <div class="middle_top">
    <form action="before/attendance" >
    <button class="day__button"><<</button>
    </form>
    <p class="day">{{$day->format('Y-m-d')}}</p>
    <p class="error">
     {{session('message')}}</p>
   </div>
    <div class="contents_hedders">
    <div class="content_hedder">名前</div>
    <div class="content_hedder">勤務開始</div>
    <div class="content_hedder">勤務終了</div>
    <div class="content_hedder">休憩時間</div>
    <div class="content_hedder">勤務時間</div>
    </div>
    @if (@isset($viewDatas))
    @foreach ($viewDatas->unique('user_id') as $viewData)
    <div class="contents">
    <p class="content">{{$viewData->sumrest()}}</p>
    </div>
    @endforeach
    {{$viewDatas->links('pagination::default')}}
    @endif
    </div>
    
  <div class="end">
    <h3 class="end_content">Atte,inc.</h3>
  </div>
  
</body>

</html>