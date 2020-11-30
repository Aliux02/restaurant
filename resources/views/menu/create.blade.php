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

  <h1>Create new menu</h1>
  <div class="table col-md-8">
    <form action="{{route('menu.store')}}" method="post">
      <label for="title">Title:</label><br>
      <input type="text" id="title" name="title" value=""><br><br>
      <label for="price">	Price:</label><br>
      <input type="text" id="price" name="price" value=""><br><br>
      <label for="weight">Weight:</label><br>
      <input type="text" id="weight" name="weight" value=""><br><br>
      <label for="meat">Meat:</label><br>
      <input type="text" id="meat" name="meat" value=""><br><br>
      <label for="about">About:</label><br>
      <input type="text" id="about" name="about" value=""><br><br>

      <input type="submit" value="Submit"><br><br>
      <button>
        <a href="{{route('menu.index')}}">Back</a>
      </button>
      @csrf
    </form>  
  </div>
</body>
</html>