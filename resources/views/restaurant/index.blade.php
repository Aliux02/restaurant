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
    <button><a href="{{route('restaurant.create')}}">Add new restaurant</a></button>
    <button><a href="{{route('restaurant.index')}}">Refresh</a></button>
    <button><a href="{{route('home')}}">Back</a><br></button>

    <h1>Restaurants</h1>

    <form action="{{route('restaurant.sort')}}" method="get">

      <label for="menu">Filter restaurant by menu:</label>
      <select name="menu_id" id="menu">
          @foreach ($menus as $menu)
              <option value="{{$menu->id}}">{{$menu->title}}</option>
          @endforeach
      </select>
          <input type="submit" value="Submit"><br><br>
      @csrf
    </form>

    <table>
        <tr>
            <th>Title</th>
            <th>Customers</th>
            <th>Employees</th>
            <th>Menu</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        @foreach ($restaurants as $restaurant)
        <tr>
            <td>{{$restaurant->title}}</td>
            <td>{{$restaurant->customers}}</td>
            <td>{{$restaurant->employees}}</td>
            <td>{{$restaurant->menu['title']}}</td>
            <td>
                <a href="{{route('restaurant.edit',$restaurant)}}">Edit</a>
            </td>
            <td>
                <a href="{{route('restaurant.destroy',$restaurant)}}">Delete</a>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>