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
    height : 80px;
    
  }
  
  .middle{
    height: 500px;
    width: 100%;
    background: #f5f5f5;
    text-align :center;
  }

  .app_header{
    margin-left: 30px;
  }

  .middle_top{
    padding-top: 30px;
    text-align: center;
  }

  .contents_hedder{
     border:solid;
     border-color:#dcdcdc;
     border-right: transparent;
     border-left: transparent;
     height: 70px;
     text-align :center;
     
  }

  .content{
    display: inline-block;
    text-align: center;
    height: 150px;
    width: 220px;
    margin-top: 22px;
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
    <div class="middle_top">
    <p>日付が入る</p>
    </div>
    <div class="contents_hedder">
    <div class="content">名前</div>
    <div class="content">勤務開始</div>
    <div class="content">勤務終了</div>
    <div class="content">休憩時間</div>
    <div class="content">勤務時間</div>
    </div>
    <div class="contents_hedder">
    <div class="content">名前1</div>
    <div class="content">勤務開始1</div>
    <div class="content">勤務終了1</div>
    <div class="content">休憩時間1</div>
    <div class="content">勤務時間1</div>
    </div>
    <div class="contents_hedder">
    <div class="content">名前2</div>
    <div class="content">勤務開始2</div>
    <div class="content">勤務終了2</div>
    <div class="content">休憩時間2</div>
    <div class="content">勤務時間2</div>
    </div>
    <div class="contents_hedder">
    <div class="content">名前3</div>
    <div class="content">勤務開始3</div>
    <div class="content">勤務終了3</div>
    <div class="content">休憩時間3</div>
    <div class="content">勤務時間3</div>
    </div>
    <div class="contents_hedder">
    <div class="content">名前4</div>
    <div class="content">勤務開始4</div>
    <div class="content">勤務終了4</div>
    <div class="content">休憩時間4</div>
    <div class="content">勤務時間4</div>
    </div>
    <div class="contents_hedder">
    <div class="content">名前5</div>
    <div class="content">勤務開始5</div>
    <div class="content">勤務終了5</div>
    <div class="content">休憩時間5</div>
    <div class="content">勤務時間5</div>
    </div>
   </div>
  <div class="end">
    <h3 class="end_content">Atte,inc.</h3>
  </div>
</body>

</html>