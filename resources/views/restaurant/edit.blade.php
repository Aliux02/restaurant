<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
    .alert{
      background-color: red;
      width: 400px;
    }
    .alert-info{
      background-color: yellow;
      width: 400px;
    }
    .alert-success{
      background-color: green;
      width: 400px;
    }
    a{
      text-decoration: none;
    }
    .table{
      display: flex;
      justify-content:center;
      margin-top: 100px;
    }
    form{
      text-align: center;
    }
    h1{
      text-align: center;
      margin-top: 100px;
    }
  </style>
</head>
<body>
  @if ($errors->any())
      <div class="alert">
        <ul class="list-group">
          @foreach ($errors->all() as $error)
              <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
  @endif
    
  @if (session()->has('success_message'))
    <div class="alert alert-success">
      {{session()->get('success_message')}}
    </div>
  @endif

  @if (session()->has('info_message'))
  <div class="alert alert-info">
    {{session()->get('info_message')}}
  </div>
  @endif
  <h1>Edit restaurant</h1>
  <div class="table">
    <form action="{{route('restaurant.update',['restaurant'=>$restaurant])}}" method="post">
      <label for="title">Title:</label><br>
      <input type="text" id="title" name="title" value="{{$restaurant->title}}"><br>
      <label for="customers">Customers:</label><br>
      <input type="text" id="customers" name="customers" value="{{$restaurant->customers}}"><br><br>
      <label for="employees">Employees:</label><br>
      <input type="text" id="employees" name="employees" value="{{$restaurant->employees}}"><br><br>
      <label for="menu">Menu:</label><br>
      <select name="menu_id" id="menu">
        @foreach ($menus as $menu)
          <option value="{{$menu->id}}">{{$menu->title}}</option>
        @endforeach
      </select>
      <br><br>
      <input type="submit" value="Submit"><br><br>
      <button><a href="{{route('restaurant.index')}}">Back</a></button>
      @csrf
    </form>
  </div>
</body>
</html>