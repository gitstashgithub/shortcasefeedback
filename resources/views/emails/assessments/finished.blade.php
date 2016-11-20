<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
</head>
<body>
<div>
    Dear {{$name}},<br>
    <br>
    Your examination summary:
    <ul>
        @foreach($items as $item)
            <li>
                {{$item['name']}}: {{$item['value']}}
                @if(isset($item['technique']))
                    <ul>
                        @foreach($item['technique'] as $technique)
                            <li>{{$technique}}</li>
                        @endforeach
                    </ul>
                @endif
            </li>

        @endforeach
    </ul>
</div>
</body>
</html>
