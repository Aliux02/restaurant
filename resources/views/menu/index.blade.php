<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }
    
    td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }
    
    tr:nth-child(even) {
      background-color: #dddddd;
    }
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
    h1{
      text-align: center;
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
    <button><a href="{{route('menu.create')}}">Add new menu</a><br></button>
    <button><a href="{{route('menu.index')}}">Refresh</a><br></button>
    <button><a href="{{route('home')}}">Back</a><br></button>
    <h1>Menus</h1>
  <table>
    <tr>
      <th>Title</th>
      <th>Price</th>
      <th>Weight</th>
      <th>Meat</th>
      <th>About</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
    @foreach ($menus as $menu)
    <tr>
      <td>{{$menu->title}}</td>
      <td>{{$menu->price}}</td>
      <td>{{$menu->weight}}</td>
      <td>{{$menu->meat}}</td>
      <td>{{$menu->about}}</td> 
      <td><a href="{{route('menu.edit',$menu)}}">Edit</a></td>
      <td><a href="{{route('menu.destroy',$menu)}}">Delete</a></td>
    </tr>
    @endforeach
  </table>
</body>
</html>